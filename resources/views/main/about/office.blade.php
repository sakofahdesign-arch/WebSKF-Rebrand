@extends('layouts.layout')

@section('title', 'เครือข่ายสาขาให้บริการ')

@php
    $branchOrder = config('site-content.branch_order');

    $branches = collect(config('site-content.branches'))
        ->merge(config('site-content.business_units'))
        ->map(function ($branch) {
            $branch['mapLink'] = "https://www.google.com/maps/search/?api=1&query={$branch['latitude']},{$branch['longitude']}";
            $branch['group'] = $branch['group'] ?? 'branch';
            $branch['markerKind'] = $branch['markerKind'] ?? 'branch';
            $branch['markerLogo'] = asset($branch['markerLogo'] ?? 'content/logos/sakofah-logo.png');
            $branch['image'] = asset($branch['image']);

            if ($branch['id'] === 'khlong_yang') {
                $branch['name'] = 'สาขาคลองยาง (สำนักงานใหญ่)';
            }

            return $branch;
        })
        ->sortBy(fn ($branch) => array_search($branch['id'], $branchOrder, true))
        ->values()
        ->all();
@endphp

@section('content')
    <main data-branch-network-page class="bg-slate-950">
        <div
            data-branch-network-map
            data-map-variant="fullscreen"
            data-branches='@json($branches)'
            aria-label="เครือข่ายสาขาให้บริการ"
        >
            <div class="grid h-[100dvh] min-h-[704px] place-items-center bg-slate-950 text-sm font-semibold text-white/70">
                กำลังโหลดแผนที่เครือข่ายสาขาให้บริการ
            </div>
        </div>
    </main>
@endsection
