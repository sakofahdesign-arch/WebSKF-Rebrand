@php
    $promotions = [
        [
            'id' => 1,
            'slide_image' => 'images/banners/69-01-36.jpg',
            'modal_type' => 'image',
            'modal_content' => 'images/banners/69-01-31.jpg',
            'title' => 'โปรโมชันพิเศษ', // สมมติว่ามี
            'subtitle' => 'ลดแลกแจกแถม', // สมมติว่ามี
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
            'slide_image' => 'images/banners/450.jpg',
            'modal_type' => 'video',
            'modal_content' => 'https://www.youtube.com/embed/Wjw0Eovdgg0',
        ],
        [
            'id' => 7,
            'slide_image' => 'images/banners/345-1.jpg',
            'modal_type' => 'image',
            'modal_content' => 'images/banners/345.jpg',
        ],
    ];
@endphp

<section class="py-16 bg-gradient-to-b from-green-50 to-white">
    <div class="container mx-auto px-4 mb-8 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-green-800 mb-2">
            ✨ โปรโมชันและข่าวสารล่าสุด
        </h2>
        <div class="h-1 w-24 bg-green-500 mx-auto rounded-full"></div>
    </div>

    <div class="relative w-full max-w-5xl mx-auto group">

        <div id="promo-carousel"
            class="carousel w-full h-auto md:h-[450px] rounded-2xl shadow-xl bg-white border border-gray-100 overflow-hidden">
            @foreach ($promotions as $index => $promo)
                <div id="promo-slide-{{ $index }}" class="carousel-item relative w-full duration-500 ease-in-out">

                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                        <img src="{{ asset($promo['slide_image']) }}"
                            class="max-h-full w-auto object-contain transition-transform duration-500 hover:scale-105 cursor-pointer"
                            alt="Promotion {{ $promo['id'] }}"
                            @if ($promo['modal_content']) onclick="promo_modal_{{ $promo['id'] }}.showModal()" @endif>
                    </div>

                    @if (!empty($promo['title']) || !empty($promo['subtitle']) || $promo['modal_content'])
                        <div
                            class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-6 pt-12">
                            <div class="text-white max-w-xl">
                                @if (!empty($promo['title']))
                                    <h3 class="text-2xl font-bold mb-1">{{ $promo['title'] }}</h3>
                                @endif
                                @if (!empty($promo['subtitle']))
                                    <p class="text-sm md:text-base opacity-90 mb-3">{{ $promo['subtitle'] }}</p>
                                @endif

                                @if ($promo['modal_content'])
                                    <button onclick="promo_modal_{{ $promo['id'] }}.showModal()"
                                        class="btn btn-sm bg-green-600 border-none hover:bg-green-700 text-white rounded-full px-6 shadow-md">
                                        ดูรายละเอียด
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div
            class="absolute flex justify-between transform -translate-y-1/2 left-2 right-2 top-1/2 z-30 pointer-events-none">
            <button onclick="movePromoSlide(-1)"
                class="btn btn-circle btn-sm md:btn-md bg-white/40 hover:bg-white border-none text-gray-800 backdrop-blur-sm pointer-events-auto shadow-lg">❮</button>
            <button onclick="movePromoSlide(1)"
                class="btn btn-circle btn-sm md:btn-md bg-white/40 hover:bg-white border-none text-gray-800 backdrop-blur-sm pointer-events-auto shadow-lg">❯</button>
        </div>

        <div class="flex justify-center w-full py-4 gap-2">
            @foreach ($promotions as $index => $promo)
                <button onclick="goToPromoSlide({{ $index }})" id="promo-dot-{{ $index }}"
                    class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300 {{ $loop->first ? 'bg-green-600 w-6' : 'bg-gray-300' }}">
                </button>
            @endforeach
        </div>
    </div>
</section>

@foreach ($promotions as $promo)
    @if ($promo['modal_content'])
        <dialog id="promo_modal_{{ $promo['id'] }}" class="modal">
            <div
                class="modal-box w-11/12 {{ $promo['modal_type'] == 'video' ? 'max-w-5xl p-0 bg-black' : 'max-w-4xl p-0' }} rounded-xl relative overflow-hidden">

                <form method="dialog">
                    <button
                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 z-50 {{ $promo['modal_type'] == 'video' ? 'text-white bg-black/50 hover:bg-black' : 'text-gray-600 bg-white/50 hover:bg-white' }}">✕</button>
                </form>

                @if ($promo['modal_type'] == 'image')
                    <img src="{{ asset($promo['modal_content']) }}" class="w-full h-auto block" alt="รายละเอียด">
                @elseif ($promo['modal_type'] == 'video')
                    <div class="aspect-video w-full">
                        <iframe class="w-full h-full" src="{{ $promo['modal_content'] }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    @endif
@endforeach

@push('scripts')
    <script>
        let currentPromoSlide = 0;
        const promoCarousel = document.getElementById('promo-carousel');
        const totalPromoSlides = {{ count($promotions) }};
        const promoIntervalTime = 5000;
        let promoTimer;

        function updatePromoCarousel() {
            if (!promoCarousel) return;

            const slideWidth = promoCarousel.clientWidth;
            promoCarousel.scrollTo({
                left: currentPromoSlide * slideWidth,
                behavior: 'smooth'
            });

            // Update Dots
            for (let i = 0; i < totalPromoSlides; i++) {
                const dot = document.getElementById(`promo-dot-${i}`);
                if (dot) {
                    if (i === currentPromoSlide) {
                        dot.classList.remove('bg-gray-300');
                        dot.classList.add('bg-green-600', 'w-6');
                    } else {
                        dot.classList.remove('bg-green-600', 'w-6');
                        dot.classList.add('bg-gray-300');
                    }
                }
            }
        }

        function movePromoSlide(direction) {
            currentPromoSlide += direction;
            if (currentPromoSlide >= totalPromoSlides) currentPromoSlide = 0;
            else if (currentPromoSlide < 0) currentPromoSlide = totalPromoSlides - 1;

            updatePromoCarousel();
            resetPromoAutoPlay();
        }

        function goToPromoSlide(index) {
            currentPromoSlide = index;
            updatePromoCarousel();
            resetPromoAutoPlay();
        }

        function startPromoAutoPlay() {
            promoTimer = setInterval(() => {
                movePromoSlide(1);
            }, promoIntervalTime);
        }

        function resetPromoAutoPlay() {
            clearInterval(promoTimer);
            startPromoAutoPlay();
        }

        document.addEventListener('DOMContentLoaded', () => {
            startPromoAutoPlay();
            window.addEventListener('resize', updatePromoCarousel);
        });
    </script>
@endpush
