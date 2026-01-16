@extends('layouts.layout')
@section('title', $news->title)
@section('og_title', $news->title)
@section('og_description', Str::limit(strip_tags($news->description), 155))
@section('og_image', asset('uploads/covers/' . $news->picture_name))

@push('styles')
    <style>
        /* Fix Summernote/HTML content lists */
        .summernote-content ul { list-style-type: disc !important; margin-left: 1.5rem !important; padding-left: 1rem !important; }
        .summernote-content ol { list-style-type: decimal !important; margin-left: 1.5rem !important; padding-left: 1rem !important; }
        .summernote-content li { margin-bottom: 0.5rem; }
        /* Image hover effect */
        .gallery-item { transition: all 0.3s ease; }
        .gallery-item:hover { transform: scale(1.02); z-index: 10; }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@section('content')
<div class="bg-base-200 min-h-screen font-sans pb-20" data-theme="light">
    
    <div class="container mx-auto px-4 py-6 max-w-7xl">
        <a href="{{ route('activity') }}" class="btn btn-ghost btn-sm gap-2 text-gray-500 hover:text-blue-600 no-underline">
            <i class="fas fa-arrow-left"></i> กลับสู่หน้าข่าวสาร
        </a>
    </div>

    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <div class="lg:col-span-3">
                <article class="card bg-base-100 shadow-xl overflow-hidden border border-gray-100">
                    
                    @if ($news->picture_name)
                        <figure class="relative w-full h-[300px] md:h-[450px]">
                            <img src="{{ asset('uploads/covers/' . $news->picture_name) }}" 
                                 alt="{{ $news->title }}" 
                                 class="w-full h-full object-cover"
                                 loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            <div class="absolute bottom-0 left-0 p-6 md:p-10 text-white w-full">
                                <div class="badge badge-primary mb-3 no-underline">ประชาสัมพันธ์</div>
                                <h1 class="text-2xl md:text-4xl font-extrabold leading-tight shadow-black drop-shadow-lg">
                                    {{ $news->title ?? 'ไม่พบหัวข้อข่าว' }}
                                </h1>
                                <div class="flex items-center gap-4 mt-3 text-sm md:text-base opacity-90 font-medium">
                                    <span class="flex items-center gap-2">
                                        <i class="far fa-calendar-alt"></i> {{ thaidate('j F Y', $news->dateupload) }}
                                    </span>
                                    @if(isset($news->views))
                                    <span class="flex items-center gap-2">
                                        <i class="far fa-eye"></i> {{ $news->views }} ครั้ง
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </figure>
                    @endif

                    <div class="card-body p-6 md:p-10">
                        
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed summernote-content">
                            {!! $news->description !!}
                        </div>

                        <div class="divider my-8"></div>

                        @if ($image_news && $image_news->isNotEmpty())
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                    <i class="fas fa-images text-blue-500"></i> รูปภาพประกอบ
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach ($image_news as $image)
                                        <a href="{{ asset('uploads/galleries/' . $image->picture_name) }}" 
                                           data-fancybox="gallery"
                                           data-caption="{{ $news->title }}"
                                           class="gallery-item block rounded-xl overflow-hidden shadow-sm aspect-square cursor-zoom-in">
                                            <img src="{{ asset('uploads/galleries/' . $image->picture_name) }}"
                                                 alt="gallery"
                                                 class="w-full h-full object-cover"
                                                 loading="lazy" />
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-100">
                            <span class="text-gray-500 text-sm">แชร์ข่าวนึ้:</span>
                            <div class="flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-circle btn-sm btn-ghost text-blue-600">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank" class="btn btn-circle btn-sm btn-ghost text-sky-400">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                                <a href="https://lineit.line.me/share/ui?url={{ url()->current() }}" target="_blank" class="btn btn-circle btn-sm btn-ghost text-green-500">
                                    <i class="fa-brands fa-line"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </article>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-8">
                    
                    <div class="card bg-base-100 shadow-lg border border-gray-100">
                        <div class="card-body p-5">
                            <h2 class="card-title text-lg font-bold text-gray-800 border-b pb-3 mb-2">
                                <i class="fas fa-rss text-orange-500"></i> ข่าวสารอื่นๆ
                            </h2>
                            
                            @if ($side_news->isEmpty())
                                <p class="text-gray-400 text-center py-4 text-sm">ไม่พบข่าวสารที่เกี่ยวข้อง</p>
                            @else
                                <ul class="space-y-4">
                                    @foreach ($side_news as $side_item)
                                        <li>
                                            <a href="{{ route('article', $side_item->news_number) }}" class="flex gap-3 group">
                                                <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden relative">
                                                    <img src="{{ asset('uploads/covers/' . $side_item->picture_name) }}" 
                                                         onerror="this.src='https://placehold.co/100x100?text=No+Image'"
                                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                                         alt="{{ $side_item->title }}">
                                                </div>
                                                <div class="flex flex-col justify-between py-0.5">
                                                    <h3 class="text-sm font-semibold text-gray-700 leading-snug group-hover:text-blue-600 transition-colors line-clamp-2">
                                                        {{ $side_item->title }}
                                                    </h3>
                                                    <span class="text-[11px] text-gray-400 flex items-center gap-1">
                                                        <i class="far fa-clock"></i> {{ thaidate('j M Y', $side_item->dateupload) }}
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                                    <a href="{{ route('activity') }}" class="link link-primary text-sm no-underline hover:underline">ดูข่าวสารทั้งหมด</a>
                                </div>
                            @endif
                        </div>
                    </div>               
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
                // Your custom options
                Thumbs : {
                    type: "modern"
                }
            });
        });
    </script>
@endpush