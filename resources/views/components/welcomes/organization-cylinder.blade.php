@php
    $hero = config('site-content.hero', []);
    $slides = $hero['slides'] ?? [];

    $carouselImages = collect($slides)
        ->filter(fn ($slide) => is_array($slide) && ! empty($slide['src']))
        ->map(fn ($slide) => [
            'src' => asset($slide['src']),
            'alt' => $slide['title'] ?? 'SAKOFAH',
        ])
        ->values();

    if ($carouselImages->isEmpty()) {
        $carouselImages = collect([
            ['src' => asset('images/logo-web.jpg'), 'alt' => 'SAKOFAH'],
        ]);
    }
@endphp

<section data-section="organization-cylinder-hero" class="org-hero text-emerald-950 dark:text-white">
    <div class="flex min-h-[calc(100dvh-2.5rem)] flex-col justify-center overflow-hidden pb-8 pt-0 sm:pb-10">
        <div class="relative left-1/2 w-screen -translate-x-1/2">
            <div data-cylinder-carousel
                data-images='@json($carouselImages)'
                data-animation-duration="32"
                data-card-width="360"
                data-depth-scale="1.05"
                data-perspective-distance="45em"
                data-mask-stops="4% 96%"
                class="h-[62vh] min-h-[560px] max-h-[720px] w-full">
            </div>
        </div>

        <div class="mx-auto -mt-20 flex w-full max-w-5xl flex-col items-center px-4 text-center sm:-mt-24 sm:px-6 lg:-mt-28">
            <img src="{{ asset($hero['logo'] ?? 'images/sakofah-logo.png') }}" alt="โลโก้สหกรณ์อิสลามษะกอฟะฮ"
                class="organization-hero-logo mb-5 h-24 w-24 object-contain md:h-28 md:w-28">

            <div
                data-morph-text
                data-words='@json(["SAKOFAH", "ษะกอฟะฮ", "الثقافة"])'
                data-interval="3000"
                class="min-h-[clamp(3.6rem,8.4vw,7.8rem)] text-emerald-900 dark:text-white"
            >
                <h1 class="text-[clamp(3.4rem,8vw,7.5rem)] font-black leading-[0.9] text-emerald-900 dark:text-white">
                    SAKOFAH
                </h1>
            </div>

            <p class="mt-1 max-w-3xl text-lg font-semibold leading-relaxed text-emerald-800 dark:text-white sm:text-xl md:text-2xl">
                สหกรณ์อิสลามษะกอฟะฮ จำกัด
            </p>

            <p class="mt-1 max-w-2xl text-base leading-relaxed text-emerald-950/80 dark:text-white/82 sm:text-lg">
                ยึดมั่นในหลักการอิสลาม พัฒนาคุณภาพชีวิต เศรษฐกิจ และสังคมของสมาชิกอย่างยั่งยืน
            </p>

            <div class="mt-5 grid w-full max-w-lg grid-cols-1 gap-3 sm:grid-cols-2 sm:gap-x-4">
                <div class="flex justify-center sm:justify-end">
                    <a href="{{ route('register') }}"
                        class="inline-flex min-h-12 min-w-44 items-center justify-center gap-3 rounded-full border border-emerald-900 bg-emerald-900 px-7 py-3 text-base font-semibold text-white shadow-[0_18px_45px_rgba(6,78,59,0.18)] transition duration-300 hover:-translate-y-0.5 hover:bg-emerald-950 active:translate-y-px">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                        บริการสมาชิก
                    </a>
                </div>
                <div class="flex justify-center sm:justify-start">
                    <a href="{{ route('office') }}"
                        class="inline-flex min-h-12 min-w-44 items-center justify-center gap-3 rounded-full border border-emerald-900/30 bg-white px-7 py-3 text-base font-semibold text-emerald-950 shadow-[0_16px_40px_rgba(6,78,59,0.1)] transition duration-300 hover:-translate-y-0.5 hover:border-emerald-900/55 active:translate-y-px dark:border-white dark:bg-white dark:text-emerald-950 dark:shadow-[0_16px_40px_rgba(255,255,255,0.12)]">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        ติดต่อสาขา
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

