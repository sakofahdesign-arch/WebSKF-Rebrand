@extends('layouts.layout')
@section('title', 'หน่วยบริการเคลื่อนที่')

@php
    // 1. โมบายกระบี่-เหนือคลอง
    $krabiNueaKhlong = [
        'week1' => [
            'title' => 'สัปดาห์ที่ 1',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => 'โรงเรียนษะกอฟะฮ (09.00 - 12.00 น.)', 'aft' => '-'],
                ['day' => 'อังคาร', 'morn' => '-', 'aft' => 'ศพด.เขากลม (13.30 - 16.00 น.)'],
                ['day' => 'พุธ', 'morn' => 'อ่าวน้ำเมา (09.30 - 12.00 น.)', 'aft' => 'หนองทะเล (13.30 - 16.00 น.)'],
                ['day' => 'พฤหัสบดี', 'morn' => 'อ่าวนาง (09.30 - 12.00 น.)', 'aft' => 'คลองแห้ง (13.30 - 16.00 น.)'],
                ['day' => 'ศุกร์', 'morn' => '-', 'aft' => '-'],
            ],
            'note' => '*หมายเหตุ : บ้านในไร่ ทุกวันที่ 10 ของเดือน 09.30 - 12.00 น. (ภาคเช้า)',
        ],
        'week2' => [
            'title' => 'สัปดาห์ที่ 2',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'morn' => '-', 'aft' => '-'],
                ['day' => 'พุธ', 'morn' => 'อ่าวน้ำเมา (09.30 - 12.00 น.)', 'aft' => 'หนองทะเล (13.30 - 16.00 น.)'],
                ['day' => 'พฤหัสบดี', 'full_day' => 'ไหนหนัง (10.00 - 16.00 น.)'],
                ['day' => 'ศุกร์', 'morn' => '-', 'aft' => '-'],
            ],
        ],
        'week3' => [
            'title' => 'สัปดาห์ที่ 3',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'morn' => 'คลองกรวด (09.00 - 12.00 น.)', 'aft' => '-'],
                ['day' => 'พุธ', 'morn' => 'อ่าวน้ำเมา (09.30 - 12.00 น.)', 'aft' => 'หนองทะเล (13.30 - 16.00 น.)'],
                ['day' => 'พฤหัสบดี', 'morn' => 'อ่าวนาง (09.30 - 12.00 น.)', 'aft' => 'คลองแห้ง (13.30 - 16.00 น.)'],
                ['day' => 'ศุกร์', 'morn' => 'บ้านคลองยวน (06.00 - 10.00 น.)', 'aft' => '-'],
            ],
        ],
        'week4' => [
            'title' => 'สัปดาห์ที่ 4',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'morn' => '-', 'aft' => '-'],
                ['day' => 'พุธ', 'morn' => 'อ่าวน้ำเมา (09.30 - 12.00 น.)', 'aft' => 'หนองทะเล (13.30 - 16.00 น.)'],
                ['day' => 'พฤหัสบดี', 'full_day' => 'ไหนหนัง (10.00 - 16.00 น.)'],
                ['day' => 'ศุกร์', 'morn' => 'บ้านคลองยวน (06.00 - 10.00 น.)', 'aft' => '-'],
            ],
        ],
    ];

    // 2. โมบายคลองท่อม-เกาะลันตาบางส่วน
    $khlongThomLanta = [
        'week1' => [
            'title' => 'สัปดาห์ที่ 1',
            'schedule' => [['day' => 'จันทร์ - ศุกร์', 'full_day' => '- ไม่มีรอบบริการ -']],
        ],
        'week2' => [
            'title' => 'สัปดาห์ที่ 2',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'morn' => '-', 'aft' => '-'],
                ['day' => 'พุธ', 'full_day' => 'บ้านท่าประดู่ (10.00 - 15.00 น.)'],
                ['day' => 'พฤหัสบดี', 'morn' => '-', 'aft' => '-'],
                ['day' => 'ศุกร์', 'full_day' => 'บ้านนิคมหน้าเขา (11.00 - 15.00 น.)'],
            ],
        ],
        'week3' => [
            'title' => 'สัปดาห์ที่ 3',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'morn' => '-', 'aft' => '-'],
                ['day' => 'พุธ', 'full_day' => 'แหลมขาม-แหลมไทร (10.30 - 14.30 น.)'],
                ['day' => 'พฤหัสบดี', 'full_day' => 'บ้านบ่อม่วง (10.00 - 14.00 น.)'],
                ['day' => 'ศุกร์', 'full_day' => 'บ้านร่าหมาด (11.00 - 14.30 น.)'],
            ],
        ],
        'week4' => [
            'title' => 'สัปดาห์ที่ 4',
            'schedule' => [
                ['day' => 'จันทร์', 'full_day' => 'บ้านท่ามะพร้าว (10.00 - 15.00 น.)'],
                ['day' => 'อังคาร', 'full_day' => 'บ้านทุ่งครก (10.00 - 15.00 น.)'],
                ['day' => 'พุธ', 'full_day' => 'บ้านห้วยจำปูน (10.00 - 15.00 น.)'],
                ['day' => 'พฤหัสบดี', 'full_day' => 'บ้านทุ่งยอ (11.00 - 14.00 น.)'],
                ['day' => 'ศุกร์', 'full_day' => 'บ้านคลองย่าหนัด (10.00 - 15.00 น.)'],
            ],
        ],
    ];

    // 3. โมบายสุราษฎร์
    $surat = [
        'week1' => [
            'title' => 'สัปดาห์ที่ 1',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'full_day' => 'บ้านสงขลา (10.00 - 15.00 น.)'],
                ['day' => 'พุธ', 'morn' => '-', 'aft' => '-'],
                ['day' => 'พฤหัสบดี', 'morn' => '-', 'aft' => '-'],
                ['day' => 'ศุกร์', 'full_day' => 'บ้านท่าสน (11.30 - 14.00 น.)'],
            ],
        ],
        'week2' => [
            'title' => 'สัปดาห์ที่ 2',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'full_day' => 'บ้านสงขลา (10.00 - 15.00 น.)'],
                ['day' => 'พุธ', 'morn' => '-', 'aft' => '-'],
                ['day' => 'พฤหัสบดี', 'morn' => '-', 'aft' => '-'],
                ['day' => 'ศุกร์', 'full_day' => 'บ้านวังไทร (11.30 - 14.00 น.)'],
            ],
        ],
        'week3' => [
            'title' => 'สัปดาห์ที่ 3',
            'schedule' => [
                ['day' => 'จันทร์', 'morn' => '-', 'aft' => '-'],
                ['day' => 'อังคาร', 'full_day' => 'บ้านสงขลา (10.00 - 15.00 น.)'],
                [
                    'day' => 'พุธ',
                    'morn' => 'บ้านห้วยพุน (10.00 - 12.00 น.)',
                    'aft' => 'บ้านหนองปรือ (13.00 - 14.30 น.)',
                ],
                ['day' => 'พฤหัสบดี', 'full_day' => 'บ้านเกาะมุกข์ (10.00 - 13.00 น.)', 'aft' => '-'],
                ['day' => 'ศุกร์', 'full_day' => 'บ้านส้อง (11.30 - 14.00 น.)'],
            ],
        ],
        'week4' => [
            'title' => 'สัปดาห์ที่ 4',
            'schedule' => [
                ['day' => 'จันทร์', 'full_day' => 'บ้านท่ากระจาย (10.00 - 13.00 น.)', 'aft' => '-'],
                ['day' => 'อังคาร - ศุกร์', 'full_day' => '- ไม่มีรอบบริการ -'],
            ],
        ],
    ];
@endphp

@section('content')
    <div class="bg-white min-h-screen text-gray-800" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

        <div class="container mx-auto px-4 py-16">

            {{-- ส่วนหัว --}}
            <div class="text-center mb-12 transition-all duration-700 ease-out"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                <h1 class="text-4xl md:text-5xl font-extrabold text-green-800 mb-4">
                    หน่วยบริการเคลื่อนที่
                </h1>
                <div class="h-1.5 w-24 bg-green-500 mx-auto rounded-full mb-6"></div>

            </div>

            {{-- แกลเลอรี่รูปรถโมบาย 4 คัน --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16 max-w-7xl mx-auto transition-all duration-700 ease-out"
                style="transition-delay: 200ms" :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">
                <div class="card bg-white shadow-lg border border-gray-100">
                    <figure class="h-48">
                        <img src="{{ asset('images/branch/รถโมบายกระบี่_เหนือคลอง.jpg') }}" alt="กระบี่-เหนือคลอง"
                            class="w-full h-full object-cover">
                    </figure>
                    <div class="card-body p-4 text-center bg-green-50">
                        <h3 class="font-bold text-green-800">1. โมบายกระบี่-เหนือคลอง</h3>
                    </div>
                </div>
                <div class="card bg-white shadow-lg border border-gray-100">
                    <figure class="h-48">
                        <img src="{{ asset('images/branch/รถโมบายคลองท่อม_เกาะลันตา.jpg') }}"
                            alt="คลองท่อม-เกาะลันตาบางส่วน" class="w-full h-full object-cover">
                    </figure>
                    <div class="card-body p-4 text-center bg-green-50">
                        <h3 class="font-bold text-green-800">2. คลองท่อม-เกาะลันตาบางส่วน</h3>
                    </div>
                </div>
                <div class="card bg-white shadow-lg border border-gray-100">
                    <figure class="h-48">
                        <img src="{{ asset('images/branch/รถโมบายกาญจนดิษฐ์.jpg') }}" alt="โมบายสุราษฎร์"
                            class="w-full h-full object-cover">
                    </figure>
                    <div class="card-body p-4 text-center bg-green-50">
                        <h3 class="font-bold text-green-800">3. โมบายสุราษฎร์</h3>
                    </div>
                </div>
                <div class="card bg-white shadow-lg border border-gray-100">
                    <figure class="h-48">
                        <img src="{{ asset('images/branch/รถโมบายเกาะลันตา.jpg') }}" alt="โมบายเกาะลันตา"
                            class="w-full h-full object-cover">
                    </figure>
                    <div class="card-body p-4 text-center bg-green-50">
                        <h3 class="font-bold text-green-800">4. โมบายเกาะลันตา</h3>
                    </div>
                </div>
            </div>

            {{-- ส่วนของ Tab ข้อมูลตาราง --}}
            <div x-data="{ activeTab: 'krabiNueaKhlong' }" class="max-w-7xl mx-auto">

                {{-- ปุ่มสลับ Tab ทั้ง 4 --}}
                <div class="flex justify-center mb-8 flex-wrap">
                    <div
                        class="tabs tabs-boxed bg-green-50 p-2 rounded-2xl shadow-inner gap-2 border border-green-100 flex-wrap justify-center">
                        <a @click="activeTab = 'krabiNueaKhlong'"
                            class="tab tab-lg rounded-xl transition-all duration-300 font-bold"
                            :class="activeTab === 'krabiNueaKhlong' ? 'tab-active bg-green-600 text-white shadow-md' :
                                'text-gray-600 hover:text-green-700 bg-transparent'">
                            <i class="fas fa-truck mr-2"></i> กระบี่-เหนือคลอง
                        </a>
                        <a @click="activeTab = 'khlongThomLanta'"
                            class="tab tab-lg rounded-xl transition-all duration-300 font-bold"
                            :class="activeTab === 'khlongThomLanta' ? 'tab-active bg-green-600 text-white shadow-md' :
                                'text-gray-600 hover:text-green-700 bg-transparent'">
                            <i class="fas fa-truck mr-2"></i> คลองท่อม-เกาะลันตาบางส่วน
                        </a>
                        <a @click="activeTab = 'surat'" class="tab tab-lg rounded-xl transition-all duration-300 font-bold"
                            :class="activeTab === 'surat' ? 'tab-active bg-green-600 text-white shadow-md' :
                                'text-gray-600 hover:text-green-700 bg-transparent'">
                            <i class="fas fa-truck mr-2"></i> โมบายสุราษฎร์
                        </a>
                        <a @click="activeTab = 'lanta'" class="tab tab-lg rounded-xl transition-all duration-300 font-bold"
                            :class="activeTab === 'lanta' ? 'tab-active bg-green-600 text-white shadow-md' :
                                'text-gray-600 hover:text-green-700 bg-transparent'">
                            <i class="fas fa-truck mr-2"></i> โมบายเกาะลันตา
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden relative min-h-[400px]">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-green-600"></div>

                    {{-- TAB 1: กระบี่-เหนือคลอง --}}
                    <div x-show="activeTab === 'krabiNueaKhlong'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="p-6 md:p-10" style="display:none;">
                        <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8">ตารางเดินรถ
                            โมบายกระบี่-เหนือคลอง</h3>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                            @foreach ($krabiNueaKhlong as $weekData)
                                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                                    <div class="bg-green-50 p-4 border-b border-green-100 flex flex-col items-center">
                                        <h4 class="font-bold text-lg text-green-800"><i
                                                class="far fa-calendar-check mr-2"></i> {{ $weekData['title'] }}</h4>
                                        @if (isset($weekData['note']))
                                            <span
                                                class="text-xs text-red-600 mt-1 font-semibold">{{ $weekData['note'] }}</span>
                                        @endif
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm w-full text-center">
                                            <thead class="bg-gray-50 border-b border-gray-200">
                                                <tr>
                                                    <th class="w-20 text-gray-700 font-bold border-r">วัน</th>
                                                    <th class="text-blue-600 font-bold border-r w-1/2"><i
                                                            class="fas fa-sun mr-1"></i> ภาคเช้า</th>
                                                    <th class="text-orange-500 font-bold w-1/2"><i
                                                            class="fas fa-cloud-sun mr-1"></i> ภาคบ่าย</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600">
                                                @foreach ($weekData['schedule'] as $item)
                                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                                        <td class="font-semibold text-green-700 bg-white border-r">
                                                            {{ $item['day'] }}</td>
                                                        @if (isset($item['full_day']))
                                                            <td colspan="2"
                                                                class="text-gray-800 font-medium bg-green-50/30">
                                                                {{ $item['full_day'] }}</td>
                                                        @else
                                                            <td class="text-gray-700 border-r">{{ $item['morn'] }}</td>
                                                            <td class="text-gray-700">{{ $item['aft'] }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- TAB 2: คลองท่อม-เกาะลันตาบางส่วน --}}
                    <div x-show="activeTab === 'khlongThomLanta'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="p-6 md:p-10" style="display:none;">
                        <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8">ตารางเดินรถ
                            โมบายคลองท่อม-เกาะลันตาบางส่วน</h3>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                            @foreach ($khlongThomLanta as $weekData)
                                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                                    <div class="bg-green-50 p-4 border-b border-green-100 flex justify-center">
                                        <h4 class="font-bold text-lg text-green-800"><i
                                                class="far fa-calendar-check mr-2"></i> {{ $weekData['title'] }}</h4>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm w-full text-center">
                                            <thead class="bg-gray-50 border-b border-gray-200">
                                                <tr>
                                                    <th class="w-24 text-gray-700 font-bold border-r">วัน</th>
                                                    <th class="text-blue-600 font-bold border-r w-1/2"><i
                                                            class="fas fa-sun mr-1"></i> ภาคเช้า</th>
                                                    <th class="text-orange-500 font-bold w-1/2"><i
                                                            class="fas fa-cloud-sun mr-1"></i> ภาคบ่าย</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600">
                                                @foreach ($weekData['schedule'] as $item)
                                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                                        <td class="font-semibold text-green-700 bg-white border-r">
                                                            {{ $item['day'] }}</td>
                                                        @if (isset($item['full_day']))
                                                            <td colspan="2"
                                                                class="text-gray-800 font-medium bg-green-50/30">
                                                                {{ $item['full_day'] }}</td>
                                                        @else
                                                            <td class="text-gray-700 border-r">{{ $item['morn'] }}</td>
                                                            <td class="text-gray-700">{{ $item['aft'] }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- TAB 3: โมบายสุราษฎร์ --}}
                    <div x-show="activeTab === 'surat'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="p-6 md:p-10" style="display:none;">
                        <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8">ตารางเดินรถ โมบายสุราษฎร์
                        </h3>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                            @foreach ($surat as $weekData)
                                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                                    <div class="bg-green-50 p-4 border-b border-green-100 flex justify-center">
                                        <h4 class="font-bold text-lg text-green-800"><i
                                                class="far fa-calendar-check mr-2"></i> {{ $weekData['title'] }}</h4>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm w-full text-center">
                                            <thead class="bg-gray-50 border-b border-gray-200">
                                                <tr>
                                                    <th class="w-20 text-gray-700 font-bold border-r">วัน</th>
                                                    <th class="text-blue-600 font-bold border-r w-1/2"><i
                                                            class="fas fa-sun mr-1"></i> ภาคเช้า</th>
                                                    <th class="text-orange-500 font-bold w-1/2"><i
                                                            class="fas fa-cloud-sun mr-1"></i> ภาคบ่าย</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600">
                                                @foreach ($weekData['schedule'] as $item)
                                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                                        <td class="font-semibold text-green-700 bg-white border-r">
                                                            {{ $item['day'] }}</td>
                                                        @if (isset($item['full_day']))
                                                            <td colspan="2"
                                                                class="text-gray-800 font-medium bg-green-50/30">
                                                                {{ $item['full_day'] }}</td>
                                                        @else
                                                            <td class="text-gray-700 border-r">{!! nl2br(e($item['morn'])) !!}</td>
                                                            <td class="text-gray-700">{!! nl2br(e($item['aft'])) !!}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- TAB 4: โมบายเกาะลันตา --}}
                    <div x-show="activeTab === 'lanta'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="p-6 md:p-10" style="display:none;">
                        <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-8">ตารางเดินรถ
                            โมบายเกาะลันตา</h3>

                        <div
                            class="max-w-3xl mx-auto bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                            <div class="bg-blue-50 p-6 border-b border-blue-100">
                                <h4
                                    class="font-bold text-xl text-blue-800 text-center flex items-center justify-center gap-2">
                                    <i class="far fa-calendar-alt"></i> สัปดาห์สุดท้ายของเดือน
                                </h4>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="table w-full text-center">
                                    <thead class="bg-gray-50 border-b border-gray-200 text-base">
                                        <tr>
                                            <th class="w-32 text-gray-700 font-bold border-r">วันที่</th>
                                            <th class="text-blue-600 font-bold border-r w-1/2"><i
                                                    class="fas fa-sun mr-1"></i> ภาคเช้า</th>
                                            <th class="text-orange-500 font-bold w-1/2"><i
                                                    class="fas fa-cloud-sun mr-1"></i> ภาคบ่าย</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700 text-base">
                                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                                            <td class="font-bold text-blue-700 bg-white border-r py-4">ทุกวันที่ 27</td>
                                            <td class="border-r py-4">
                                                <div class="font-semibold">บ้านคลองนิน (09.30 - 10.00 น.)</div>
                                                <div class="font-semibold text-gray-500 mt-2">บ้านสีรายา (10.30 - 12.30 น.)
                                                </div>
                                            </td>
                                            <td class="py-4 text-gray-400">-</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                                            <td class="font-bold text-blue-700 bg-white border-r py-4">ทุกวันที่ 28</td>
                                            <td class="border-r py-4">
                                                <div class="font-semibold">บ้านหลังสอด (11.00 - 12.00 น.)</div>
                                            </td>
                                            <td class="py-4">
                                                <div class="font-semibold">บ้านโล๊ะใหญ่ (13.00 - 15.00 น.)</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
