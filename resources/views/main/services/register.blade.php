@extends('layouts.layout')
@section('title', 'สมัครสมาชิก')

@php
    $steps = [
        [
            'step' => '01',
            'title' => 'คุณสมบัติและเงื่อนไข',
            'icon' => '<i class="fas fa-file-contract text-2xl"></i>',
            'content_type' => 'conditions',
            'conditions' => [
                'เปิดบัญชีครั้งแรกไม่ต่ำกว่า <strong class="text-green-700">200 บาท</strong>',
                'ค่าธรรมเนียมแรกเข้า <strong class="text-green-700">100 บาท</strong> (ครั้งเดียว)',
                'สมทบกองทุนสวัสดิการ <strong class="text-green-700">100 บาท</strong>',
                'ฝากประจำรายเดือนขั้นต่ำ <strong class="text-green-700">200 บาท</strong>',
            ],
            'image' => 'images/sakofah_book.png',
        ],
        [
            'step' => '02',
            'title' => 'สิทธิประโยชน์สมาชิก',
            'icon' => '<i class="fas fa-gift text-2xl"></i>',
            'content_type' => 'benefits',
            'benefits' => [
                ['icon' => 'fas fa-hand-holding-heart', 'title' => 'สวัสดิการครบวงจร', 'description' => 'ยื่นขอสวัสดิการต่างๆ ได้เมื่อฝากครบ 6 เดือน', 'color' => 'blue'],
                ['icon' => 'fas fa-hand-holding-usd', 'title' => 'บริการสินเชื่อ', 'description' => 'สิทธิ์ยื่นขอสินเชื่อเมื่อเป็นสมาชิกครบ 12 เดือน', 'color' => 'cyan'],
                ['icon' => 'fas fa-chart-line', 'title' => 'เงินปันผลประจำปี', 'description' => 'รับเงินปันผลและเฉลี่ยคืนตามผลประกอบการ', 'color' => 'yellow'],
            ],
        ],
        [
            'step' => '03',
            'title' => 'เริ่มต้นสมัครสมาชิก',
            'icon' => '<i class="fas fa-pen-fancy text-2xl"></i>',
            'content_type' => 'action',
            'video_url' => 'https://www.youtube.com/embed/TY-o6-CDB3Q',
        ],
    ];
@endphp

@section('content')
<div class="bg-white min-h-screen pb-20" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">

    <div class="relative bg-green-50 py-20 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-green-100 opacity-50 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-100 opacity-50 blur-3xl"></div>

        <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-800 mb-6 leading-tight">
                ร่วมเป็นส่วนหนึ่งกับ<span class="text-green-600">เรา</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                เริ่มต้นเส้นทางสู่ความมั่นคงทางการเงินและคุณภาพชีวิตที่ดียิ่งขึ้น กับครอบครัวสหกรณ์ออมทรัพย์ษะกอฟะฮ
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 max-w-5xl">
        <div class="relative">
            <div class="hidden md:block absolute left-[3.5rem] top-0 bottom-0 w-1 bg-gradient-to-b from-green-500 via-green-200 to-transparent z-0"></div>

            <div class="space-y-16">
                @foreach($steps as $index => $item)
                    <div class="relative z-10 group transition-all duration-700 ease-out"
                         style="transition-delay: {{ $index * 200 }}ms"
                         :class="loaded ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">

                        <div class="flex flex-col md:flex-row gap-8 items-start">

                            <div class="flex-shrink-0 flex items-center justify-center w-28 h-28 mx-auto md:mx-0">
                                <div class="w-full h-full rounded-full bg-white border-4 border-green-100 shadow-xl flex flex-col items-center justify-center text-green-600 relative overflow-hidden group-hover:scale-110 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-green-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <span class="text-3xl font-black z-10">{{ $item['step'] }}</span>
                                    <div class="z-10 mt-1">{!! $item['icon'] !!}</div>
                                </div>
                            </div>

                            <div class="flex-grow w-full">
                                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center md:text-left flex items-center justify-center md:justify-start gap-3">
                                    {{ $item['title'] }}
                                    <div class="h-1 flex-grow bg-gray-100 rounded-full ml-4 hidden md:block"></div>
                                </h2>

                                @if($item['content_type'] === 'conditions')
                                    <div class="card md:card-side bg-white shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                                        <figure class="md:w-2/5 bg-gray-50 p-6 flex items-center justify-center">
                                            <img src="{{ asset($item['image']) }}" alt="Book" class="max-w-[180px] shadow-lg transform rotate-3 hover:rotate-0 transition-transform duration-500">
                                        </figure>
                                        <div class="card-body md:w-3/5 p-6 md:p-8">
                                            <ul class="space-y-4">
                                                @foreach($item['conditions'] as $condition)
                                                    <li class="flex items-start gap-3 p-3 rounded-lg hover:bg-green-50 transition-colors">
                                                        <i class="fas fa-check-circle text-green-500 text-xl mt-1 flex-shrink-0"></i>
                                                        <span class="text-gray-700 text-lg">{!! $condition !!}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if($item['content_type'] === 'benefits')
                                    <div class="grid md:grid-cols-3 gap-6">
                                        @foreach($item['benefits'] as $benefit)
                                            @php
                                                $colors = [
                                                    'blue' => 'border-blue-200 bg-blue-50 text-blue-600 hover:border-blue-400',
                                                    'cyan' => 'border-cyan-200 bg-cyan-50 text-cyan-600 hover:border-cyan-400',
                                                    'yellow' => 'border-yellow-200 bg-yellow-50 text-yellow-600 hover:border-yellow-400',
                                                ];
                                                $theme = $colors[$benefit['color']] ?? $colors['blue'];
                                            @endphp
                                            <div class="card bg-white shadow-lg border-b-4 hover:-translate-y-2 transition-all duration-300 {{ $theme }}">
                                                <div class="card-body p-6 text-center">
                                                    <div class="w-14 h-14 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center mb-3">
                                                        <i class="{{ $benefit['icon'] }} text-2xl"></i>
                                                    </div>
                                                    <h3 class="card-title justify-center text-gray-800 mb-2">{{ $benefit['title'] }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $benefit['description'] }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if($item['content_type'] === 'action')
                                    <div class="card bg-white shadow-xl overflow-hidden border border-gray-100">
                                        <div class="grid md:grid-cols-2">
                                            <div class="relative bg-gray-900 aspect-video md:aspect-auto">
                                                <iframe class="w-full h-full absolute inset-0" src="{{ $item['video_url'] }}" title="Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                            <div class="p-8 md:p-10 flex flex-col justify-center items-center text-center bg-gradient-to-br from-green-50 to-white">
                                                <h3 class="text-2xl font-bold text-gray-800 mb-3">พร้อมเริ่มต้นกับเราไหม?</h3>
                                                <p class="text-gray-600 mb-8">ดาวน์โหลดใบสมัคร กรอกข้อมูล และยื่นเอกสารได้ที่สาขาใกล้บ้านท่าน</p>

                                                <a href="{{asset('file/form/ใบคำขอสมัครสมาชิก INFORM 68-001.pdf')}}" target="_blank" class="btn btn-primary btn-lg rounded-full px-8 shadow-lg hover:shadow-green-200 hover:scale-105 transition-all text-white border-none bg-green-600 hover:bg-green-700">
                                                    <i class="fas fa-file-download mr-2"></i> ดาวน์โหลดใบสมัคร
                                                </a>

                                                <div class="mt-6 text-sm text-gray-400">
                                                    <i class="fas fa-info-circle mr-1"></i> ไฟล์ PDF ขนาด 2MB
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="hidden md:block absolute left-[3.3rem] bottom-0 w-3 h-3 bg-gray-300 rounded-full"></div>
        </div>
    </div>
</div>
@endsection
