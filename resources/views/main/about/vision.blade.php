@extends('layouts.layout')
@section('title', 'วิสัยทัศน์ พันธกิจ และวัตถุประสงค์')
@php
    $vision = [
        'title' => 'สหกรณ์ออมทรัพย์ต้นแบบ',
        'subtitle' => 'เป็นองค์กรที่ก้าวหน้า มั่นคง และมีธรรมาภิบาล',
        'full_text' =>
            'สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด เป็นองค์กรที่ก้าวหน้าและมั่นคง มีธรรมาภิบาล เป็นที่ยอมรับ และเป็นส่วนหนึ่งของวิถีชีวิตผู้คน',
    ];

    $missions = [
        'บริหารจัดการเงินทุนให้เกิดผลกำไรสูงสุด บนพื้นฐานธรรมาภิบาลและหลักการอิสลาม',
        'มุ่งเน้นการบริการและกิจกรรมที่เป็นไปตามหลักอิสลาม',
        'พัฒนาบุคลากรให้มีความสามารถ เชี่ยวชาญและมีคุณธรรม',
        'บริหารจัดการให้มีระบบงานที่ดี เพื่อเพิ่มประสิทธิภาพและประสิทธิผล',
    ];

    $core_values = [
        [
            'name' => 'Simple',
            'description' => 'สะดวก ทันสมัย มีนวัตกรรม ในการให้บริการของลูกค้า',
            'svg' =>
                '<svg class="h-14 w-14 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 01-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 013.09-3.09L12 5.25l2.846.813a4.5 4.5 0 013.09 3.09L21.75 12l-2.846.813a4.5 4.5 0 01-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.553L16.5 21.75l-.398-1.197a3.375 3.375 0 00-2.456-2.456L12.75 18l1.197-.398a3.375 3.375 0 002.456-2.456L16.5 14.25l.398 1.197a3.375 3.375 0 002.456 2.456L20.25 18l-1.197.398a3.375 3.375 0 00-2.456 2.456z" /></svg>',
        ],
        [
            'name' => 'Knowledge',
            'description' => 'องค์ความรู้สู่ชาติอิสลาม องค์ความรู้สู่การอยู่ดีมีคุณธรรม',
            'svg' =>
                '<svg class="h-14 w-14 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>',
        ],
        [
            'name' => 'Fast',
            'description' => 'รวดเร็ว ทันเวลา ตอบโจทย์ลูกค้า',
            'svg' =>
                '<svg class="h-14 w-14 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>',
        ],
        [
            'name' => 'Honesty',
            'description' => 'โปร่งใส ตรวจสอบได้',
            'svg' =>
                '<svg class="h-14 w-14 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" /></svg>',
        ],
    ];

    $strategy = [
        'phase1' => [
            'years' => 'ปี 2565-2567',
            'points' => [
                'เป็นองค์กรที่มุ่งเน้นการเพิ่มทุน เพื่อพัฒนาการให้บริการทางการเงินที่มั่นคง',
                'เป็นองค์กรที่มุ่งเน้นการเพิ่มปริมาณเงินฝากที่มั่นคงเพื่อเพิ่มสภาพคล่องในการลงทุน',
                'เป็นองค์กรที่มุ่งเน้นการบริหารจัดการสินทรัพย์ด้อยคุณภาพให้เกิดผลในระดับที่น่าพอใจ',
                'เป็นองค์กรที่มุ่งเน้นการเพิ่มปริมาณสมาชิกใหม่ให้เป็นไปตามขนาด',
            ],
        ],
        'phase2' => [
            'years' => 'ปี 2568-2570',
            'points' => [
                'เป็นองค์กรที่เน้นการปรับปรุงระบบการจัดการเงินทุนให้เกิดประสิทธิภาพและประสิทธิผล',
                'เป็นองค์กรที่เน้นการปรับปรุงระบบการให้บริการทางการเงินที่ทันสมัยและเป็นไปตามหลักการอิสลาม',
                'เป็นองค์กรที่เน้นการเพิ่มศักยภาพบุคลากรให้มีความสามารถและมีคุณธรรม',
                'เป็นองค์กรที่เน้นการพัฒนาระบบเทคโนโลยีสารสนเทศให้มีประสิทธิภาพและประสิทธิผล',
            ],
        ],
        'phase3' => [
            'years' => 'ปี 2570-2571',
            'points' => [
                'เป็นองค์กรที่เน้นการรักษาความสมดุลของเงินทุน สมาชิก และการเติบโตทางเศรษฐกิจ',
                'เป็นองค์กรที่เน้นการพัฒนาและปรับปรุงการบริหารเงินทุนให้มีประสิทธิภาพสูงสุด',
                'เป็นองค์กรที่มุ่งเน้นการขยายฐานสมาชิก เพิ่มความหลากหลายของบริการ และเพิ่มการแสดงบทบาทในชุมชน',
            ],
        ],
    ];
@endphp

@section('content')
    <div class="bg-gray-50" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">
        <div class="container mx-auto px-4 py-16">
            <div class="text-center mb-16 transition-all duration-700 ease-out"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                <h1
                    class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-green-600 mb-4">
                    วิสัยทัศน์และพันธกิจองค์กร
                </h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    แนวทางการดำเนินงานที่มุ่งสู่การเป็นสหกรณ์ออมทรัพย์ชั้นนำที่มั่นคงและยั่งยืน
                </p>
            </div>

            <section class="mb-20 transition-all duration-700 ease-out" style="transition-delay: 200ms"
                :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">
                <div
                    class="relative bg-gradient-to-br from-blue-600 to-green-500 rounded-2xl shadow-2xl p-8 md:p-12 text-white overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full"></div>
                    <div class="absolute -bottom-16 -left-10 w-64 h-64 bg-white/10 rounded-full"></div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="flex items-center text-3xl md:text-4xl font-bold mb-4">
                            <svg class="h-10 w-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            วิสัยทัศน์ (VISION)
                        </div>
                        <p class="text-2xl md:text-3xl font-semibold mt-4 mb-6 max-w-4xl italic">
                            "{{ $vision['full_text'] }}"
                        </p>
                        <div class="border-t-2 border-white/30 w-1/3 my-4"></div>
                        <p class="text-xl font-light">{{ $vision['subtitle'] }}</p>
                    </div>
                </div>
            </section>

            <section class="mb-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="transition-all duration-700 ease-out" style="transition-delay: 400ms"
                    :class="loaded ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10'">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">พันธกิจ (MISSION)</h2>
                    <ul class="space-y-4">
                        @foreach ($missions as $mission)
                            <li class="flex items-start text-lg text-gray-700">
                                <svg class="h-7 w-7 text-green-500 mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $mission }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="transition-all duration-700 ease-out" style="transition-delay: 500ms"
                    :class="loaded ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">ค่านิยมหลัก (CORE VALUES)</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($core_values as $value)
                            <div
                                class="bg-white p-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col items-center">

                                <div class="mb-3">
                                    {!! $value['svg'] !!}
                                </div>

                                <h3 class="text-xl font-bold text-center text-gray-800">{{ $value['name'] }}</h3>
                                <p class="text-sm text-center text-gray-600 mt-1">{{ $value['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12 transition-all duration-700 ease-out"
                    style="transition-delay: 600ms" :class="loaded ? 'opacity-100' : 'opacity-0'">
                    ยุทธศาสตร์ 7 ปี (7-YEAR STRATEGY)
                </h2>
                <div class="relative">
                    <div class="hidden lg:block absolute top-1/2 left-0 w-full h-1 bg-gray-300 -translate-y-1/2"></div>

                    <div
                        class="relative flex flex-col lg:flex-row justify-between items-center lg:items-stretch gap-y-12 lg:gap-y-0">
                        @foreach ($strategy as $key => $phase)
                            @php
                                $delay = 800 + $loop->index * 200;
                                $colors = [
                                    'phase1' => 'border-blue-500 text-blue-700',
                                    'phase2' => 'border-green-500 text-green-700',
                                    'phase3' => 'border-purple-500 text-purple-700',
                                ];
                            @endphp
                            <div class="w-full lg:w-1/3 px-4 transition-all duration-700 ease-out"
                                style="transition-delay: {{ $delay }}ms"
                                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                                <div class="bg-white p-6 rounded-2xl shadow-xl h-full border-t-4 {{ $colors[$key] }}">
                                    <h3 class="text-2xl font-bold text-center {{ $colors[$key] }} mb-4">
                                        {{ $phase['years'] }}</h3>
                                    <ul class="list-disc pl-5 space-y-2 text-gray-700">
                                        @foreach ($phase['points'] as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
