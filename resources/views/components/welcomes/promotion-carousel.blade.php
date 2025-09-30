@php
    $promotions = [
        [
            'id' => 1,
            'slide_image' => 'images/banners/69-01-36.jpg',
            'modal_type' => 'image',
            'modal_content' => 'images/banners/69-01-31.jpg',
        ],
        [
            'id' => 2,
            'slide_image' => 'images/banners/69-01-33.jpg',
            'modal_type' => null,
            'modal_content' => null,
        ],
        [
            'id' => 3,
            'slide_image' => 'images/banners/69-01-34.jpg',
            'modal_type' => null,
            'modal_content' => null,
        ],
        [
            'id' => 4,
            'slide_image' => 'images/banners/69-01-35.jpg',
            'modal_type' => null,
            'modal_content' => null,
        ],
        [
            'id' => 5,
            'slide_image' => 'images/banners/521-2.jpg',
            'modal_type' => null,
            'modal_content' => null,
        ],
        [
            'id' => 6,
            'slide_image' => 'images/banners/515-1.jpg',
            'modal_type' => null,
            'modal_content' => null,
        ],
        [
            'id' => 7,
            'slide_image' => 'images/banners/450.jpg',
            'modal_type' => 'video',
            'modal_content' => 'https://www.youtube.com/embed/Wjw0Eovdgg0',
        ],
        [
            'id' => 8,
            'slide_image' => 'images/banners/345-1.jpg',
            'modal_type' => 'image',
            'modal_content' => 'images/banners/345.jpg',
        ],
    ];
@endphp

<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-6 mb-12 text-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-2">✨ โปรโมชันและข่าวสารล่าสุด</h2>
    </div>

    <div x-data="{
        activeSlide: 1,
        slideCount: {{ count($promotions) }},
        next() { this.activeSlide = this.activeSlide === this.slideCount ? 1 : this.activeSlide + 1 },
        prev() { this.activeSlide = this.activeSlide === 1 ? this.slideCount : this.activeSlide - 1 },
        autoplay() { setInterval(() => { this.next() }, 5000) }
    }" x-init="autoplay()" class="relative w-full max-w-6xl mx-auto group">
        <!-- Slides -->
        <div
            class="relative h-auto md:h-[420px] overflow-hidden rounded-2xl shadow-xl bg-gray-100 flex items-center justify-center">
            @foreach ($promotions as $promo)
                <div x-show="activeSlide === {{ $loop->iteration }}" x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-700"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute inset-0">
                    <!-- รูป -->
                    <img src="{{ asset($promo['slide_image']) }}"
                        class="max-h-[420px] w-auto object-contain {{ $promo['modal_content'] ? 'cursor-pointer' : '' }}"
                        alt="โปรโมชัน"
                        @if ($promo['modal_content']) data-modal-target="promotion-modal-{{ $promo['id'] }}"
                        data-modal-toggle="promotion-modal-{{ $promo['id'] }}" @endif>

                    <!-- Overlay ข้อความ -->
                    @if (!empty($promo['title']) || !empty($promo['subtitle']))
                        <div class="absolute bottom-6 left-6 bg-black/50 px-6 py-4 rounded-xl">
                            <div class="text-white max-w-xl">
                                @if (!empty($promo['title']))
                                    <h3 class="text-3xl md:text-4xl font-bold mb-3">{{ $promo['title'] }}</h3>
                                @endif
                                @if (!empty($promo['subtitle']))
                                    <p class="text-lg md:text-xl mb-6">{{ $promo['subtitle'] }}</p>
                                @endif
                                @if ($promo['modal_content'])
                                    <button data-modal-target="promotion-modal-{{ $promo['id'] }}"
                                        data-modal-toggle="promotion-modal-{{ $promo['id'] }}"
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-full text-white font-medium transition">
                                        ดูรายละเอียด
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-6 left-1/2 space-x-3">
            @foreach ($promotions as $promo)
                <button @click="activeSlide = {{ $loop->iteration }}"
                    :class="{
                        'bg-blue-600 w-6': activeSlide === {{ $loop->iteration }},
                        'bg-gray-300 w-3': activeSlide !==
                            {{ $loop->iteration }}
                    }"
                    class="h-3 rounded-full transition-all duration-300"></button>
            @endforeach
        </div>

        <!-- Prev Button -->
        <button @click="prev()" type="button"
            class="absolute top-1/2 left-4 -translate-y-1/2 z-30 flex items-center justify-center w-12 h-12 rounded-full bg-black/30 backdrop-blur-sm hover:bg-black/50 transition">
            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
        </button>

        <!-- Next Button -->
        <button @click="next()" type="button"
            class="absolute top-1/2 right-4 -translate-y-1/2 z-30 flex items-center justify-center w-12 h-12 rounded-full bg-black/30 backdrop-blur-sm hover:bg-black/50 transition">
            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
        </button>
    </div>
</section>

<!-- Modal -->
@foreach ($promotions as $promo)
    @if ($promo['modal_content'])
        <div id="promotion-modal-{{ $promo['id'] }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
                    justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full 
                bg-gray-900/70 backdrop-blur-sm transition-opacity duration-300">

            <div
                class="relative p-4 w-full {{ $promo['modal_type'] == 'video' ? 'max-w-4xl' : 'max-w-3xl' }} max-h-full transition-all duration-300 ease-in-out">
                <div class="relative bg-white rounded-2xl shadow-xl">
                    <!-- ปุ่มปิด -->
                    <button type="button"
                        class="absolute -top-3 -right-3 text-white bg-blue-600 hover:bg-blue-700 rounded-full text-sm w-9 h-9 flex justify-center items-center z-50"
                        data-modal-hide="promotion-modal-{{ $promo['id'] }}">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <!-- เนื้อหา -->
                    <div class="rounded-2xl overflow-hidden">
                        @if ($promo['modal_type'] == 'image')
                            <img src="{{ asset($promo['modal_content']) }}" class="w-full h-auto"
                                alt="รายละเอียดโปรโมชัน">
                        @elseif ($promo['modal_type'] == 'video')
                            <div class="aspect-video">
                                <iframe class="w-full h-full" src="{{ $promo['modal_content'] }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
