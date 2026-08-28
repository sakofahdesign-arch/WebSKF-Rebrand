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
        <section class="relative isolate overflow-hidden bg-base-100 py-16 lg:py-20">
            <div class="mx-auto max-w-[1560px] px-4 text-center sm:px-6 lg:px-8">
                <p class="text-4xl font-black leading-snug text-primary text-balance break-keep">
                    สิทธิประโยชน์ เมื่อเป็นสมาชิกเรา
                </p>
                <p class="mt-4 leading-relaxed text-black/70 text-balance break-keep">
                    กำลังโหลดสิทธิประโยชน์สมาชิก
                </p>
            </div>
        </section>
    </div>
@endif