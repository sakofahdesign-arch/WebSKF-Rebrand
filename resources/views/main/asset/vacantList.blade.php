@extends('layouts.layout')
@section('title', 'ที่ดินเปล่า')

@section('content')
<div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 50) }">

    <div class="relative bg-gradient-to-r from-emerald-600 to-teal-500 text-white py-20 shadow-lg overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-200 rounded-full mix-blend-overlay filter blur-3xl opacity-20 -ml-20 -mb-20"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out" 
             :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md">ที่ดินเปล่า</h1>
            <p class="text-lg md:text-xl font-light max-w-2xl mx-auto opacity-95">
                รวมประกาศขายที่ดินเปล่า ทำเลทอง เหมาะสำหรับการลงทุนหรือปลูกสร้างที่อยู่อาศัย
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 max-w-7xl relative z-20 -mt-10">

        @if ($asset->isEmpty())
            <div class="card bg-base-100 shadow-xl text-center p-12 border border-base-200 transition-all duration-700 delay-100"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <figure class="px-10 pt-10">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                        <i class="fas fa-map-signs text-4xl"></i>
                    </div>
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title text-2xl text-gray-600">ไม่พบรายการที่ดิน</h2>
                    <p class="text-gray-500">ขณะนี้ยังไม่มีรายการที่ดินเปล่าประกาศขาย</p>
                    <div class="card-actions mt-4">
                        <a href="/" class="btn btn-outline btn-success rounded-full">กลับสู่หน้าหลัก</a>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($asset as $index => $item)
                    <a href="vacant/{{$item->id}}" class="group h-full">
                        <div class="card bg-base-100 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 h-full overflow-hidden opacity-0 translate-y-10"
                             :class="loaded ? '!opacity-100 !translate-y-0' : ''"
                             style="transition-delay: {{ $index * 100 + 200 }}ms">
                            
                            <figure class="relative h-56 overflow-hidden">
                                <img src="{{ asset('assets/' . $item->picture_name) }}" 
                                     alt="{{ $item->title ?? 'รูปภาพที่ดิน' }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy" />
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <span class="btn btn-sm btn-success text-white border-none shadow-lg">ดูรายละเอียด</span>
                                </div>
                            </figure>

                            <div class="card-body p-5">
                                <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                    <i class="far fa-calendar-alt text-emerald-500"></i>
                                    {{ thaidate('j F Y', $item->date) }}
                                </div>

                                <h3 class="card-title text-lg font-bold text-gray-800 leading-snug group-hover:text-emerald-600 transition-colors line-clamp-1" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </h3>
                                
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 h-10 mb-2">
                                    {{ Str::limit($item->title ?? 'ไม่มีรายละเอียด', 100) }}
                                </p>

                                <div class="card-actions justify-start items-center border-t border-gray-100 pt-3 mt-auto">
                                    <div class="flex gap-3 text-xs text-gray-400">
                                        <span class="flex items-center gap-1"><i class="fas fa-check-circle text-emerald-500"></i> เอกสารสิทธิ์ครบ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($asset->hasPages())
                <div class="mt-16 flex justify-center transition-all duration-700 delay-500"
                     :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    
                    {{-- เรียกใช้ไฟล์ Pagination DaisyUI --}}
                    {{ $asset->links('vendor.pagination.daisyui') }}
                    
                </div>
            @endif
        @endif

    </div>
</div>
@endsection