@extends('layouts.layout')

@section('title', 'สำนักงานและสาขา')

@php
    $branches = [
        [
            'id' => 'khlong_yang',
            'name' => 'สาขาคลองยาง (สำนักงานใหญ่)',
            'address' => 'เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่ 81120',
            'phone' => '075-652-525',
            'map_link' => 'https://goo.gl/maps/LhWKe8wBYrgMiXBe7',
            'color' => 'green', // ใช้กำหนดสีธีม
        ],
        [
            'id' => 'krabi',
            'name' => 'สาขากระบี่',
            'address' => 'เลขที่ 199/9-10 ถนนกระบี่-เขาทอง ตำบลปากน้ำ อำเภอเมือง จังหวัดกระบี่ 81000',
            'phone' => '075-652-525',
            'map_link' => 'https://goo.gl/maps/5gn6PA6tpoW1B14R9',
            'color' => 'blue',
        ],
        [
            'id' => 'ao_luek',
            'name' => 'สาขาอ่าวลึก',
            'address' => 'เลขที่ 59/24 หมู่ที่ 4 ตำบลคลองหิน อำเภออ่าวลึก จังหวัดกระบี่ 81110',
            'phone' => '075-665-634',
            'map_link' => 'https://goo.gl/maps/Aihh2VsbS855rJ2R8',
            'color' => 'yellow',
        ],
        [
            'id' => 'koh_lanta',
            'name' => 'สาขาเกาะลันตา',
            'address' => 'เลขที่ 100 หมู่ที่ 2 ตำบลศาลาด่าน อำเภอเกาะลันตา จังหวัดกระบี่ 81150',
            'phone' => '075-667-226',
            'map_link' => 'https://goo.gl/maps/HG69qg4D3qVmnFtLA',
            'color' => 'purple',
        ],
        [
            'id' => 'khlong_thom',
            'name' => 'สาขาคลองท่อม',
            'address' => 'เลขที่ 218/1-2 หมู่ที่ 2 ตำบลคลองท่อมใต้ อำเภอคลองท่อม จังหวัดกระบี่ 81120',
            'phone' => '075-702-745',
            'map_link' => 'https://goo.gl/maps/rGe5App24NWS3aze9',
            'color' => 'orange',
        ],
        [
            'id' => 'huai_luek',
            'name' => 'สาขาห้วยลึก',
            'address' => 'เลขที่ 14/10 หมู่ที่ 1 ตำบลทรายขาว อำเภอคลองท่อม จังหวัดกระบี่ 81170',
            'phone' => '075-810-672',
            'map_link' => 'https://goo.gl/maps/TR4bdqnLorU7JgWz5',
            'color' => 'cyan',
        ],
        [
            'id' => 'kanchanadit',
            'name' => 'สาขากาญจนดิษฐ์',
            'address' => 'เลขที่ 111/47 หมู่ที่ 2 ตำบลท่าทองใหม่ อำเภอกาญจนดิษฐ์ จังหวัดสุราษฏร์ธานี 84290',
            'phone' => '086-4759102',
            'map_link' => 'https://goo.gl/maps/8twLNE6tSBevJGvy6',
            'color' => 'red',
        ],
        [
            'id' => 'ton_thuai',
            'name' => 'สาขาต้นทวย',
            'address' => '123/2 ม.1 ต.คลองเขม้า อ.เหนือคลอง จ.กระบี่ 81130',
            'phone' => '088-262-0995, 075-810534',
            'map_link' => 'https://maps.app.goo.gl/ekHLfRDRgj59XbfZA',
            'color' => 'pink',
        ],
    ];
@endphp

@section('content')
<div class="bg-white min-h-screen" x-data="{ activeTab: '{{ $branches[0]['id'] }}', loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">

    <div class="bg-green-50 py-16">
        <div class="container mx-auto px-4 text-center transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-3xl md:text-5xl font-extrabold text-green-800 mb-4">
                เครือข่ายสาขาให้บริการ
            </h1>
            <div class="h-1.5 w-24 bg-green-500 mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                ค้นหาสาขาใกล้บ้านท่าน พร้อมข้อมูลติดต่อและแผนที่การเดินทาง เพื่อความสะดวกในการทำธุรกรรม
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-4 transition-all duration-700 ease-out"
                 style="transition-delay: 200ms"
                 :class="loaded ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-5'">

                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-4 bg-green-800 text-white font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-map-marked-alt"></i> เลือกสาขาที่ต้องการ
                    </div>

                    <ul class="menu bg-white w-full p-2 rounded-box">
                        @foreach ($branches as $branch)
                            @php
                                // Map color names to Tailwind classes for active state
                                $activeColorClass = match($branch['color']) {
                                    'green' => 'bg-green-100 text-green-800 border-l-4 border-green-600',
                                    'blue' => 'bg-blue-100 text-blue-800 border-l-4 border-blue-600',
                                    'yellow' => 'bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500',
                                    'purple' => 'bg-purple-100 text-purple-800 border-l-4 border-purple-600',
                                    'orange' => 'bg-orange-100 text-orange-800 border-l-4 border-orange-500',
                                    'cyan' => 'bg-cyan-100 text-cyan-800 border-l-4 border-cyan-600',
                                    'red' => 'bg-red-100 text-red-800 border-l-4 border-red-600',
                                    'pink' => 'bg-pink-100 text-pink-800 border-l-4 border-pink-500',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <li class="mb-1">
                                <button @click="activeTab = '{{ $branch['id'] }}'"
                                    class="py-3 px-4 text-base font-medium rounded-lg transition-all duration-200 hover:bg-gray-50"
                                    :class="activeTab === '{{ $branch['id'] }}' ? '{{ $activeColorClass }} font-bold' : 'text-gray-600'">
                                    <div class="flex items-center w-full">
                                        <div class="w-2 h-2 rounded-full mr-3"
                                             :class="activeTab === '{{ $branch['id'] }}' ? 'bg-current' : 'bg-gray-300'"></div>
                                        {{ $branch['name'] }}
                                    </div>
                                    <i class="fas fa-chevron-right text-xs ml-auto opacity-50" x-show="activeTab === '{{ $branch['id'] }}'"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-8 relative min-h-[500px] transition-all duration-700 ease-out"
                 style="transition-delay: 400ms"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">

                @foreach ($branches as $branch)
                    @php
                        // Text colors
                         $titleColor = match($branch['color']) {
                            'green' => 'text-green-700',
                            'blue' => 'text-blue-700',
                            'yellow' => 'text-yellow-600',
                            'purple' => 'text-purple-700',
                            'orange' => 'text-orange-600',
                            'cyan' => 'text-cyan-700',
                            'red' => 'text-red-700',
                            'pink' => 'text-pink-700',
                            default => 'text-gray-800',
                        };

                        // Button classes
                        $btnClass = match($branch['color']) {
                             'green' => 'btn-success text-white',
                            'blue' => 'btn-info text-white',
                            'yellow' => 'btn-warning text-white',
                            'purple' => 'bg-purple-600 hover:bg-purple-700 text-white border-none',
                            'orange' => 'bg-orange-500 hover:bg-orange-600 text-white border-none',
                            'cyan' => 'bg-cyan-600 hover:bg-cyan-700 text-white border-none',
                            'red' => 'btn-error text-white',
                            'pink' => 'bg-pink-500 hover:bg-pink-600 text-white border-none',
                            default => 'btn-primary',
                        };
                    @endphp

                    <div x-show="activeTab === '{{ $branch['id'] }}'"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="display: none;">

                        <div class="card lg:card-side bg-white shadow-2xl border border-gray-100 overflow-hidden rounded-2xl h-full">

                            <figure class="lg:w-1/2 h-64 lg:h-auto relative">
                                <img src="{{ asset('images/branch/' . $branch['id'] . '.jpg') }}"
                                     alt="{{ $branch['name'] }}"
                                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-110"
                                     onerror="this.onerror=null;this.src='https://placehold.co/800x600/f3f4f6/9ca3af?text=No+Image';">
                                <div class="absolute inset-0 bg-black/10"></div>
                            </figure>

                            <div class="card-body p-8 lg:w-1/2">
                                <h2 class="card-title text-3xl font-extrabold {{ $titleColor }} mb-6 border-b pb-4">
                                    {{ $branch['name'] }}
                                </h2>

                                <div class="space-y-6 flex-grow">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center shrink-0 text-gray-500">
                                            <i class="fas fa-map-marker-alt text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-700 mb-1">ที่อยู่:</p>
                                            <p class="text-gray-600 leading-relaxed">{{ $branch['address'] }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center shrink-0 text-gray-500">
                                            <i class="fas fa-phone-alt text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-700 mb-1">เบอร์โทรศัพท์:</p>
                                            <p class="text-xl font-bold text-gray-800">{{ $branch['phone'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-actions justify-end mt-8">
                                    <a href="{{ $branch['map_link'] }}" target="_blank"
                                       class="btn {{ $btnClass }} w-full lg:w-auto gap-2 shadow-md hover:shadow-lg transition-all">
                                        <i class="fas fa-location-arrow"></i> นำทาง (Google Maps)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
