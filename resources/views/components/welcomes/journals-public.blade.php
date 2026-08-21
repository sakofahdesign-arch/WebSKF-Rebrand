@php
    $ebooks = collect(config('site-content.ebooks'))->map(function ($book) {
        $cover = asset($book['cover']);

        return array_merge($book, [
            'images' => [
                'front' => $cover,
                'back' => $cover,
                'spine' => $cover,
            ],
        ]);
    })->values();
@endphp

<section id="journals" data-section="journals-public" class="relative isolate overflow-visible bg-transparent py-16 lg:py-20">
    <div class="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64"></div>

    <div class="relative z-10 mx-auto max-w-[1480px] px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-12 max-w-3xl text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-green-800 tracking-tight">
                วารสารและสื่อประชาสัมพันธ์
            </h2>
            <div class="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full"></div>
            <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-gray-600">
                Select and read Sakofah E-books and online journals.
            </p>
        </div>

        <div class="overflow-hidden rounded-xl border border-emerald-900/10 bg-white shadow-[0_28px_90px_rgba(4,60,50,0.08)]">
            <div
                data-books-showcase
                data-hero-title="E-Book"
                data-nav-title="วารสารออนไลน์"
                data-books='@json($ebooks)'
                class="h-[680px] min-h-[560px] w-full"
            >
                <div class="grid h-full place-items-center bg-white p-6 text-center text-emerald-950">
                    <div>
                        <p class="text-3xl font-black">วารสารออนไลน์</p>
                        <p class="mt-3 text-sm font-semibold text-emerald-950/60">กำลังโหลดชั้นหนังสือ E-book</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
