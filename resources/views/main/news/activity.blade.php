@extends('layouts.layout')
@section('title', 'ข่าวสาร/กิจกรรม')
@section('content')

<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 mb-4">
                ข่าวสารและกิจกรรม
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                ติดตามความเคลื่อนไหวล่าสุดและกิจกรรมที่น่าสนใจของสหกรณ์ออมทรัพย์ษะกอฟะฮ จำกัด
            </p>
        </div>

        @if ($news->isEmpty())
            <div class="text-center text-gray-500 text-xl p-12 bg-white rounded-2xl shadow-md border">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 18V6.375c0-.621.504-1.125 1.125-1.125H9" />
                </svg>
                <p class="font-semibold">ยังไม่มีข่าวสารหรือกิจกรรมในขณะนี้</p>
                <p class="text-base mt-2">โปรดกลับมาตรวจสอบอีกครั้งในภายหลัง</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($news as $item)
                    <div class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-2 border border-gray-200/80">
                        <a href="{{ route('article', $item->news_number) }}" class="h-full flex flex-col">
                            <div class="overflow-hidden">
                                <img src="{{ asset('uploads/covers/' . $item->picture_name) }}"
                                     alt="{{ $item->title ?? 'News Image' }}"
                                     class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"/>
                            </div>

                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ Str::limit($item->title, 70) }}
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed flex-grow">
                                    {!! Str::limit(strip_tags($item->description), 90) !!}
                                </p>
                                <p class="text-sm text-gray-500 mt-4">
                                    {{ thaidate('j F Y', $item->dateupload) }}
                                </p>
                            </div>

                            <div class="px-6 py-4 bg-gray-50/50 border-t">
                                <span class="inline-flex items-center text-blue-600 font-semibold transition-all duration-300 group-hover:text-blue-800">
                                    อ่านเพิ่มเติม
                                    <svg class="h-4 w-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

           @if ($news->hasPages())
                <div class="mt-16">
                    {{ $news->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection