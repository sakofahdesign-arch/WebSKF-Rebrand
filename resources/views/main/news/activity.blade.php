@extends('layouts.layout')
@section('title', 'ข่าวสาร/กิจกรรม')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="relative bg-gradient-to-r from-blue-600 to-cyan-500 text-white py-20 shadow-lg overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-200 rounded-full mix-blend-overlay filter blur-3xl opacity-20 -ml-20 -mb-20"></div>

        <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out"
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md">ข่าวสารและกิจกรรม</h1>
            <p class="text-lg md:text-xl font-light max-w-2xl mx-auto opacity-95">
                ติดตามความเคลื่อนไหว ประกาศสำคัญ และกิจกรรมที่น่าสนใจของสหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 max-w-7xl relative z-20 -mt-10">

        @if ($news->isEmpty())
            <div class="card bg-base-100 shadow-xl text-center p-12 border border-base-200 transition-all duration-700 delay-100"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <figure class="px-10 pt-10">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                        <i class="fas fa-newspaper text-4xl"></i>
                    </div>
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title text-2xl text-gray-600">ไม่พบข้อมูลข่าวสาร</h2>
                    <p class="text-gray-500">ขณะนี้ยังไม่มีรายการข่าวสารหรือกิจกรรมประชาสัมพันธ์</p>
                    <div class="card-actions mt-4">
                        <a href="/" class="btn btn-outline btn-primary rounded-full">กลับสู่หน้าหลัก</a>
                    </div>
                </div>
            </div>
        @else

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($news as $index => $item)
                    <a href="{{ route('article', $item->news_number) }}" class="group h-full">
                        <div class="card bg-base-100 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 h-full overflow-hidden opacity-0 translate-y-10"
                             :class="loaded ? '!opacity-100 !translate-y-0' : ''"
                             style="transition-delay: {{ $index * 100 + 200 }}ms">

                            <figure class="relative h-48 overflow-hidden">
                                <img src="{{ asset('uploads/covers/' . $item->picture_name) }}"
                                     alt="{{ $item->title ?? 'News Image' }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy" />

                            </figure>

                            <div class="card-body p-5">
                                <h3 class="card-title text-base font-bold text-gray-800 leading-snug group-hover:text-blue-600 transition-colors line-clamp-2 h-10 mb-2">
                                    {{ Str::limit($item->title, 60) }}
                                </h3>

                                <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 mb-4 h-12">
                                    {!! Str::limit(strip_tags($item->description), 80) !!}
                                </p>

                                <div class="card-actions justify-between items-center border-t border-gray-100 pt-3 mt-auto">
                                    <span class="text-xs text-gray-400 font-medium flex items-center gap-1">
                                        <i class="far fa-calendar-alt text-blue-400"></i>
                                        {{ thaidate('j M Y', $item->dateupload) }}
                                    </span>

                                    <span class="text-xs font-bold text-blue-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                                        อ่านต่อ <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($news->hasPages())
                <div class="mt-16 flex justify-center transition-all duration-700 delay-500"
                     :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    {{ $news->links('vendor.pagination.daisyui') }}
                </div>
            @endif
        @endif

    </div>
</div>
@endsection
