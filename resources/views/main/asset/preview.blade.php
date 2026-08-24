@extends('layouts.layout')
@section('title', 'ตัวอย่างหน้าขายสินทรัพย์')

@php
    $categories = ['ทั้งหมด', 'บ้านพร้อมที่ดิน', 'ที่ดินเปล่า', 'คอนโด'];
    $assets = [
        [
            'title' => 'บ้านพร้อมที่ดิน ใกล้ชุมชนคลองยาง',
            'category' => 'บ้านพร้อมที่ดิน',
            'listing_type' => 'sale',
            'location' => 'คลองยาง, เกาะลันตา',
            'price' => '2,850,000',
            'area' => '1 งาน 28 ตร.ว.',
            'status' => 'พร้อมโอน',
            'image' => 'assets/1_cover_1752223204.jpg',
            'desc' => 'ทำเลชุมชน เดินทางสะดวก เหมาะสำหรับอยู่อาศัยหรือปรับปรุงเพื่อปล่อยเช่า',
            'latitude' => 7.803235,
            'longitude' => 99.085919,
            'contact' => '075-652-525',
        ],
        [
            'title' => 'ที่ดินเปล่าหน้ากว้าง ติดถนนชุมชน',
            'category' => 'ที่ดินเปล่า',
            'listing_type' => 'sale',
            'location' => 'เหนือคลอง, กระบี่',
            'price' => '1,650,000',
            'area' => '2 งาน 12 ตร.ว.',
            'status' => 'เอกสารครบ',
            'image' => 'assets/2_cover_1752223609.jpg',
            'desc' => 'แปลงสวย เหมาะสำหรับบ้านพักหรือกิจการขนาดเล็ก มีทางเข้าออกชัดเจน',
            'latitude' => 8.021063,
            'longitude' => 98.995649,
            'contact' => '088-262-0995',
        ],
        [
            'title' => 'ทาวน์โฮมพร้อมปรับปรุง ใกล้แหล่งบริการ',
            'category' => 'บ้านพร้อมที่ดิน',
            'listing_type' => 'sale',
            'location' => 'เมืองกระบี่',
            'price' => '1,980,000',
            'area' => '24 ตร.ว.',
            'status' => 'เปิดนัดชม',
            'image' => 'assets/1_gallery_1752223204_2.jpg',
            'desc' => 'พื้นที่ใช้สอยคุ้มค่า เหมาะสำหรับครอบครัวเริ่มต้นหรือสำนักงานขนาดเล็ก',
            'latitude' => 8.063564,
            'longitude' => 98.908573,
            'contact' => '075-652-525',
        ],
        [
            'title' => 'คอนโดพักอาศัย ใกล้เส้นทางหลัก',
            'category' => 'คอนโด',
            'listing_type' => 'rent',
            'location' => 'กระบี่',
            'price' => '890,000',
            'area' => '32 ตร.ม.',
            'status' => 'ราคาพิเศษ',
            'image' => 'assets/2_gallery_1752223609_2.jpg',
            'desc' => 'ยูนิตดูแลง่าย เหมาะสำหรับพักอาศัยหรือถือเป็นสินทรัพย์ให้เช่า',
            'latitude' => 7.940006,
            'longitude' => 99.144035,
            'contact' => '075-702-745',
        ],
    ];

    $mapAssets = collect($assets)->values()->map(fn ($item, $index) => [
        'id' => 'preview-' . ($index + 1),
        'title' => $item['title'],
        'category' => $item['category'],
        'listingType' => $item['listing_type'] ?? 'sale',
        'price' => $item['price'],
        'area' => $item['area'],
        'status' => $item['status'],
        'description1' => $item['location'] . ' · ' . $item['area'],
        'description2' => $item['desc'],
        'contact' => $item['contact'],
        'latitude' => $item['latitude'],
        'longitude' => $item['longitude'],
        'image' => asset($item['image']),
        'map_link' => 'https://www.google.com/maps?q=' . $item['latitude'] . ',' . $item['longitude'],
        'edit_url' => route('asset.preview'),
    ]);
@endphp

@section('content')
    <main data-asset-sales-preview-page class="bg-slate-950">
        <div
            data-asset-sales-map
            data-map-variant="fullscreen"
            data-assets='@json($mapAssets)'
            aria-label="แผนที่รายการขายสินทรัพย์"
        >
            <div class="grid h-[100dvh] min-h-[704px] place-items-center bg-slate-950 text-sm font-semibold text-white/70">
                กำลังโหลดแผนที่รายการขายสินทรัพย์
            </div>
        </div>
    </main>
@endsection
