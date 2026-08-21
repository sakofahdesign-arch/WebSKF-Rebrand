<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('asset')
            ->leftJoin('asset_type', 'asset.asset_type', '=', 'asset_type.asset_type')
            ->select('asset.*', 'asset_type.asset_name');

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('asset.title', 'like', "%{$search}%")
                    ->orWhere('asset.description1', 'like', "%{$search}%")
                    ->orWhere('asset.description2', 'like', "%{$search}%")
                    ->orWhere('asset_type.asset_name', 'like', "%{$search}%");
            });
        }

        $assets = (clone $query)
            ->orderByDesc('asset.date')
            ->paginate(10);

        $mapAssets = collect();

        if ($this->hasSalesMapColumns()) {
            $mapAssets = $query
                ->whereNotNull('asset.latitude')
                ->whereNotNull('asset.longitude')
                ->orderByDesc('asset.date')
                ->get()
                ->map(fn ($asset) => $this->mapAssetPayload($asset))
                ->values();
        }

        return view('office.admin.assets.index', compact('assets', 'mapAssets'));
    }

    public function create()
    {
        return view('office.admin.assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'asset_type'   => 'required|integer',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'contact'      => 'required|string|max:255',
            'latitude'     => 'required|numeric|between:-90,90',
            'longitude'    => 'required|numeric|between:-180,180',
            'coverImage'   => 'nullable|image|max:10240',
            'Images'       => 'nullable|array',
            'Images.*'     => 'image|max:10240',
            'deedFile'     => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480',
        ]);

        $uploadFolder = 'assets';
        $deedFolder = 'assets/deeds';

        File::ensureDirectoryExists(public_path($uploadFolder));
        File::ensureDirectoryExists(public_path($deedFolder));

        $assetId = DB::table('asset')->insertGetId([
            'title'        => $request->title,
            'description1' => $request->description1,
            'description2' => $request->description2 ?? '',
            'contact'      => $request->contact,
            'asset_type'   => $request->asset_type,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'picture_name' => '',
            'deed_file'    => null,
            'date'         => now(),
        ]);

        $timestamp = time();
        $coverFileName = $this->storeCoverImage($request, $assetId, $timestamp, $uploadFolder);
        $deedFileName = $this->storeDeedFile($request, $assetId, $timestamp, $deedFolder);

        DB::table('asset')->where('id', $assetId)->update([
            'picture_name' => $coverFileName ?? '',
            'deed_file'    => $deedFileName,
        ]);

        $this->storeGalleryImages($request, $assetId, $timestamp, $uploadFolder);

        return redirect()->route('asset.index')->with('success', 'เพิ่มรายการขายทรัพย์สินเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการแก้ไข');
        }

        return view('office.admin.assets.edit', compact('asset'));
    }

    public function show($id)
    {
        return redirect()->route('asset.edit', $id);
    }

    public function update(Request $request, $id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการแก้ไข');
        }

        $request->validate([
            'title'        => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'contact'      => 'required|string|max:255',
            'asset_type'   => 'required|integer',
            'latitude'     => 'required|numeric|between:-90,90',
            'longitude'    => 'required|numeric|between:-180,180',
            'deedFile'     => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480',
        ]);

        $deedFileName = $asset->deed_file ?? null;

        if ($request->hasFile('deedFile')) {
            $deedFolder = 'assets/deeds';
            File::ensureDirectoryExists(public_path($deedFolder));
            $deedFileName = $this->storeDeedFile($request, (int) $id, time(), $deedFolder);

            if (! empty($asset->deed_file)) {
                File::delete(public_path($deedFolder . '/' . $asset->deed_file));
            }
        }

        DB::table('asset')->where('id', $id)->update([
            'title'        => $request->title,
            'description1' => $request->description1,
            'description2' => $request->description2 ?? '',
            'contact'      => $request->contact,
            'asset_type'   => $request->asset_type,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'deed_file'    => $deedFileName,
        ]);

        return redirect()->route('asset.index')->with('success', 'แก้ไขข้อมูลขายทรัพย์สินเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการลบ');
        }

        $uploadFolder = 'assets';
        $deedFolder = 'assets/deeds';
        $coverImage = $asset->picture_name;
        $deedFile = $asset->deed_file ?? null;
        $galleryImages = DB::table('asset_picture')->where('id', $id)->pluck('picture_name');

        try {
            DB::transaction(function () use ($id) {
                DB::table('asset_picture')->where('id', $id)->delete();
                DB::table('asset')->where('id', $id)->delete();
            });

            if ($coverImage) {
                File::delete(public_path($uploadFolder . '/' . $coverImage));
            }

            if ($deedFile) {
                File::delete(public_path($deedFolder . '/' . $deedFile));
            }

            foreach ($galleryImages as $image) {
                File::delete(public_path($uploadFolder . '/' . $image));
            }

            return redirect()->route('asset.index')->with('success', 'ลบรายการขายทรัพย์สินและไฟล์ทั้งหมดเรียบร้อยแล้ว');
        } catch (\Throwable $e) {
            return redirect()->route('asset.index')->with('error', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }
    }

    private function hasSalesMapColumns(): bool
    {
        return Schema::hasColumn('asset', 'latitude')
            && Schema::hasColumn('asset', 'longitude');
    }

    private function mapAssetPayload(object $asset): array
    {
        $latitude = (float) $asset->latitude;
        $longitude = (float) $asset->longitude;

        return [
            'id' => (string) $asset->id,
            'title' => $asset->title,
            'category' => $asset->asset_name ?? 'ขายทรัพย์สิน',
            'description1' => $asset->description1 ?? '',
            'description2' => $asset->description2 ?? '',
            'contact' => $asset->contact ?? '',
            'latitude' => $latitude,
            'longitude' => $longitude,
            'image' => $asset->picture_name ? asset('assets/' . $asset->picture_name) : asset('images/sakofah-logo.png'),
            'map_link' => "https://www.google.com/maps/search/?api=1&query={$latitude},{$longitude}",
            'edit_url' => route('asset.edit', $asset->id),
        ];
    }

    private function storeCoverImage(Request $request, int $assetId, int $timestamp, string $uploadFolder): ?string
    {
        if (! $request->hasFile('coverImage')) {
            return null;
        }

        $coverFile = $request->file('coverImage');
        $extension = $coverFile->getClientOriginalExtension();
        $coverFileName = "{$assetId}_cover_{$timestamp}.{$extension}";

        $coverFile->move(public_path($uploadFolder), $coverFileName);

        return $coverFileName;
    }

    private function storeGalleryImages(Request $request, int $assetId, int $timestamp, string $uploadFolder): void
    {
        if (! $request->hasFile('Images')) {
            return;
        }

        foreach ($request->file('Images') as $index => $galleryFile) {
            $extension = $galleryFile->getClientOriginalExtension();
            $galleryFileName = "{$assetId}_gallery_{$timestamp}_" . ($index + 1) . ".{$extension}";

            $galleryFile->move(public_path($uploadFolder), $galleryFileName);

            DB::table('asset_picture')->insert([
                'id' => $assetId,
                'picture_name' => $galleryFileName,
            ]);
        }
    }

    private function storeDeedFile(Request $request, int $assetId, int $timestamp, string $deedFolder): ?string
    {
        if (! $request->hasFile('deedFile')) {
            return null;
        }

        $deedFile = $request->file('deedFile');
        $extension = $deedFile->getClientOriginalExtension();
        $deedFileName = "{$assetId}_deed_{$timestamp}.{$extension}";

        $deedFile->move(public_path($deedFolder), $deedFileName);

        return $deedFileName;
    }
}
