@extends('layouts.layout')
@section('title', 'ปฏิทินสหกรณ์')

@push('styles')
    {{-- Fancybox for image lightbox --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush

@section('content')
    <div class="bg-gray-50 min-h-screen text-gray-800 font-sans" data-theme="light" x-data="{ loaded: false, activeTab: '{{ strtolower($months[$currentMonth ?? array_key_first($months)]) }}' }"
        x-init="() => { setTimeout(() => loaded = true, 50) }">

        <div class="relative bg-gradient-to-r from-teal-600 to-emerald-500 text-white py-20 shadow-lg overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
            </div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 -mr-20 -mt-20">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-green-200 rounded-full mix-blend-overlay filter blur-3xl opacity-20 -ml-20 -mb-20">
            </div>

            <div class="container mx-auto px-4 text-center relative z-10 transition-all duration-700 ease-out"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-md">ปฏิทินกิจกรรม 2568</h1>
                <p class="text-lg md:text-xl font-light max-w-2xl mx-auto opacity-95">
                    ติดตามข่าวสาร วันหยุดทำการ และกิจกรรมสำคัญของสหกรณ์ฯ ตลอดทั้งปี
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12 max-w-7xl relative z-20 -mt-10">

            <div class="card bg-base-100 shadow-xl border border-base-200 mb-12 overflow-hidden transition-all duration-700 delay-100"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <figure class="relative group cursor-pointer">
                    <a href="{{ asset('images/calendar/ปกโปสเตอร์.jpg') }}" data-fancybox="gallery"
                        data-caption="ปกปฏิทิน 2568">
                        <img src="{{ asset('images/calendar/ปกโปสเตอร์.jpg') }}"
                            class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105"
                            alt="ปฏิทินสหกรณ์" loading="lazy">

                        <div
                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="btn btn-circle btn-ghost text-white bg-black/20 backdrop-blur-sm">
                                <i class="fas fa-search-plus text-xl"></i>
                            </span>
                        </div>
                    </a>
                </figure>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 transition-all duration-700 delay-200"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

                <div class="lg:col-span-1">
                    <div class="card bg-white shadow-lg border border-gray-100 sticky top-4">
                        <div class="card-body p-4">
                            <h3 class="text-lg font-bold text-gray-700 mb-4 px-2 border-l-4 border-teal-500 pl-3">เลือกเดือน
                            </h3>

                            <div class="grid grid-cols-2 lg:grid-cols-1 gap-2">
                                @foreach ($months as $month)
                                    <button @click="activeTab = '{{ strtolower($month) }}'"
                                        class="btn btn-sm lg:btn-md justify-start no-animation transition-all duration-200 border-none"
                                        :class="activeTab === '{{ strtolower($month) }}'
                                            ?
                                            'bg-teal-600 text-white shadow-md hover:bg-teal-700' :
                                            'bg-gray-50 text-gray-600 hover:bg-teal-50 hover:text-teal-700'">
                                        <i class="far fa-calendar-check mr-2"
                                            :class="activeTab === '{{ strtolower($month) }}' ? 'opacity-100' : 'opacity-50'"></i>
                                        {{ $month }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="card bg-white shadow-xl border border-gray-100 min-h-[500px]">
                        <div class="card-body p-6">
                            @foreach ($months as $month)
                                <div x-show="activeTab === '{{ strtolower($month) }}'"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100" style="display: none;">

                                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800">
                                            <span class="text-teal-600">{{ $month }}</span> 2568
                                        </h3>
                                    </div>

                                    <figure
                                        class="rounded-xl overflow-hidden border border-gray-200 shadow-sm group relative">
                                        <a href="{{ url('images/calendar/' . $month . '.jpg') }}" data-fancybox="gallery"
                                            data-caption="ปฏิทินเดือน {{ $month }} 2568">
                                            <img src="{{ url('images/calendar/' . $month . '.jpg') }}"
                                                class="w-full h-auto object-contain bg-gray-50 transition-transform duration-500 group-hover:scale-[1.02]"
                                                alt="ปฏิทินเดือน{{ $month }}" loading="lazy">

                                            <div
                                                class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                                                <div
                                                    class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">
                                                    <span
                                                        class="btn btn-sm bg-white/90 border-none text-teal-700 shadow-lg gap-2">
                                                        <i class="fas fa-expand"></i> ขยายรูปภาพ
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </figure>

                                    <div class="mt-6 flex justify-end">
                                        <a href="{{ url('images/calendar/' . $month . '.jpg') }}"
                                            download="ปฏิทิน_{{ $month }}_2568"
                                            class="btn btn-ghost btn-sm text-gray-500 hover:text-teal-600">
                                            <i class="fas fa-download mr-1"></i> ดาวน์โหลดรูปภาพ
                                        </a>
                                    </div>
                                </div>
                            @endforeach
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
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: ["zoomIn", "zoomOut", "toggle1to1", "rotateCCW", "rotateCW"],
                        right: ["slideshow", "thumbs", "close"],
                    },
                },
            });
        });
    </script>
@endpush
