@php
    $memberBenefits = config('site-content.member_benefits', []);
    $benefitItems = collect($memberBenefits['items'] ?? [])
        ->map(function ($item) {
            return [
                'title' => $item['title'] ?? '',
                'description' => $item['description'] ?? '',
                'image' => asset($item['image'] ?? 'content/hero/Hero (1).jpg'),
            ];
        })
        ->values();
@endphp

@if ($benefitItems->isNotEmpty())
    <div
        data-member-benefits-reveal
        data-title="{{ $memberBenefits['title'] ?? 'สิทธิประโยชน์ เมื่อเป็นสมาชิกเรา' }}"
        data-subtitle="{{ $memberBenefits['subtitle'] ?? '' }}"
        data-items='@json($benefitItems)'
    >
        <section class="relative isolate overflow-hidden bg-transparent py-14 lg:py-18">
            <div class="mx-auto w-full max-w-[1560px] px-4 text-center sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold leading-snug text-emerald-800 text-balance break-keep dark:text-emerald-100 md:text-4xl">
                    สิทธิประโยชน์ เมื่อเป็นสมาชิกเรา
                </h2>
                <div class="mx-auto mt-3 h-1 w-20 rounded-full bg-emerald-500 dark:bg-emerald-300"></div>
                <p class="mt-4 leading-relaxed text-black/70 text-balance break-keep dark:text-emerald-50/78">
                    กำลังโหลดสิทธิประโยชน์สมาชิก
                </p>
            </div>
        </section>
    </div>
@endif
