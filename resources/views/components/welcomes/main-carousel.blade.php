<section class="relative w-full group">
    <div id="hero-carousel"
        class="carousel w-full h-[300px] md:h-[500px] relative overflow-hidden rounded-none md:rounded-b-2xl shadow-lg">

        <div id="slide1" class="carousel-item relative w-full duration-700 ease-in-out">
            <img src="{{ asset('images/267-1.jpg') }}" class="w-full h-full object-cover" alt="Banner 1" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
        </div>

        <div id="slide2" class="carousel-item relative w-full duration-700 ease-in-out">
            <img src="{{ asset('images/values.jpg') }}" class="w-full h-full object-cover" alt="Banner 2" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
        </div>

    </div>

    <div
        class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2 z-30 pointer-events-none">
        <button onclick="moveSlide(-1)"
            class="btn btn-circle btn-sm md:btn-md bg-white/30 hover:bg-white border-none text-white hover:text-green-700 backdrop-blur-sm pointer-events-auto transition-all shadow-md">
            ❮
        </button>
        <button onclick="moveSlide(1)"
            class="btn btn-circle btn-sm md:btn-md bg-white/30 hover:bg-white border-none text-white hover:text-green-700 backdrop-blur-sm pointer-events-auto transition-all shadow-md">
            ❯
        </button>
    </div>

    <div class="absolute flex justify-center w-full py-2 gap-2 bottom-5 z-30">
        <button onclick="goToSlide(0)" id="dot-0"
            class="w-3 h-3 rounded-full bg-white transition-all duration-300 scale-125 shadow"></button>
        <button onclick="goToSlide(1)" id="dot-1"
            class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 shadow"></button>
    </div>
</section>

@push('scripts')
    <script>
        let currentSlide = 0;
        const carousel = document.getElementById('hero-carousel');
        const totalSlides = carousel.children.length; // จำนวน Slide ทั้งหมด
        const autoPlayInterval = 5000; // เวลาในการเปลี่ยนรูป (5 วินาที)
        let autoPlayTimer;

        function updateCarousel() {
            // คำนวณตำแหน่งที่จะเลื่อนไป
            const slideWidth = carousel.clientWidth;
            carousel.scrollTo({
                left: currentSlide * slideWidth,
                behavior: 'smooth'
            });

            // Update Dots styling
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.getElementById(`dot-${i}`);
                if (dot) {
                    if (i === currentSlide) {
                        dot.classList.remove('bg-white/50');
                        dot.classList.add('bg-white', 'scale-125');
                    } else {
                        dot.classList.add('bg-white/50');
                        dot.classList.remove('bg-white', 'scale-125');
                    }
                }
            }
        }

        function moveSlide(direction) {
            currentSlide += direction;

            // Loop กลับไปมา
            if (currentSlide >= totalSlides) {
                currentSlide = 0;
            } else if (currentSlide < 0) {
                currentSlide = totalSlides - 1;
            }

            updateCarousel();
            resetAutoPlay();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
            resetAutoPlay();
        }

        function startAutoPlay() {
            autoPlayTimer = setInterval(() => {
                moveSlide(1);
            }, autoPlayInterval);
        }

        function resetAutoPlay() {
            clearInterval(autoPlayTimer);
            startAutoPlay();
        }

        // เริ่มทำงานเมื่อโหลดเสร็จ
        document.addEventListener('DOMContentLoaded', () => {
            startAutoPlay();

            // ปรับขนาดเมื่อ Resize หน้าจอเพื่อให้ตำแหน่งถูกต้องเสมอ
            window.addEventListener('resize', updateCarousel);
        });
    </script>
@endpush
