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
        'week1' => [ 'title' => 'สัปดาห์ที่ 1 ของเดือน', 'schedule' => [ ['day' => 'จันทร์', 'am' => null, 'pm' => null], ['day' => 'อังคาร', 'am' => null, 'pm' => 'ตลาดนัดหน้า รร.บ้านช่องไม้เรียว'], ['day' => 'พุธ', 'am' => null, 'pm' => null], ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'], ['day' => 'ศุกร์', 'am' => null, 'pm' => null], ], ],
        'week2' => [ 'title' => 'สัปดาห์ที่ 2 ของเดือน', 'schedule' => [ ['day' => 'จันทร์', 'am' => null, 'pm' => null], ['day' => 'อังคาร', 'am' => null, 'pm' => 'ตลาดนัดหน้า รร.บ้านช่องไม้เรียว'], ['day' => 'พุธ', 'am' => 'บ้านร่าหมาด', 'pm' => 'บ้านร่าหมาด'], ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'], ['day' => 'ศุกร์', 'am' => null, 'pm' => 'บ้านโคนกหน้าเขา'], ], ],
        'week3' => [ 'title' => 'สัปดาห์ที่ 3 ของเดือน', 'schedule' => [ ['day' => 'จันทร์', 'am' => null, 'pm' => null], ['day' => 'อังคาร', 'am' => 'มัสยิดบ้านหัวประดู', 'pm' => 'มัสยิดบ้านหัวประดู'], ['day' => 'พุธ', 'am' => 'บ้านแหลมไทร', 'pm' => 'บ้านแหลมไทร'], ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'], ['day' => 'ศุกร์', 'am' => null, 'pm' => 'มัสยิดบ้านม่วง'], ], ],
        'week4' => [ 'title' => 'สัปดาห์ที่ 4 ของเดือน', 'schedule' => [ ['day' => 'จันทร์', 'am' => 'บ้านเกาะปู', 'pm' => null], ['day' => 'อังคาร', 'am' => 'บ้านทุ่งครก', 'pm' => 'บ้านทุ่งครก'], ['day' => 'พุธ', 'am' => 'บ้านห้วยน้ำปูน', 'pm' => 'บ้านห้วยน้ำปูน'], ['day' => 'พฤหัสบดี', 'am' => 'ตลาดนัดทรายขาว', 'pm' => 'ตลาดนัดทรายขาว'], ['day' => 'ศุกร์', 'am' => null, 'pm' => null], ], ],
    ];
@endphp

@section('content')
<div class="bg-gray-100" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">
    <div class="container mx-auto px-4 py-16">

        <div class="text-center mb-12 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-lime-500 mb-4">
                หน่วยบริการเคลื่อนที่
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                อำนวยความสะดวกให้บริการทางการเงินแก่สมาชิกในพื้นที่ต่างๆ ตามตารางเวลาประจำเดือน
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 transition-all duration-700 ease-out" style="transition-delay: 200ms" :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">
            <img src="{{ asset('images/branch/mo1.jpg') }}" alt="Mobile Unit 1" class="rounded-2xl shadow-xl w-full h-64 object-cover" loading="lazy">
            <img src="{{ asset('images/branch/mo2.jpg') }}" alt="Mobile Unit 2" class="rounded-2xl shadow-xl w-full h-64 object-cover" loading="lazy">
        </div>

        <div x-data="{ activeTab: 'mobile1' }">
            <div class="border-b border-gray-300 mb-8">
                <nav class="-mb-px flex justify-center gap-6" aria-label="Tabs">
                    <button @click="activeTab = 'mobile1'" :class="activeTab === 'mobile1' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-4 font-bold text-xl transition-colors">
                        รถบริการเคลื่อนที่ 1 (โมบาย)
                    </button>
                    <button @click="activeTab = 'mobile2'" :class="activeTab === 'mobile2' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-4 font-bold text-xl transition-colors">
                        รถบริการเคลื่อนที่ 2 (โมบาย)
                    </button>
                </nav>
            </div>

            <div class="mt-8">
                <div x-show="activeTab === 'mobile1'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8">
                        <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-6">ตารางให้บริการโดยรถบริการเคลื่อนที่โมบาย</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-green-100 text-green-800 text-base">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 rounded-l-xl font-bold">วัน</th>
                                        <th scope="col" class="px-6 py-4 font-bold">09.30-10.30</th>
                                        <th scope="col" class="px-6 py-4 font-bold">13.30-15.30</th>
                                        <th scope="col" class="px-6 py-4 rounded-r-xl font-bold">15.30-16.30</th>
                                    </tr>
                                </thead>
                                <tbody class="text-base text-gray-700">
                                    @foreach($mobileUnit1Schedule as $item)
                                    <tr class="border-b border-gray-200">
                                        <td class="px-6 py-4 font-bold">{{ $item['day'] }}</td>
                                        <td class="px-6 py-4">{{ $item['t1'] ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $item['t2'] ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $item['t3'] ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="text-base text-red-600 mt-6 p-2"><strong>*หมายเหตุ:</strong> วันจันทร์ วันอังคาร วันพุธ เดินทางไปตามลำดับก่อนหลัง / ในระหว่างเดือนมีการปรับเปลี่ยนตามความเหมาะสม</p>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'mobile2'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display:none;">
                    <h3 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-6">ตารางให้บริการโดยรถบริการเคลื่อนที่นโยบาย</h3>
                     <div class="grid grid-cols-1 gap-10">
                        @foreach($mobileUnit2Schedule as $weekData)
                        <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 transition-all duration-500 ease-out opacity-0"
                             :class="loaded && activeTab === 'mobile2' ? 'opacity-100 translate-y-0' : 'translate-y-5'"
                             style="transition-delay: {{ ($loop->index * 100) + 200 }}ms">
                            <h4 class="font-bold text-xl text-center mb-4 text-green-700">{{ $weekData['title'] }}</h4>
                             <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-green-100 text-green-800 text-base">
                                        <tr>
                                            <th class="px-6 py-4 rounded-l-xl font-bold">วัน</th>
                                            <th class="px-6 py-4 font-bold">10.00-12.00</th>
                                            <th class="px-6 py-4 rounded-r-xl font-bold">13.30-15.30</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-base text-gray-700">
                                        @foreach($weekData['schedule'] as $item)
                                        <tr class="border-b border-gray-200">
                                            <td class="px-6 py-4 font-semibold">{{ $item['day'] }}</td>
                                            <td class="px-6 py-4">{{ $item['am'] ?? '-' }}</td>
                                            <td class="px-6 py-4">{{ $item['pm'] ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                     </div>
                      <p class="text-base text-red-600 mt-8 text-center"><strong>*หมายเหตุ:</strong> อาจมีการเปลี่ยนแปลงตามความเหมาะสม</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
