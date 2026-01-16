@extends('layouts.layout')
@section('title', $detail->title ?? 'รายละเอียดบ้าน')

@push('styles')
    {{-- Fancybox 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .gallery-main-img { height: 400px; object-fit: cover; width: 100%; }
        .gallery-thumb-img { height: 100px; object-fit: cover; width: 100%; }
        @media (min-width: 768px) {
            .gallery-main-img { height: 500px; }
            .gallery-thumb-img { height: 120px; }
        }
    </style>
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans pb-16" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
        <div class="container mx-auto px-4 py-3 max-w-7xl flex justify-between items-center">
            <a href="/homeList" class="btn btn-ghost btn-sm gap-2 text-gray-500 hover:text-indigo-600 font-normal">
                <i class="fas fa-arrow-left"></i> กลับหน้ารายการ
            </a>
            <div class="text-xs text-gray-400 hidden sm:block">
                รหัสทรัพย์: #{{ $detail->id ?? '-' }}
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-7xl transition-all duration-700 ease-out"
         :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-4">
                @if ($image && $image->isNotEmpty())
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 relative group">
                        <a data-fancybox="gallery" href="{{ asset('assets/' . $image[0]->picture_name) }}" class="block relative">
                            <img class="gallery-main-img transition-transform duration-700 group-hover:scale-105" 
                                 src="{{ asset('assets/' . $image[0]->picture_name) }}" 
                                 alt="{{ $detail->title ?? 'รูปภาพหลัก' }}" />
                            
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="btn btn-circle bg-white/80 border-none text-gray-800 shadow-xl">
                                    <i class="fas fa-search-plus text-xl"></i>
                                </span>
                            </div>
                        </a>
                        <div class="absolute top-4 left-4">
                            <span class="badge badge-primary badge-lg shadow-md border-none bg-indigo-600 text-white">
                                <i class="fas fa-home mr-2"></i> บ้าน/ทาวน์โฮม
                            </span>
                        </div>
                    </div>

                    @if ($image->count() > 1)
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach ($image->skip(1) as $item_image)
                                <div class="rounded-xl overflow-hidden shadow-sm border border-gray-100 group relative">
                                    <a data-fancybox="gallery" href="{{ asset('assets/' . $item_image->picture_name) }}" class="block h-full">
                                        <img class="gallery-thumb-img transition-transform duration-300 group-hover:scale-110" 
                                             src="{{ asset('assets/' . $item_image->picture_name) }}" 
                                             alt="รูปภาพเพิ่มเติม" />
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                     <div class="rounded-2xl overflow-hidden shadow-lg bg-gray-200 h-96 flex items-center justify-center text-gray-400">
                        <div class="text-center">
                            <i class="fas fa-image text-5xl mb-2"></i>
                            <p>ไม่มีรูปภาพ</p>
                        </div>
                     </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-20 space-y-6">
                    
                    <div class="card bg-white shadow-xl border border-gray-100">
                        <div class="card-body p-6">
                            <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                                <i class="far fa-clock"></i> ลงประกาศ: {{ thaidate('j F Y', $detail->date) ?? '-' }}
                            </div>
                            
                            <h1 class="card-title text-2xl font-extrabold text-gray-800 leading-tight mb-4">
                                {{ $detail->title ?? 'ไม่พบชื่อสินทรัพย์' }}
                            </h1>

                            <div class="divider my-2"></div>

                            <div class="prose text-gray-600 leading-relaxed text-sm space-y-4">
                                @if(!empty($detail->description1))
                                    <div>
                                        <h3 class="font-bold text-gray-800 mb-1"><i class="fas fa-info-circle text-indigo-500 mr-1"></i> รายละเอียด 1</h3>
                                        <p>{{ $detail->description1 }}</p>
                                    </div>
                                @endif
                                
                                @if(!empty($detail->description2))
                                    <div>
                                        <h3 class="font-bold text-gray-800 mb-1"><i class="fas fa-list-ul text-indigo-500 mr-1"></i> รายละเอียด 2</h3>
                                        <p>{{ $detail->description2 }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card bg-gradient-to-br from-indigo-600 to-blue-700 text-white shadow-xl">
                        <div class="card-body p-6">
                            <h3 class="card-title text-lg mb-4 flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-phone-alt text-sm"></i>
                                </div>
                                ติดต่อสอบถาม
                            </h3>
                            
                            <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm border border-white/10 mb-4">
                                <p class="text-lg font-medium leading-relaxed text-center">
                                    {{ $detail->contact ?? 'กรุณาติดต่อเจ้าหน้าที่สหกรณ์' }}
                                </p>
                            </div>

                            <div class="card-actions justify-center">
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $detail->contact ?? '') }}" class="btn bg-white text-indigo-700 border-none hover:bg-gray-100 w-full rounded-full">
                                    <i class="fas fa-mobile-alt mr-2"></i> โทรสอบถามทันที
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Fancybox 5 JS (No jQuery needed) --}}
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Fancybox.bind("[data-fancybox]", {
                Thumbs: {
                    type: "modern"
                },
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: ["zoomIn", "zoomOut", "rotateCCW", "rotateCW"],
                        right: ["slideshow", "thumbs", "close"],
                    },
                },
            });
        });
    </script>
@endpush