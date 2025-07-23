@extends('layouts.layout')
@section('title', $news->title)
@section('og_title', $news->title)
@section('og_description', Str::limit(strip_tags($news->description), 155))
@section('og_image', asset('uploads/covers/' . $news->picture_name))
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@section('content')
    <div class="bg-gray-50">
        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-3/4 bg-white rounded-2xl shadow-xl p-6 md:p-8 border-t-4 border-blue-500">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-4">
                        {{ $news->title ?? 'ไม่พบหัวข้อข่าว' }}
                    </h1>
                    <p class="text-gray-500 text-sm mb-6 flex items-center">
                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        เผยแพร่เมื่อ: {{ thaidate('l j F Y', $news->dateupload) }}
                    </p>
                    @if ($news->picture_name)
                        <div class="mb-8 rounded-lg overflow-hidden shadow-md">
                            <img src="{{ asset('uploads/covers/' . $news->picture_name) }}"
                                alt="{{ $news->title ?? 'รูปภาพข่าวสารหลัก' }}" class="w-full h-auto object-cover"
                                loading="lazy" />
                        </div>
                    @endif
                    <div class="prose max-w-none lg:prose-lg mx-auto text-gray-800 leading-relaxed mb-8">
                        {!! $news->description ?? '<p>ไม่พบเนื้อหาข่าวสาร</p>' !!}
                    </div>
                    @if ($image_news && $image_news->isNotEmpty())
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">รูปภาพประกอบ</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($image_news as $image)
                                <a href="{{ asset('uploads/galleries/' . $image->picture_name) }}" data-fancybox="gallery"
                                    data-caption="{{ $news->title }}"
                                    class="block rounded-lg overflow-hidden shadow-sm border border-gray-200 group">
                                    <img src="{{ asset('uploads/galleries/' . $image->picture_name) }}"
                                        alt="รูปภาพประกอบข่าว"
                                        class="w-full h-48 object-cover transition-transform duration-300 ease-in-out group-hover:scale-105"
                                        loading="lazy" />
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-12 text-center">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-full transition duration-300">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                            </svg>
                            กลับสู่หน้าข่าวสาร
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-purple-500 sticky top-8">
                        <h2 class="text-2xl font-bold text-purple-800 mb-6 border-b-2 border-purple-200 pb-3">ข่าวสารอื่นๆ
                        </h2>
                        @if ($side_news->isEmpty())
                            <p class="text-gray-500 text-sm">ไม่พบข่าวสารที่เกี่ยวข้อง</p>
                        @else
                            <ul class="space-y-4">
                                @foreach ($side_news as $side_item)
                                    <li>
                                        <a href="{{ route('article', $side_item->news_number) }}"
                                            class="block p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                            <div class="flex items-start gap-4">
                                                <img src="{{ asset('uploads/covers/' . $side_item->picture_name) }}"
                                                    onerror="this.style.display='none'"
                                                    class="w-20 h-20 object-cover rounded-md flex-shrink-0 bg-gray-200"
                                                    alt="{{ $side_item->title }}" loading="lazy">
                                                <div>
                                                    <h3
                                                        class="text-base font-bold text-gray-800 leading-tight hover:text-blue-600">
                                                        {{ $side_item->title }}
                                                    </h3>
                                                    <p class="text-gray-500 text-xs mt-1">
                                                        {{ thaidate('j F Y', $side_item->dateupload) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Fancybox.bind("[data-fancybox]", {

            });
        });
    </script>
@endpush
