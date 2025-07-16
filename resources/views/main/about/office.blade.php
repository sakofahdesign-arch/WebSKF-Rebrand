@extends('layouts.layout')

@section('title', 'สำนักงานสหกรณ์')

@php
    $branches = [
        [
            'id' => 'khlong_yang',
            'name' => 'สาขาคลองยาง',
            'address' => 'เลขที่ 291 หมู่ที่ 1 ตำบลคลองยาง อำเภอเกาะลันตา จังหวัดกระบี่ 81120',
            'phone' => '075-652-525',
            'map_link' => 'https://goo.gl/maps/LhWKe8wBYrgMiXBe7',
            'theme' => ['active' => 'bg-green-600 text-white', 'hover' => 'hover:bg-green-100', 'text' => 'text-green-700'],
        ],
        [
            'id' => 'krabi',
            'name' => 'สาขากระบี่',
            'address' => 'เลขที่ 199/9-10 ถนนกระบี่-เขาทอง ตำบลปากน้ำ อำเภอเมือง จังหวัดกระบี่ 81000',
            'phone' => '075-652-525',
            'map_link' => 'https://goo.gl/maps/5gn6PA6tpoW1B14R9',
            'theme' => ['active' => 'bg-blue-600 text-white', 'hover' => 'hover:bg-blue-100', 'text' => 'text-blue-700'],
        ],
        [
            'id' => 'ao_luek',
            'name' => 'สาขาอ่าวลึก',
            'address' => 'เลขที่ 59/24 หมู่ที่ 4 ตำบลคลองหิน อำเภออ่าวลึก จังหวัดกระบี่ 81110',
            'phone' => '075-665-634',
            'map_link' => 'https://goo.gl/maps/Aihh2VsbS855rJ2R8',
            'theme' => ['active' => 'bg-yellow-500 text-white', 'hover' => 'hover:bg-yellow-100', 'text' => 'text-yellow-600'],
        ],
        [
            'id' => 'koh_lanta',
            'name' => 'สาขาเกาะลันตา',
            'address' => 'เลขที่ 100 หมู่ที่ 2 ตำบลศาลาด่าน อำเภอเกาะลันตา จังหวัดกระบี่ 81150',
            'phone' => '075-667-226',
            'map_link' => 'https://goo.gl/maps/HG69qg4D3qVmnFtLA',
            'theme' => ['active' => 'bg-purple-600 text-white', 'hover' => 'hover:bg-purple-100', 'text' => 'text-purple-700'],
        ],
        [
            'id' => 'khlong_thom',
            'name' => 'สาขาคลองท่อม',
            'address' => 'เลขที่ 218/1-2 หมู่ที่ 2 ตำบลคลองท่อมใต้ อำเภอคลองท่อม จังหวัดกระบี่ 81120',
            'phone' => '075-702-745',
            'map_link' => 'https://goo.gl/maps/rGe5App24NWS3aze9',
            'theme' => ['active' => 'bg-orange-500 text-white', 'hover' => 'hover:bg-orange-100', 'text' => 'text-orange-600'],
        ],
        [
            'id' => 'huai_luek',
            'name' => 'สาขาห้วยลึก',
            'address' => 'เลขที่ 14/10 หมู่ที่ 1 ตำบลทรายขาว อำเภอคลองท่อม จังหวัดกระบี่ 81170',
            'phone' => '075-810-672',
            'map_link' => 'https://goo.gl/maps/TR4bdqnLorU7JgWz5',
            'theme' => ['active' => 'bg-cyan-600 text-white', 'hover' => 'hover:bg-cyan-100', 'text' => 'text-cyan-700'],
        ],
        [
            'id' => 'kanchanadit',
            'name' => 'สาขากาญจนดิษฐ์',
            'address' => 'เลขที่ 111/47 หมู่ที่ 2 ตำบลท่าทองใหม่ อำเภอกาญจนดิษฐ์ จังหวัดสุราษฏร์ธานี 84290',
            'phone' => '086-4759102',
            'map_link' => 'https://goo.gl/maps/8twLNE6tSBevJGvy6',
            'theme' => ['active' => 'bg-red-600 text-white', 'hover' => 'hover:bg-red-100', 'text' => 'text-red-700'],
        ],
        [
            'id' => 'ton_thuai',
            'name' => 'สาขาต้นทวย',
            'address' => '123/2 ม.1 ต.คลองเขม้า อ.เหนือคลอง จ.กระบี่ 81130',
            'phone' => '088-262-0995, 075-810534',
            'map_link' => 'https://maps.app.goo.gl/ekHLfRDRgj59XbfZA', // Add map link when available
            'theme' => ['active' => 'bg-pink-600 text-white', 'hover' => 'hover:bg-pink-100', 'text' => 'text-pink-700'],
        ],
    ];
@endphp

@section('content')
<div class="bg-gray-50" x-data="{ activeTab: '{{ $branches[0]['id'] }}', loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">
    <div class="container mx-auto px-4 py-16">

        <div class="text-center mb-12 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-green-600 mb-4">
                สำนักงานและสาขา
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                ค้นหาสาขาใกล้บ้านท่าน พร้อมข้อมูลติดต่อและแผนที่การเดินทาง เพื่อความสะดวกในการรับบริการ
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">เลือกสาขา</h2>
                <div class="space-y-2">
                    @foreach ($branches as $branch)
                        <button @click="activeTab = '{{ $branch['id'] }}'" class="w-full text-left p-4 rounded-lg transition-all duration-300 flex items-center {{ $branch['theme']['hover'] }}":class="{'{{ $branch['theme']['active'] }} shadow-lg scale-105': activeTab === '{{ $branch['id'] }}','bg-white text-gray-700': activeTab !== '{{ $branch['id'] }}'}">
                            <svg class="h-6 w-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $branch['name'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-3 relative">
                @foreach ($branches as $branch)
                    <div x-show="activeTab === '{{ $branch['id'] }}'"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="bg-white rounded-2xl shadow-xl overflow-hidden"
                         style="display: none;">

                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="bg-gray-100">
                                <img src="{{ asset('images/branch/' . $branch['id'] . '.jpg') }}" 
                                     alt="รูปภาพสาขา {{ $branch['name'] }}" 
                                     class="w-full h-full object-cover min-h-[300px] md:min-h-[450px]"
                                     onerror="this.onerror=null;this.src='https://placehold.co/800x600/e2e8f0/475569?text=Image+Not+Found';">
                            </div>

                            <div class="p-8 flex flex-col justify-center">
                                <h2 class="text-3xl font-bold {{ $branch['theme']['text'] }} mb-6">{{ $branch['name'] }}</h2>
                                <div class="space-y-4 text-gray-700">
                                    <p class="flex items-start text-lg">
                                        <svg class="w-6 h-6 mr-4 text-gray-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span>{{ $branch['address'] }}</span>
                                    </p>
                                    <p class="flex items-start text-lg">
                                       <svg class="w-6 h-6 mr-4 text-gray-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        <span>{{ $branch['phone'] }}</span>
                                    </p>
                                </div>
                                <a href="{{ $branch['map_link'] }}" target="_blank" rel="noopener noreferrer" 
                                   class="mt-8 w-full text-center px-6 py-3 {{ $branch['theme']['active'] }} rounded-lg font-semibold hover:scale-105 transform transition-all duration-300">
                                    ขอเส้นทาง (Google Maps)
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
