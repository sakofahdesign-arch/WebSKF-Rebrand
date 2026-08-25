<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        if (! Schema::hasTable('asset')) {
            $assets = new LengthAwarePaginator(collect(), 0, 10, 1, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
            $mapAssets = collect();

            return view('office.admin.assets.index', compact('assets', 'mapAssets'));
        }

        $query = $this->assetIndexQuery();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $searchColumns = $this->assetSearchColumns();
            $canSearchAssetType = $this->canJoinAssetType();

            if ($searchColumns !== [] || $canSearchAssetType) {
                $query->where(function ($builder) use ($search, $searchColumns, $canSearchAssetType) {
                    foreach ($searchColumns as $column) {
                        $builder->orWhere("asset.{$column}", 'like', "%{$search}%");
                    }

                    if ($canSearchAssetType) {
                        $builder->orWhere('asset_type.asset_name', 'like', "%{$search}%");
                    }
                });
            }
        }

        $assets = $this->orderAssetQuery(clone $query)->paginate(10);

        $mapAssets = collect();

        if ($this->hasSalesMapColumns()) {
            $mapAssets = $this->orderAssetQuery($query
                ->whereNotNull('asset.latitude')
                ->whereNotNull('asset.longitude'))
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
        $rules = [
            'title'        => 'required|string|max:255',
            'asset_type'   => 'required|integer',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'contact'      => 'required|string|max:255',
            'coverImage'   => 'nullable|image|max:10240',
            'Images'       => 'nullable|array',
            'Images.*'     => 'image|max:10240',
            'deedFile'     => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480',
        ];

        if ($this->hasAssetColumn('latitude')) {
            $rules['latitude'] = 'required|numeric|between:-90,90';
        }

        if ($this->hasAssetColumn('longitude')) {
            $rules['longitude'] = 'required|numeric|between:-180,180';
        }

        if ($this->hasAssetColumn('listing_type')) {
            $rules['listing_type'] = 'required|in:sale,rent,inactive';
        }

        $request->validate($rules);

        $uploadFolder = 'assets';
        $deedFolder = 'assets/deeds';

        File::ensureDirectoryExists(public_path($uploadFolder));
        File::ensureDirectoryExists(public_path($deedFolder));

        $assetData = [
            'title'        => $request->title,
            'description1' => $request->description1,
            'description2' => $request->description2 ?? '',
            'contact'      => $request->contact,
            'asset_type'   => $request->asset_type,
            ...$this->listingTypeData($request),
            'picture_name' => '',
            'date'         => now(),
        ];

        if ($this->hasAssetColumn('latitude')) {
            $assetData['latitude'] = $request->latitude;
        }

        if ($this->hasAssetColumn('longitude')) {
            $assetData['longitude'] = $request->longitude;
        }

        if ($this->hasAssetColumn('deed_file')) {
            $assetData['deed_file'] = null;
        }

        $assetId = DB::table('asset')->insertGetId($assetData);

        $timestamp = time();
        $coverFileName = $this->storeCoverImage($request, $assetId, $timestamp, $uploadFolder);
        $deedFileName = $this->storeDeedFile($request, $assetId, $timestamp, $deedFolder);

        $assetFiles = ['picture_name' => $coverFileName ?? ''];

        if ($this->hasAssetColumn('deed_file')) {
            $assetFiles['deed_file'] = $deedFileName;
        }

        DB::table('asset')->where('id', $assetId)->update($assetFiles);

        $this->storeGalleryImages($request, $assetId, $timestamp, $uploadFolder);

        return redirect()->route('asset.index')->with('success', 'เพิ่มรายการขายทรัพย์สินเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการแก้ไข');
        }

        $galleryImages = Schema::hasTable('asset_picture')
            ? DB::table('asset_picture')->where('id', $id)->pluck('picture_name')
            : collect();

        return view('office.admin.assets.edit', compact('asset', 'galleryImages'));
    }

    public function show($id)
    {
        return redirect()->route('asset.edit', ['manage_asset' => $id]);
    }

    public function update(Request $request, $id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการแก้ไข');
        }

        $rules = [
            'title'        => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'contact'      => 'required|string|max:255',
            'asset_type'   => 'required|integer',
            'coverImage'   => 'nullable|image|max:10240',
            'Images'       => 'nullable|array',
            'Images.*'     => 'image|max:10240',
            'deedFile'     => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480',
        ];

        if ($this->hasAssetColumn('latitude')) {
            $rules['latitude'] = 'required|numeric|between:-90,90';
        }

        if ($this->hasAssetColumn('longitude')) {
            $rules['longitude'] = 'required|numeric|between:-180,180';
        }

        if ($this->hasAssetColumn('listing_type')) {
            $rules['listing_type'] = 'required|in:sale,rent,inactive';
        }

        $request->validate($rules);

        $uploadFolder = 'assets';
        File::ensureDirectoryExists(public_path($uploadFolder));

        $coverFileName = $asset->picture_name ?? '';
        if ($request->hasFile('coverImage')) {
            $coverFileName = $this->storeCoverImage($request, (int) $id, time(), $uploadFolder);

            if (! empty($asset->picture_name)) {
                File::delete(public_path($uploadFolder . '/' . $asset->picture_name));
            }
        }

        $deedFileName = $asset->deed_file ?? null;

        if ($this->hasAssetColumn('deed_file') && $request->hasFile('deedFile')) {
            $deedFolder = 'assets/deeds';
            File::ensureDirectoryExists(public_path($deedFolder));
            $deedFileName = $this->storeDeedFile($request, (int) $id, time(), $deedFolder);

            if (! empty($asset->deed_file)) {
                File::delete(public_path($deedFolder . '/' . $asset->deed_file));
            }
        }

        $assetData = [
            'title'        => $request->title,
            'description1' => $request->description1,
            'description2' => $request->description2 ?? '',
            'contact'      => $request->contact,
            'asset_type'   => $request->asset_type,
            ...$this->listingTypeData($request),
            'picture_name' => $coverFileName ?? '',
        ];

        if ($this->hasAssetColumn('latitude')) {
            $assetData['latitude'] = $request->latitude;
        }

        if ($this->hasAssetColumn('longitude')) {
            $assetData['longitude'] = $request->longitude;
        }

        if ($this->hasAssetColumn('deed_file')) {
            $assetData['deed_file'] = $deedFileName;
        }

        DB::table('asset')->where('id', $id)->update($assetData);

        $this->storeGalleryImages($request, (int) $id, time(), $uploadFolder);

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
        return $this->hasAssetColumn('latitude')
            && $this->hasAssetColumn('longitude');
    }

    private function listingTypeData(Request $request): array
    {
        if (! $this->hasAssetColumn('listing_type')) {
            return [];
        }

        return ['listing_type' => $request->input('listing_type', 'sale')];
    }

    private function assetIndexQuery()
    {
        $query = DB::table('asset');

        if ($this->canJoinAssetType()) {
            return $query
                ->leftJoin('asset_type', 'asset.asset_type', '=', 'asset_type.asset_type')
                ->select('asset.*', 'asset_type.asset_name');
        }

        return $query->select('asset.*', DB::raw('NULL as asset_name'));
    }

    private function assetSearchColumns(): array
    {
        return array_values(array_filter(
            ['title', 'description1', 'description2'],
            fn (string $column) => $this->hasAssetColumn($column)
        ));
    }

    private function orderAssetQuery($query)
    {
        return $this->hasAssetColumn('date')
            ? $query->orderByDesc('asset.date')
            : $query->orderByDesc('asset.id');
    }

    private function hasAssetColumn(string $column): bool
    {
        return Schema::hasTable('asset') && Schema::hasColumn('asset', $column);
    }

    private function canJoinAssetType(): bool
    {
        return $this->hasAssetColumn('asset_type')
            && Schema::hasTable('asset_type')
            && Schema::hasColumn('asset_type', 'asset_type')
            && $this->hasAssetTypeName();
    }

    private function hasAssetTypeName(): bool
    {
        return Schema::hasTable('asset_type') && Schema::hasColumn('asset_type', 'asset_name');
    }

    private function mapAssetPayload(object $asset): array
    {
        $latitude = (float) $asset->latitude;
        $longitude = (float) $asset->longitude;

        return [
            'id' => (string) $asset->id,
            'title' => $this->cleanText($asset->title ?? ''),
            'category' => $this->cleanText($asset->asset_name ?? 'ขายทรัพย์สิน'),
            'listingType' => in_array(($asset->listing_type ?? 'sale'), ['sale', 'rent', 'inactive'], true) ? $asset->listing_type : 'sale',
            'description1' => $this->cleanText($asset->description1 ?? ''),
            'description2' => $this->cleanText($asset->description2 ?? ''),
            'contact' => $this->cleanText($asset->contact ?? ''),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'image' => $asset->picture_name ? asset('assets/' . $asset->picture_name) : asset('images/sakofah-logo.png'),
            'map_link' => "https://www.google.com/maps/search/?api=1&query={$latitude},{$longitude}",
            'edit_url' => $this->assetEditUrl($asset),
        ];
    }

    private function assetEditUrl(object $asset): string
    {
        if (empty($asset->id)) {
            return route('asset.index');
        }

        return route('asset.edit', ['manage_asset' => $asset->id]);
    }

    private function cleanText(mixed $value): string
    {
        $text = (string) $value;

        if (function_exists('mb_scrub')) {
            return mb_scrub($text, 'UTF-8');
        }

        $clean = @iconv('UTF-8', 'UTF-8//IGNORE', $text);

        return $clean === false ? '' : $clean;
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
