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

<section id="branch-network" data-section="branch-service-network" class="relative isolate overflow-visible bg-transparent py-16 lg:py-20">
    <div class="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64"></div>

    <div class="relative z-10 mx-auto max-w-[1560px] px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-12 max-w-3xl text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-black dark:text-white tracking-tight">
                เครือข่ายสาขาให้บริการ
            </h2>
            <div class="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full"></div>
            <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-gray-600">
                ค้นหาสาขาใกล้บ้านท่าน พร้อมข้อมูลติดต่อและแผนที่การเดินทาง เพื่อความสะดวกในการทำธุรกรรม
            </p>
        </div>
    </div>

    <div class="relative z-10 mx-auto max-w-[1560px] px-4 sm:px-6 lg:px-8">
        <div
            data-branch-network-map
            data-branches='@json($branches)'
            class="min-h-[560px] overflow-hidden rounded-[1.75rem] border border-emerald-900/10 bg-white/90 p-px shadow-[0_22px_70px_rgba(4,60,50,0.07)]"
        >
            <div class="grid min-h-[544px] place-items-center rounded-[1.35rem] text-sm font-semibold text-emerald-950/60">
                กำลังโหลดแผนที่สาขา
            </div>
        </div>
    </div>
</section>
