<section id="main-hero-carousel" class="relative w-full" data-carousel="slide">
    <div class="relative h-[280px] overflow-hidden md:h-[480px]">
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/267-1.jpg') }}" class="absolute block w-full h-full object-cover"
                alt="แบนเนอร์โปรโมชัน">
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/values.jpg') }}" class="absolute block w-full h-full object-cover"
                alt="ค่านิยมองค์กร">
        </div>
    </div>
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-current="true" aria-label="Slide 1"
            data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false"
            aria-label="Slide 2" data-carousel-slide-to="1"></button>
    </div>
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 focus:ring-4 focus:ring-white focus:outline-none">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg><span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 focus:ring-4 focus:ring-white focus:outline-none">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg><span class="sr-only">Next</span>
        </span>
    </button>
</section>
