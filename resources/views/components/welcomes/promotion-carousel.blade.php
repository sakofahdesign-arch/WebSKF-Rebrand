@php
    $promotions = [
        [
            'id' => 1,
            'slide_image' => 'images/banners/521-2.jpg',
            'modal_type' => null,
            'modal_content' => null
        ],
        [
            'id' => 2,
            'slide_image' => 'images/banners/515-1.jpg',
            'modal_type' => null,
            'modal_content' => null
        ],
        [
            'id' => 3,
            'slide_image' => 'images/banners/450.jpg',
            'modal_type' => 'video',
            'modal_content' => 'https://www.youtube.com/embed/Wjw0Eovdgg0',
        ],
        [
            'id' => 4,
            'slide_image' => 'images/banners/345-1.jpg',
            'modal_type' => 'image',
            'modal_content' => 'images/banners/345.jpg',
        ],
    ];
@endphp

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800">โปรโมชันและข่าวสารล่าสุด</h2>
    </div>

    <div x-data="{ activeSlide: 1, slideCount: {{ count($promotions) }}, next() { this.activeSlide = this.activeSlide === this.slideCount ? 1 : this.activeSlide + 1 }, prev() { this.activeSlide = this.activeSlide === 1 ? this.slideCount : this.activeSlide - 1 }, autoplay() { setInterval(() => { this.next() }, 5000) }}" x-init="autoplay()" class="relative w-full group">
        <div class="relative h-56 overflow-hidden md:h-96 bg-white">
            @foreach ($promotions as $promo)
                <div x-show="activeSlide === {{ $loop->iteration }}" x-transition:enter="transition-opacity ease-in-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in-out duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                    <img src="{{ asset($promo['slide_image']) }}" class="block w-full h-full object-contain {{ $promo['modal_content'] ? 'cursor-pointer' : '' }}" alt="โปรโมชัน" @if ($promo['modal_content']) data-modal-target="promotion-modal-{{ $promo['id'] }}" data-modal-toggle="promotion-modal-{{ $promo['id'] }}" @endif>
                </div>
            @endforeach
        </div>

        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
            @foreach ($promotions as $promo)
                <button @click="activeSlide = {{ $loop->iteration }}" :class="{'bg-white': activeSlide === {{ $loop->iteration }},'bg-white/50': activeSlide !=={{ $loop->iteration }}}" class="w-3 h-3 rounded-full transition"></button>
            @endforeach
        </div>

        <button @click="prev()" type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
            </span>
        </button>
        <button @click="next()" type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 group-hover:bg-black/50">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
            </span>
        </button>
    </div>
</section>

@foreach ($promotions as $promo)
    @if ($promo['modal_content'])
        <div id="promotion-modal-{{ $promo['id'] }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900/70 backdrop-blur-sm transition-opacity duration-300">
            <div class="relative p-4 w-full {{ $promo['modal_type'] == 'video' ? 'max-w-4xl' : 'max-w-3xl' }} max-h-full transition-all duration-300 ease-in-out">
                <div class="relative bg-white rounded-2xl shadow-xl">
                    <button type="button" class="absolute -top-3 -right-3 text-white bg-blue-600 hover:bg-blue-700 rounded-full text-sm w-9 h-9 flex justify-center items-center z-50" data-modal-hide="promotion-modal-{{ $promo['id'] }}">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <div class="rounded-2xl overflow-hidden">
                        @if ($promo['modal_type'] == 'image')
                            <img src="{{ asset($promo['modal_content']) }}" class="w-full" alt="รายละเอียดโปรโมชัน">
                        @elseif ($promo['modal_type'] == 'video')
                            <div class="aspect-video">
                                <iframe class="w-full h-full" src="{{ $promo['modal_content'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach