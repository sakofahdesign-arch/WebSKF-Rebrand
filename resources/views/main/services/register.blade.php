@extends('layouts.layout')
@section('title', 'สมัครสมาชิก')

@php
    // We structure the page data in an array for cleaner, more maintainable code.
    $steps = [
        [
            'step' => '01',
            'title' => 'คุณสมบัติและเงื่อนไข',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'content_type' => 'conditions',
            'conditions' => [
                'เปิดบัญชีครั้งแรกไม่ต่ำกว่า <strong class="text-green-700">200 บาท</strong>',
                'ค่าธรรมเนียมแรกเข้า <strong class="text-green-700">100 บาท</strong> ตลอดการเป็นสมาชิก',
                'สมทบกองทุนสวัสดิการสมาชิก <strong class="text-green-700">100 บาท</strong>',
                'ฝากประจำเดือนละไม่ต่ำกว่า <strong class="text-green-700">200 บาท</strong>',
            ],
            'image' => 'images/sakofah_book.png',
        ],
        [
            'step' => '02',
            'title' => 'สิทธิประโยชน์ที่จะได้รับ',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'content_type' => 'benefits',
            'benefits' => [
                ['icon' => 'calendar-days', 'title' => 'เมื่อฝากครบ 6 เดือน', 'description' => 'สมาชิกสามารถยื่นขอสวัสดิการต่างๆ ของสหกรณ์ได้', 'color' => 'blue'],
                ['icon' => 'calendar', 'title' => 'เมื่อฝากครบ 12 เดือน', 'description' => 'สมาชิกสามารถยื่นขอสินเชื่อกับสหกรณ์ฯ ได้', 'color' => 'blue'],
                ['icon' => 'gift', 'title' => 'เงินปันผล', 'description' => 'มีการจัดสรรเงินปันผลทุกสิ้นปีตามเงื่อนไขของสหกรณ์ฯ', 'color' => 'yellow'],
            ],
        ],
        [
            'step' => '03',
            'title' => 'เริ่มต้นสมัครสมาชิก',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>',
            'content_type' => 'action',
            'video_url' => 'https://www.youtube.com/embed/TY-o6-CDB3Q',
        ],
    ];
@endphp

@section('content')
<div class="bg-gray-50" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">
    <div class="container mx-auto px-4 py-16">

        <div class="text-center mb-16 transition-all duration-700 ease-out" :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-500 mb-4">
                ร่วมเป็นส่วนหนึ่งกับเรา
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                เริ่มต้นเส้นทางสู่ความมั่นคงทางการเงินและชีวิตที่ดียิ่งขึ้นกับครอบครัวสหกรณ์ออมทรัพย์ษะกอฟะฮ
            </p>
        </div>

        <div class="relative max-w-5xl mx-auto">
            <div class="hidden md:block absolute top-12 left-10 h-full border-l-2 border-dashed border-gray-300"></div>

            <div class="space-y-16">
                @foreach($steps as $item)
                    <section class="relative pl-10 md:pl-20 transition-all duration-500 ease-out opacity-0" 
                             :class="{ 'opacity-100 translate-y-0': loaded }" 
                             style="transition-delay: {{ ($loop->index * 200) + 300 }}ms">

                        <div class="absolute top-0 left-0 flex items-center">
                            <span class="z-10 flex items-center justify-center w-20 h-20 text-3xl font-bold text-white bg-green-600 rounded-full shadow-lg">
                                {{ $item['step'] }}
                            </span>
                        </div>
                        
                        <div class="pl-4 md:pl-12">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 text-green-600">{!! $item['icon'] !!}</div>
                                <h2 class="text-3xl font-bold text-gray-800 ml-4">{{ $item['title'] }}</h2>
                            </div>

                            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-200/80">
                                @if($item['content_type'] === 'conditions')
                                    <div class="grid md:grid-cols-2 gap-8 items-center">
                                        <img src="{{ asset($item['image']) }}" alt="สมุดบัญชีสหกรณ์" class="rounded-lg shadow-md w-full max-w-xs mx-auto" loading="lazy">
                                        <ul class="space-y-4 text-lg text-gray-700">
                                            @foreach($item['conditions'] as $condition)
                                                <li class="flex items-start">
                                                    <svg class="h-6 w-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    <span>{!! $condition !!}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($item['content_type'] === 'benefits')
                                    <div class="grid sm:grid-cols-2 gap-6">
                                        @foreach($item['benefits'] as $benefit)
                                            <div class="p-6 rounded-lg bg-{{ $benefit['color'] }}-50 border border-{{ $benefit['color'] }}-200 transition-all duration-300 hover:shadow-lg hover:border-{{ $benefit['color'] }}-300">
                                                <h3 class="text-xl font-semibold text-{{ $benefit['color'] }}-800 mb-2">{{ $benefit['title'] }}</h3>
                                                <p class="text-{{ $benefit['color'] }}-700">{{ $benefit['description'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                
                                @if($item['content_type'] === 'action')
                                    <div class="w-full max-w-3xl mx-auto rounded-lg overflow-hidden shadow-lg mb-8">
                                        <div class="aspect-w-16 aspect-h-9">
                                            <iframe src="{{ $item['video_url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full h-full"></iframe>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-2xl font-bold mb-3 text-gray-800">พร้อมที่จะเริ่มต้นหรือยัง?</h3>
                                        <p class="text-lg text-gray-600 mb-6">ดาวน์โหลดใบสมัคร หรือติดต่อเราเพื่อสอบถามข้อมูลเพิ่มเติมได้ทันที</p>
                                        <a href="{{asset('file/form/ใบคำขอสมัครสมาชิก INFORM 68-001.pdf')}}" target="_blank" class="inline-flex items-center px-8 py-3 bg-green-600 text-white font-bold text-lg rounded-full shadow-lg hover:bg-green-700 hover:scale-105 transform transition-all duration-300">
                                            <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            ดาวน์โหลดใบสมัคร
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/aspect-ratio@0.4.2/src/index.min.js"></script>
@endpush