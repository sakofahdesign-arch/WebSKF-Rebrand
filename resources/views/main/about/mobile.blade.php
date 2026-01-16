@extends('layouts.layout')
@section('title', 'หน่วยบริการเคลื่อนที่')

@php
    // Data for Mobile Unit 1 Schedule
    $mobileUnit1Schedule = [
        ['day' => 'จันทร์', 't1' => null, 't2' => null, 't3' => 'ตลาดเก่า บขส.'],
        ['day' => 'อังคาร', 't1' => null, 't2' => 'หน้ามัสยิดบ้านเขากลม', 't3' => null],
        ['day' => 'พุธ', 't1' => 'บ้านอ่าวน้ำ (ตรงข้ามมัสยิด)', 't2' => null, 't3' => 'ตลาดต้องชม (หนองทะเล)'],
        ['day' => 'พฤหัสบดี', 't1' => null, 't2' => 'อ่าวนาง หน้าฟ้าไทย', 't3' => 'ตลาดคลองแห้ง (ฟาร์มปูเก่า)'],
        ['day' => 'ศุกร์', 't1' => 'ตลาดคลองยวน', 't2' => 'บ้านแหลมหิน', 't3' => null],
    ];

    // Data for Mobile Unit 2 Schedule (Weekly)
    $mobileUnit2Schedule = [
        'week1' => [
            'title' => 'สัปดาห์ที่ 1 ของเดือน',
            'schedule' => [
                ['day' => 'จันทร์', 'am' => null, 'pm' => null],
                ['day' => 'อังคาร', 'am' => null, 'pm' => 'ตลาดนัดหน้า รร.บ้านช่องไม้เรียว'],
                ['day' => 'พุธ', 'am' => null, 'pm' => null],
                ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'],
                ['day' => 'ศุกร์', 'am' => null, 'pm' => null],
            ],
        ],
        'week2' => [
            'title' => 'สัปดาห์ที่ 2 ของเดือน',
            'schedule' => [
                ['day' => 'จันทร์', 'am' => null, 'pm' => null],
                ['day' => 'อังคาร', 'am' => null, 'pm' => 'ตลาดนัดหน้า รร.บ้านช่องไม้เรียว'],
                ['day' => 'พุธ', 'am' => 'บ้านร่าหมาด', 'pm' => 'บ้านร่าหมาด'],
                ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'],
                ['day' => 'ศุกร์', 'am' => null, 'pm' => 'บ้านโคนกหน้าเขา'],
            ],
        ],
        'week3' => [
            'title' => 'สัปดาห์ที่ 3 ของเดือน',
            'schedule' => [
                ['day' => 'จันทร์', 'am' => null, 'pm' => null],
                ['day' => 'อังคาร', 'am' => 'มัสยิดบ้านหัวประดู', 'pm' => 'มัสยิดบ้านหัวประดู'],
                ['day' => 'พุธ', 'am' => 'บ้านแหลมไทร', 'pm' => 'บ้านแหลมไทร'],
                ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'],
                ['day' => 'ศุกร์', 'am' => null, 'pm' => 'มัสยิดบ้านม่วง'],
            ],
        ],
        'week4' => [
            'title' => 'สัปดาห์ที่ 4 ของเดือน',
            'schedule' => [
                ['day' => 'จันทร์', 'am' => 'บ้านเกาะปู', 'pm' => null],
                ['day' => 'อังคาร', 'am' => 'บ้านทุ่งครก', 'pm' => 'บ้านทุ่งครก'],
                ['day' => 'พุธ', 'am' => 'บ้านห้วยน้ำปูน', 'pm' => 'บ้านห้วยน้ำปูน'],
                ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'],
                ['day' => 'ศุกร์', 'am' => null, 'pm' => null],
            ],
        ],
    ];
@endphp

@section('content')
    {{-- ใช้ data-theme="light" ครอบไว้เพื่อบังคับ DaisyUI ให้ใช้ธีมสว่างเสมอ --}}
    <div class="bg-white min-h-screen text-gray-800" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

        <div class="container mx-auto px-4 py-16">

            <div class="text-center mb-12 transition-all duration-700 ease-out"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                <h1 class="text-4xl md:text-5xl font-extrabold text-green-800 mb-4">
                    หน่วยบริการเคลื่อนที่
                </h1>
                <div class="h-1.5 w-24 bg-green-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    อำนวยความสะดวกให้บริการทางการเงินแก่สมาชิกในพื้นที่ต่างๆ ใกล้บ้านท่าน
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 max-w-5xl mx-auto transition-all duration-700 ease-out"
                style="transition-delay: 200ms" :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">

                <div class="hover-3d">
                    <div
                        class="card bg-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden border border-gray-100">
                        <figure class="h-64">
                            <img src="{{ asset('images/branch/mo1.jpg') }}" alt="Mobile Unit 1"
                                class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-700">
                        </figure>
                        <div class="card-body p-4 text-center">
                            <h3 class="font-bold text-gray-700">รถโมบายคันที่ 1</h3>
                        </div>
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div class="hover-3d">
                    <div
                        class="card bg-white shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden border border-gray-100">
                        <figure class="h-64">
                            <img src="{{ asset('images/branch/mo2.jpg') }}" alt="Mobile Unit 2"
                                class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-700">
                        </figure>
                        <div class="card-body p-4 text-center">
                            <h3 class="font-bold text-gray-700">รถโมบายคันที่ 2</h3>
                        </div>
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>


            <div x-data="{ activeTab: 'mobile1' }" class="max-w-6xl mx-auto">

                <div class="flex justify-center mb-8">
                    <div class="tabs tabs-boxed bg-green-50 p-2 rounded-2xl shadow-inner gap-2 border border-green-100">
                        <a @click="activeTab = 'mobile1'"
                            class="tab tab-lg rounded-xl transition-all duration-300 font-bold"
                            :class="activeTab === 'mobile1' ? 'tab-active bg-green-600 text-white shadow-md' :
                                'text-gray-600 hover:text-green-700 bg-transparent'">
                            <i class="fas fa-truck mr-2"></i> รถโมบาย 1
                        </a>
                        <a @click="activeTab = 'mobile2'"
                            class="tab tab-lg rounded-xl transition-all duration-300 font-bold"
                            :class="activeTab === 'mobile2' ? 'tab-active bg-green-600 text-white shadow-md' :
                                'text-gray-600 hover:text-green-700 bg-transparent'">
                            <i class="fas fa-truck-moving mr-2"></i> รถโมบาย 2
                        </a>
                    </div>
                </div>

                {{-- บังคับ bg-white ที่นี่ --}}
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden relative min-h-[400px]">

                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-blue-500"></div>

                    <div x-show="activeTab === 'mobile1'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="p-6 md:p-10">

                        <div class="flex items-center justify-center gap-3 mb-8">
                            <div
                                class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i class="fas fa-calendar-alt text-xl"></i>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-800">ตารางเดินรถโมบาย (คันที่ 1)</h3>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm">
                            {{-- ใช้ text-gray-700 เพื่อป้องกันสีขาวใน dark mode --}}
                            <table class="table table-zebra table-lg w-full text-gray-700">
                                <thead class="bg-green-600 text-white text-base">
                                    <tr>
                                        <th class="rounded-tl-xl font-bold text-white"><i class="fas fa-sun mr-2"></i>วัน
                                        </th>
                                        <th class="font-bold text-white"><i class="far fa-clock mr-2"></i>09.30 - 10.30 น.
                                        </th>
                                        <th class="font-bold text-white"><i class="far fa-clock mr-2"></i>13.30 - 15.30 น.
                                        </th>
                                        <th class="rounded-tr-xl font-bold text-white"><i
                                                class="far fa-clock mr-2"></i>15.30 - 16.30 น.</th>
                                    </tr>
                                </thead>
                                <tbody class="text-base">
                                    @foreach ($mobileUnit1Schedule as $item)
                                        <tr class="hover:bg-green-50 transition-colors border-b border-gray-100">
                                            <td class="font-bold text-green-700 bg-white">{{ $item['day'] }}</td>
                                            <td class="text-gray-700">{{ $item['t1'] ?? '-' }}</td>
                                            <td class="text-gray-700">{{ $item['t2'] ?? '-' }}</td>
                                            <td class="text-gray-700">{{ $item['t3'] ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="alert bg-red-50 border border-red-200 mt-6 text-red-700 shadow-sm rounded-lg flex items-start gap-3">
                            <i class="fas fa-info-circle mt-1 text-red-600"></i>
                            <span class="text-red-800"><strong>หมายเหตุ:</strong> วันจันทร์-พุธ เดินทางไปตามลำดับก่อนหลัง /
                                ตารางอาจมีการเปลี่ยนแปลงตามความเหมาะสม</span>
                        </div>
                    </div>

                    <div x-show="activeTab === 'mobile2'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="p-6 md:p-10" style="display:none;">

                        <div class="flex items-center justify-center gap-3 mb-8">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-calendar-alt text-xl"></i>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-800">ตารางเดินรถโมบาย (คันที่ 2)</h3>
                        </div>

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                            @foreach ($mobileUnit2Schedule as $weekData)
                                {{-- บังคับ bg-white --}}
                                <div
                                    class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                                    <div class="bg-green-50 p-4 border-b border-green-100">
                                        <h4
                                            class="font-bold text-lg text-green-800 text-center flex items-center justify-center gap-2">
                                            <i class="far fa-calendar-check"></i> {{ $weekData['title'] }}
                                        </h4>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm w-full">
                                            <thead class="bg-gray-50 border-b border-gray-200">
                                                <tr>
                                                    <th class="pl-4 text-gray-600 font-bold">วัน</th>
                                                    <th class="text-gray-600 font-bold">10.00-12.00</th>
                                                    <th class="pr-4 text-gray-600 font-bold">13.30-15.30</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600">
                                                @foreach ($weekData['schedule'] as $item)
                                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                                        <td class="font-semibold text-green-700 pl-4 bg-white">
                                                            {{ $item['day'] }}</td>
                                                        <td class="text-gray-700">{{ $item['am'] ?? '-' }}</td>
                                                        <td class="pr-4 text-gray-700">{{ $item['pm'] ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div
                            class="alert bg-yellow-50 border border-yellow-200 mt-8 text-yellow-800 shadow-sm rounded-lg flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle mt-1 text-yellow-600"></i>
                            <span class="text-yellow-900"><strong>หมายเหตุ:</strong> ตารางอาจมีการเปลี่ยนแปลงตามความเหมาะสม
                                กรุณาสอบถามเจ้าหน้าที่ก่อนใช้บริการ</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
