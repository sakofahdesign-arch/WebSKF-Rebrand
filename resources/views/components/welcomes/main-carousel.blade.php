


<section class="relative w-full max-w-[1920px] mx-auto mt-6 group">
    
    <div id="hero-carousel"
        class="carousel flex w-full overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar shadow-lg border-b border-gray-100">

        <div class="carousel-item relative w-full flex-shrink-0 snap-center">
            <img src="{{ asset('images/267-1.jpg') }}" class="w-full h-auto object-contain" alt="Banner 1" />
        </div>

        <div class="carousel-item relative w-full flex-shrink-0 snap-center">
            <img src="{{ asset('images/values.jpg') }}" class="w-full h-auto object-contain" alt="Banner 2" />
        </div>

    </div>

    <div class="absolute flex justify-between transform -translate-y-1/2 left-0 right-0 top-1/2 z-30 pointer-events-none w-full px-4">
        <button onclick="moveSlide(-1)"
            class="btn btn-circle btn-md md:btn-lg bg-black/30 hover:bg-emerald-600 border-none text-white backdrop-blur-md pointer-events-auto transition-all shadow-lg hover:scale-110">
            <i class="fas fa-chevron-left text-lg md:text-xl"></i>
        </button>
        <button onclick="moveSlide(1)"
            class="btn btn-circle btn-md md:btn-lg bg-black/30 hover:bg-emerald-600 border-none text-white backdrop-blur-md pointer-events-auto transition-all shadow-lg hover:scale-110">
            <i class="fas fa-chevron-right text-lg md:text-xl"></i>
        </button>
    </div>

    <div id="carousel-dots" class="absolute flex justify-center w-full py-4 gap-2 bottom-0 z-30">
        </div>
</section>


@push('scripts')
<script>
    // --- ส่วนจัดการ Popup ---
    function initPopup() {
        const popup = document.getElementById('promo-popup');
        const content = document.getElementById('popup-content');
        
        // เช็คว่าเคยปิดไปหรือยัง (ใช้ sessionStorage = ปิดแล้วเปิดใหม่จะขึ้นอีก / localStorage = ปิดแล้วจำตลอดไป)
        // แนะนำ sessionStorage สำหรับประกาศทั่วไป
        const hasSeenPopup = sessionStorage.getItem('hasSeenPopup');

        if (!hasSeenPopup) {
            // ถ้ายังไม่เคยดู ให้แสดง Popup
            popup.classList.remove('hidden');
            // ทำ Animation Fade In
            setTimeout(() => {
                popup.classList.remove('opacity-0');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }, 100);
        }
    }

    function closePopup() {
        const popup = document.getElementById('promo-popup');
        const content = document.getElementById('popup-content');
        
        // Animation ออก
        popup.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-90');

        setTimeout(() => {
            popup.classList.add('hidden');
        }, 300);

        // บันทึกว่าดูแล้ว
        sessionStorage.setItem('hasSeenPopup', 'true');
    }

    // --- ส่วนจัดการ Carousel (เหมือนเดิมแต่ปรับให้รองรับรูปน้อยลง) ---
    document.addEventListener('DOMContentLoaded', () => {
        // 1. เริ่มทำงาน Popup
        initPopup();

        // 2. เริ่มทำงาน Carousel
        const carousel = document.getElementById('hero-carousel');
        const dotsContainer = document.getElementById('carousel-dots');
        const slides = carousel.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;
        let currentSlide = 0;
        let autoPlayInterval;

        // สร้าง Dots
        slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = `h-2 md:h-2.5 rounded-full transition-all duration-500 shadow-sm border border-white/50 backdrop-blur-sm ${index === 0 ? 'bg-emerald-500 w-6 md:w-8' : 'bg-white/70 hover:bg-white w-2 md:w-2.5'}`;
            dot.onclick = () => goToSlide(index);
            dotsContainer.appendChild(dot);
        });
        
        const dots = dotsContainer.querySelectorAll('button');

        function updateDots(index) {
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.className = 'h-2 md:h-2.5 w-6 md:w-8 rounded-full bg-emerald-500 transition-all duration-500 shadow-md border-transparent';
                } else {
                    dot.className = 'h-2 md:h-2.5 w-2 md:w-2.5 rounded-full bg-white/70 hover:bg-white transition-all duration-500 shadow-sm border border-white/50';
                }
            });
        }

        window.goToSlide = (index) => {
            currentSlide = index;
            const slideWidth = carousel.clientWidth;
            carousel.scrollTo({ left: slideWidth * index, behavior: 'smooth' });
            updateDots(index);
            resetAutoPlay();
        }

        window.moveSlide = (direction) => {
            let newIndex = currentSlide + direction;
            if (newIndex >= totalSlides) newIndex = 0;
            if (newIndex < 0) newIndex = totalSlides - 1;
            goToSlide(newIndex);
        }

        function startAutoPlay() {
            autoPlayInterval = setInterval(() => { moveSlide(1); }, 6000);
        }

        function resetAutoPlay() {
            clearInterval(autoPlayInterval);
            startAutoPlay();
        }

        carousel.addEventListener('scroll', () => {
            const slideWidth = carousel.clientWidth;
            const scrollPos = carousel.scrollLeft;
            const index = Math.round(scrollPos / slideWidth);
            if (index !== currentSlide && index >= 0 && index < totalSlides) {
                currentSlide = index;
                updateDots(index);
            }
        });

        startAutoPlay();
        window.addEventListener('resize', () => { goToSlide(currentSlide); });
    });
</script>
@endpush