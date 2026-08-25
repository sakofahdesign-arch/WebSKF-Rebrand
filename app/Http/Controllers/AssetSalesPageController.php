<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AssetSalesPageController extends Controller
{
    public function __invoke()
    {
        return view('main.asset.preview', [
            'mapAssets' => $this->mapAssets(),
        ]);
    }

    private function mapAssets(): Collection
    {
        if (! Schema::hasTable('asset') || ! Schema::hasColumn('asset', 'latitude') || ! Schema::hasColumn('asset', 'longitude')) {
            return collect();
        }

        $query = DB::table('asset')
            ->whereNotNull('asset.latitude')
            ->whereNotNull('asset.longitude');

        if (Schema::hasTable('asset_type')) {
            $query
                ->leftJoin('asset_type', 'asset.asset_type', '=', 'asset_type.asset_type')
                ->select('asset.*', 'asset_type.asset_name');
        } else {
            $query->select('asset.*');
        }

        if (Schema::hasColumn('asset', 'date')) {
            $query->orderByDesc('asset.date');
        } else {
            $query->orderByDesc('asset.id');
        }

        return $query
            ->get()
            ->map(fn (object $asset) => $this->mapAssetPayload($asset))
            ->values();
    }

    private function mapAssetPayload(object $asset): array
    {
        $latitude = (float) $asset->latitude;
        $longitude = (float) $asset->longitude;
        $area = $this->firstFilled($asset, ['area', 'land_area', 'asset_area', 'size']);
        $price = $this->formatPrice($this->firstFilled($asset, ['price', 'sale_price', 'rent_price', 'asset_price']));
        $status = $this->firstFilled($asset, ['status', 'asset_status', 'document_status']);

        if ($status === '' && $this->firstFilled($asset, ['deed_file']) !== '') {
            $status = 'เอกสารครบ';
        }

        return [
            'id' => (string) $asset->id,
            'title' => $this->firstFilled($asset, ['title'], 'รายการขายทรัพย์สิน'),
            'category' => $asset->asset_name ?? $this->assetCategoryName($asset->asset_type ?? null),
            'listingType' => $this->listingType($asset),
            'price' => $price,
            'area' => $area,
            'status' => $status,
            'description1' => $this->descriptionLine($asset, $area),
            'description2' => $this->firstFilled($asset, ['description2']),
            'contact' => $this->firstFilled($asset, ['contact']),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'image' => $this->assetImage($asset),
            'map_link' => "https://www.google.com/maps?q={$latitude},{$longitude}",
            'edit_url' => $this->assetDetailUrl($asset),
        ];
    }

    private function firstFilled(object $asset, array $fields, string $fallback = ''): string
    {
        foreach ($fields as $field) {
            if (isset($asset->{$field}) && trim((string) $asset->{$field}) !== '') {
                return trim((string) $asset->{$field});
            }
        }

        return $fallback;
    }

    private function formatPrice(string $value): string
    {
        if ($value === '') {
            return '';
        }

        $normalized = str_replace(',', '', $value);

        return is_numeric($normalized) ? number_format((float) $normalized) : $value;
    }

    private function descriptionLine(object $asset, string $area): string
    {
        $description = $this->firstFilled($asset, ['description1']);

        if ($area !== '' && $description !== '') {
            return "{$description} · {$area}";
        }

        return $description !== '' ? $description : $area;
    }

    private function listingType(object $asset): string
    {
        $explicitType = strtolower($this->firstFilled($asset, ['listing_type', 'listingType', 'sale_type', 'transaction_type']));

        if (in_array($explicitType, ['inactive', 'off', 'hidden', 'not_sale', 'not-sale', 'ไม่ขาย'], true)) {
            return 'inactive';
        }

        if (in_array($explicitType, ['rent', 'lease', 'เช่า'], true)) {
            return 'rent';
        }

        if (in_array($explicitType, ['sale', 'sell', 'ขาย'], true)) {
            return 'sale';
        }

        $text = implode(' ', [
            $this->firstFilled($asset, ['title']),
            $this->firstFilled($asset, ['description1']),
            $this->firstFilled($asset, ['description2']),
            $this->firstFilled($asset, ['status', 'asset_status']),
        ]);

        return str_contains($text, 'เช่า') ? 'rent' : 'sale';
    }

    private function assetCategoryName(mixed $assetType): string
    {
        return match ((string) $assetType) {
            '1' => 'บ้านพร้อมที่ดิน',
            '2' => 'ที่ดินเปล่า',
            '3' => 'คอนโด',
            default => 'ขายทรัพย์สิน',
        };
    }

    private function assetImage(object $asset): string
    {
        $picture = $this->firstFilled($asset, ['picture_name', 'image', 'cover_image']);

        return $picture !== ''
            ? asset(str_starts_with($picture, 'assets/') ? $picture : "assets/{$picture}")
            : asset('images/sakofah-logo.png');
    }

    private function assetDetailUrl(object $asset): string
    {
        if (empty($asset->id)) {
            return route('asset.preview');
        }

        return match ((string) ($asset->asset_type ?? '')) {
            '1' => route('home', ['id' => $asset->id]),
            '2' => route('vacant', ['id' => $asset->id]),
            '3' => route('condo', ['id' => $asset->id]),
            default => route('asset.preview'),
        };
    }
}
