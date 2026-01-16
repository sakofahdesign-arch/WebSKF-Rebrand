@extends('layouts.layout')

@section('title', 'วิสัยทัศน์ พันธกิจ และวัตถุประสงค์')

@php
    // --- ข้อมูลคงเดิม ---
    $vision = [
        'title' => 'สหกรณ์ออมทรัพย์ต้นแบบ',
        'subtitle' => 'เป็นองค์กรที่ก้าวหน้า มั่นคง และมีธรรมาภิบาล',
        'full_text' => 'สหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด เป็นองค์กรที่ก้าวหน้าและมั่นคง มีธรรมาภิบาล เป็นที่ยอมรับ และเป็นส่วนหนึ่งของวิถีชีวิตผู้คน',
    ];

    $missions = [
        [
            'text' => 'บริหารจัดการเงินทุนให้เกิดผลกำไรสูงสุด บนพื้นฐานธรรมาภิบาลและหลักการอิสลาม',
            'icon' => '<i class="fas fa-coins text-4xl"></i>',
            'color' => 'text-yellow-500'
        ],
        [
            'text' => 'มุ่งเน้นการบริการและกิจกรรมที่เป็นไปตามหลักอิสลาม',
            'icon' => '<i class="fas fa-praying-hands text-4xl"></i>',
            'color' => 'text-green-500'
        ],
        [
            'text' => 'พัฒนาบุคลากรให้มีความสามารถ เชี่ยวชาญและมีคุณธรรม',
            'icon' => '<i class="fas fa-user-tie text-4xl"></i>',
            'color' => 'text-blue-500'
        ],
        [
            'text' => 'บริหารจัดการให้มีระบบงานที่ดี เพื่อเพิ่มประสิทธิภาพและประสิทธิผล',
            'icon' => '<i class="fas fa-cogs text-4xl"></i>',
            'color' => 'text-purple-500'
        ],
    ];

    $core_values = [
        [
            'name' => 'Simple',
            'description' => 'สะดวก ทันสมัย มีนวัตกรรม ในการให้บริการ',
            'color' => 'text-blue-500',
            'icon' => '<i class="fas fa-mobile-alt text-4xl"></i>'
        ],
        [
            'name' => 'Knowledge',
            'description' => 'องค์ความรู้สู่ชาติอิสลาม องค์ความรู้สู่การอยู่ดีมีคุณธรรม',
            'color' => 'text-green-500',
            'icon' => '<i class="fas fa-book-open text-4xl"></i>'
        ],
        [
            'name' => 'Fast',
            'description' => 'รวดเร็ว ทันเวลา ตอบโจทย์ลูกค้า',
            'color' => 'text-red-500',
            'icon' => '<i class="fas fa-tachometer-alt text-4xl"></i>'
        ],
        [
            'name' => 'Honesty',
            'description' => 'โปร่งใส ตรวจสอบได้',
            'color' => 'text-purple-500',
            'icon' => '<i class="fas fa-balance-scale text-4xl"></i>'
        ],
    ];

    $strategy = [
        [
            'phase' => 'ระยะที่ 1',
            'years' => 'ปี 2565-2567',
            'theme' => 'สร้างรากฐาน',
            'color' => 'primary',
            'points' => [
                'มุ่งเน้นการเพิ่มทุน เพื่อความมั่นคงทางการเงิน',
                'เพิ่มปริมาณเงินฝากเพื่อสภาพคล่อง',
                'บริหารสินทรัพย์ด้อยคุณภาพอย่างมีประสิทธิภาพ',
                'เพิ่มสมาชิกใหม่ให้ได้ตามเป้าหมาย',
            ],
        ],
        [
            'phase' => 'ระยะที่ 2',
            'years' => 'ปี 2568-2570',
            'theme' => 'พัฒนาระบบ',
            'color' => 'secondary',
            'points' => [
                'ปรับปรุงระบบจัดการเงินทุนให้มีประสิทธิภาพสูงสุด',
                'พัฒนาระบบบริการการเงินที่ทันสมัยตามหลักอิสลาม',
                'พัฒนาศักยภาพบุคลากรให้เชี่ยวชาญและมีคุณธรรม',
                'ยกระดับระบบเทคโนโลยีสารสนเทศ (IT)',
            ],
        ],
        [
            'phase' => 'ระยะที่ 3',
            'years' => 'ปี 2570-2571',
            'theme' => 'เติบโตยั่งยืน',
            'color' => 'accent',
            'points' => [
                'รักษาสมดุลของเงินทุน สมาชิก และการเติบโต',
                'บริหารเงินทุนให้เกิดประโยชน์สูงสุด',
                'ขยายฐานสมาชิกและบทบาททางสังคมในชุมชน',
            ],
        ],
    ];
@endphp

@section('content')

    <div class="hero min-h-[400px] bg-gradient-to-br from-green-800 to-green-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="h-full w-full" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="hero-pattern" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="currentColor" stroke-width="2" fill="none"/></pattern></defs><rect width="100%" height="100%" fill="url(#hero-pattern)"/></svg>
        </div>

        <div class="hero-content text-center py-16 relative z-10">
            <div class="max-w-4xl">
                <div class="badge badge-outline text-white border-white/50 mb-4 p-4 text-sm font-bold tracking-widest">VISION</div>
                <h1 class="mb-5 text-4xl md:text-5xl font-extrabold leading-tight drop-shadow-lg">
                    "{{ $vision['full_text'] }}"
                </h1>
                <p class="mb-5 text-xl text-green-100 font-light">
                    {{ $vision['subtitle'] }}
                </p>
                <div class="h-1 w-24 bg-white/30 mx-auto rounded-full mt-6"></div>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-16">

            <div class="grid lg:grid-cols-2 gap-12 items-stretch mb-24">

                <div class="flex flex-col h-full">
                    <h2 class="text-3xl font-bold text-green-800 mb-6 flex items-center gap-3">
                        <i class="fas fa-bullseye text-green-600"></i> พันธกิจ (Mission)
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-grow">
                        @foreach ($missions as $mission)
                            {{-- h-full เพื่อให้การ์ดสูงเท่ากันในแถว --}}
                            <div class="card bg-white shadow-lg hover:-translate-y-1 transition-transform border border-gray-200 text-center h-full">
                                <div class="card-body p-6 items-center justify-center">
                                    <div class="{{ $mission['color'] }} mb-4">
                                        {!! $mission['icon'] !!}
                                    </div>
                                    <p class="text-gray-700 font-medium text-lg leading-relaxed">{{ $mission['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col h-full">
                    <h2 class="text-3xl font-bold text-green-800 mb-6 flex items-center gap-3">
                        <i class="fas fa-heart text-red-500"></i> ค่านิยมหลัก (Core Values)
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-grow">
                        @foreach ($core_values as $value)
                             {{-- h-full เพื่อให้การ์ดสูงเท่ากันในแถว --}}
                            <div class="card bg-white shadow-lg hover:-translate-y-1 transition-transform border border-gray-200 text-center h-full">
                                <div class="card-body p-6 items-center justify-center">
                                    <div class="{{ $value['color'] }} mb-4">
                                        {!! $value['icon'] !!}
                                    </div>
                                    <h3 class="card-title text-2xl font-bold text-gray-800 mb-2">{{ $value['name'] }}</h3>
                                    <p class="text-base text-gray-600">{{ $value['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-green-800">ยุทธศาสตร์ 7 ปี (7-Year Strategy)</h2>
                    <p class="text-gray-600 text-lg mt-3">แผนการดำเนินงานเพื่อความมั่นคงและยั่งยืน</p>
                </div>

                <ul class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical">
                    @foreach ($strategy as $index => $item)
                        <li>
                            @if($index > 0) <hr class="bg-green-100" /> @endif

                            <div class="timeline-middle">
                                <div class="w-14 h-14 rounded-full flex items-center justify-center text-white shadow-lg z-10 ring-4 ring-white
                                    {{ $index == 0 ? 'bg-blue-600' : ($index == 1 ? 'bg-green-600' : 'bg-purple-600') }}">
                                    <span class="font-bold text-2xl">{{ $index + 1 }}</span>
                                </div>
                            </div>

                            <div class="{{ $index % 2 == 0 ? 'timeline-start md:text-end' : 'timeline-end' }} mb-12 md:px-6 w-full">
                                <div class="card bg-white shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300">
                                    <div class="card-body p-8">

                                        {{-- ส่วนหัว: ปี และ ธีม (ตัวใหญ่ขึ้น) --}}
                                        <div class="flex flex-col {{ $index % 2 == 0 ? 'md:items-end' : 'md:items-start' }} mb-6">
                                            <span class="badge badge-lg {{ $index == 0 ? 'badge-primary' : ($index == 1 ? 'badge-success text-white' : 'badge-secondary') }} font-bold mb-3 p-4 text-lg">
                                                {{ $item['years'] }}
                                            </span>
                                            <h3 class="text-3xl font-extrabold text-gray-800 tracking-tight">{{ $item['theme'] }}</h3>
                                        </div>

                                        {{-- รายการข้อ่อย (ตัวใหญ่ขึ้น + ไอคอนเดียวทางซ้าย) --}}
                                        <ul class="space-y-4 text-left">
                                            @foreach ($item['points'] as $point)
                                                <li class="text-gray-700 text-lg flex items-start">
                                                    {{-- ไอคอนเดียวอยู่ทางซ้ายเสมอ --}}
                                                    <i class="fas fa-check-circle text-green-500 mt-1.5 mr-3 shrink-0"></i>
                                                    <span>{{ $point }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            @if($index < count($strategy) - 1) <hr class="bg-green-100" /> @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
