@php
    $financialStatus = config('site-content.financial_status', []);
    $fs = fn ($path, $default = '') => data_get($financialStatus, $path, $default);
@endphp

<section data-section="financial-status" data-financial-odometer class="relative isolate overflow-hidden bg-transparent py-12 lg:py-14">
    <div class="relative z-10 mx-auto max-w-[1560px] px-4 sm:px-6 lg:px-8">
        <div class="relative grid items-start gap-7 xl:grid-cols-[minmax(0,1fr)_minmax(0,1fr)] xl:gap-16">
            <div class="pointer-events-none absolute bottom-0 left-1/2 top-0 hidden -translate-x-1/2 border-l border-dashed border-emerald-900/18 dark:border-white/14 xl:block" aria-hidden="true"></div>
            <div>
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-black dark:text-white md:text-4xl">
                            สถานะทางการเงิน
                        </h2>
                        <div class="mt-3 h-1 w-24 rounded-full bg-emerald-500"></div>
                    </div>
                    <div class="inline-flex w-fit items-center gap-2.5 rounded-lg border border-emerald-900/10 bg-white/88 px-4 py-2.5 text-xs font-extrabold text-emerald-800 shadow-[0_10px_26px_rgba(4,60,50,0.10)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/82 dark:text-white">
                        <i class="fa-regular fa-calendar-days text-emerald-700 dark:text-emerald-200" aria-hidden="true"></i>
                        <span>{{ $fs('meta.data_date_label', 'ข้อมูล ณ วันที่ 08 สิงหาคม 2569') }}</span>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-[minmax(0,1.1fr)_minmax(270px,1fr)]">
                    <article class="relative min-h-[226px] overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_16px_44px_rgba(4,60,50,0.10)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88 md:row-span-2">
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-emerald-100/80 to-transparent dark:from-emerald-400/12"></div>
                        <div class="absolute -left-8 bottom-0 h-40 w-[115%] rounded-[50%] border-b-[10px] border-emerald-400/46"></div>
                        <div class="relative flex h-full flex-col justify-between">
                            <div class="flex items-start justify-between gap-4">
                                <div class="grid h-20 w-20 shrink-0 place-items-center rounded-full bg-emerald-100/72 text-emerald-700 dark:bg-white/10 dark:text-white">
                                    <i class="fa-solid fa-people-group text-3xl" aria-hidden="true"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base font-semibold text-emerald-800 dark:text-white">สมาชิก (คน)</h3>
                                    <div class="mt-5 space-y-4">
                                        <div class="grid grid-cols-[minmax(0,1fr)_auto] items-end gap-5 border-b border-emerald-900/10 pb-3 dark:border-white/12">
                                            <div class="min-w-0 text-sm font-medium leading-tight text-emerald-700 dark:text-white/78">
                                                <span class="block min-w-0">สมาชิกทั้งหมด</span>
                                            </div>
                                            <span class="odometer shrink-0 whitespace-nowrap text-right text-[clamp(1.55rem,2vw,2.05rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('financial.total_members.odometer', 14075) }}">{{ $fs('financial.total_members.value', '14,075') }}</span>
                                        </div>
                                        <div class="grid grid-cols-[minmax(0,1fr)_auto] items-end gap-5">
                                            <div class="min-w-0 text-sm font-medium leading-tight text-emerald-700 dark:text-white/78">
                                                <span class="block min-w-0">สมาชิกสมทบ</span>
                                            </div>
                                            <span class="odometer shrink-0 whitespace-nowrap text-right text-[clamp(1.55rem,2vw,2.05rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('financial.associate_members.odometer', 1124) }}">{{ $fs('financial.associate_members.value', '1,124') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <span class="grid h-11 w-11 place-items-center rounded-full bg-emerald-600 text-white shadow-[0_12px_28px_rgba(4,120,87,0.28)]">
                                    <i class="fa-solid fa-users text-lg" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="relative z-10 flex items-start gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-chart-column text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-emerald-800 dark:text-white/86">จำนวนหุ้น</p>
                                <div class="mt-1">
                                    <span class="odometer whitespace-nowrap text-[clamp(1.4rem,1.9vw,2.1rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('financial.shares.odometer', 28736215) }}">{{ $fs('financial.shares.value', '28,736,215') }}</span>
                                    <span class="ml-1 text-xs font-semibold text-emerald-700 dark:text-white/70">{{ $fs('financial.shares.unit', 'หุ้น') }}</span>
                                </div>
                            </div>
                        </div>
                        <svg class="absolute bottom-0 right-4 h-16 w-44 text-emerald-500/70" viewBox="0 0 180 70" aria-hidden="true">
                            <polyline points="0,62 18,44 34,48 52,30 70,39 88,26 108,31 126,18 146,22 166,4 180,8" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M0 70 L0 62 L18 44 L34 48 L52 30 L70 39 L88 26 L108 31 L126 18 L146 22 L166 4 L180 8 L180 70 Z" fill="currentColor" opacity=".12" />
                        </svg>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="relative z-10 flex items-start gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-sack-dollar text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-emerald-800 dark:text-white/86">จำนวนเงิน</p>
                                <div class="mt-1">
                                    <span class="odometer whitespace-nowrap text-[clamp(1.25rem,1.7vw,1.75rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('financial.share_amount.odometer', 287362150) }}">{{ $fs('financial.share_amount.value', '287,362,150') }}</span>
                                    <span class="ml-1 text-xs font-semibold text-emerald-700 dark:text-white/70">{{ $fs('financial.share_amount.unit', 'บาท') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-6 flex h-20 items-end gap-2 text-emerald-500/60" aria-hidden="true">
                            <span class="h-6 w-4 rounded-t bg-current"></span>
                            <span class="h-7 w-4 rounded-t bg-current"></span>
                            <span class="h-11 w-4 rounded-t bg-current"></span>
                            <span class="h-15 w-4 rounded-t bg-current"></span>
                        </div>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="flex items-center gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-building-columns text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-emerald-800 dark:text-white/86">สินทรัพย์</p>
                                <div class="mt-1.5 flex min-w-0 flex-wrap items-baseline gap-x-1">
                                    <span class="odometer max-w-full whitespace-nowrap text-[clamp(1.46rem,1.9vw,2.05rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('financial.assets.odometer', 0) }}">{{ $fs('financial.assets.value', '0') }}</span>
                                    <span class="text-xs font-medium text-emerald-700 dark:text-white/62">{{ $fs('financial.assets.unit', 'ล้าน') }}</span>
                                </div>
                                <p class="mt-2.5 text-xs font-semibold text-emerald-700 dark:text-white/72"><i class="fa-solid fa-circle-arrow-up mr-1"></i> {{ $fs('financial.assets.trend', '+3.2% จากปีก่อนหน้า') }}</p>
                            </div>
                        </div>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="flex items-center gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-sack-dollar text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-emerald-800 dark:text-white/86">เงินฝาก</p>
                                <div class="mt-1.5">
                                    <span class="odometer whitespace-nowrap text-[clamp(1.65rem,2.35vw,2.45rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('financial.deposits.odometer', 7762) }}">{{ $fs('financial.deposits.value', '7,762') }}</span>
                                    <span class="ml-1 text-xs font-medium text-emerald-700 dark:text-white/62">{{ $fs('financial.deposits.unit', 'ล้าน') }}</span>
                                </div>
                                <p class="mt-2.5 text-xs font-semibold text-emerald-700 dark:text-white/72"><i class="fa-solid fa-circle-arrow-up mr-1"></i> {{ $fs('financial.deposits.trend', '+4.2% จากปีก่อนหน้า') }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div>
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-black dark:text-white md:text-4xl">
                            ประโยชน์ทางสังคมและสินเชื่อ
                        </h2>
                        <div class="mt-3 h-1 w-24 rounded-full bg-emerald-500"></div>
                    </div>
                    <div class="inline-flex w-fit items-center gap-2.5 rounded-lg border border-emerald-500/30 bg-emerald-100/72 px-4 py-2.5 text-xs font-extrabold text-emerald-800 shadow-[0_10px_26px_rgba(4,60,50,0.08)] dark:border-white/10 dark:bg-white/12 dark:text-white">
                        <i class="fa-solid fa-shield-heart text-emerald-700 dark:text-emerald-200" aria-hidden="true"></i>
                        <span>{{ $fs('meta.fiscal_year_label', 'ประจำปีบัญชี 2567') }}</span>
                    </div>
                </div>

                <div class="grid gap-4 lg:grid-cols-[minmax(300px,1fr)_minmax(300px,1fr)]">
                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="flex items-start gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-100 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-hand-holding-dollar text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-base font-semibold text-emerald-800 dark:text-white/86">ทุนสาธารณะ</p>
                                <div class="mt-1.5">
                                    <span class="odometer whitespace-nowrap text-[clamp(1.9rem,2.75vw,2.85rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('social_credit.public_fund.odometer', 3.36) }}">{{ $fs('social_credit.public_fund.value', '3.36') }}</span>
                                    <span class="ml-1 text-xs font-medium text-emerald-700 dark:text-white/62">{{ $fs('social_credit.public_fund.unit', 'ล้าน') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 h-1.5 rounded-full bg-emerald-900/10 dark:bg-white/12"><div class="h-full rounded-full bg-emerald-500" style="width: {{ $fs('social_credit.public_fund.progress', 58) }}%"></div></div>
                        <p class="mt-4 inline-flex items-center gap-2 text-xs font-medium text-emerald-800 dark:text-white/76">
                            <span class="grid h-7 w-7 place-items-center rounded-md bg-emerald-100 text-emerald-700 dark:bg-white dark:text-emerald-800"><i class="fa-solid fa-building-columns"></i></span>
                            {{ $fs('social_credit.public_fund.description', 'เพื่อประโยชน์สาธารณะของสมาชิกและชุมชน') }}
                        </p>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="flex items-start gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-calculator text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-base font-semibold text-emerald-800 dark:text-white/86">ให้สินเชื่อสมาชิก</p>
                                <div class="mt-1.5 flex min-w-0 flex-wrap items-baseline gap-x-1">
                                    <span class="odometer max-w-full whitespace-nowrap text-[clamp(1.25rem,1.75vw,1.8rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('social_credit.member_loans.odometer', 808738464) }}">{{ $fs('social_credit.member_loans.value', '808,738,464') }}</span>
                                    <span class="text-xs font-semibold text-emerald-700 dark:text-white/70">{{ $fs('social_credit.member_loans.unit', 'บาท') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex items-center gap-4 border-t border-emerald-900/8 pt-4 dark:border-white/12">
                            <div class="grid h-[3.25rem] w-[3.25rem] place-items-center rounded-full p-1" style="background: conic-gradient(#059669 0 {{ $fs('social_credit.member_loans.ratio', 89) }}%, #e5e7eb {{ $fs('social_credit.member_loans.ratio', 89) }}% 100%)">
                                <div class="grid h-full w-full place-items-center rounded-full bg-white text-xs font-black text-emerald-800">{{ $fs('social_credit.member_loans.ratio', 89) }}%</div>
                            </div>
                            <p class="text-xs font-medium text-emerald-800 dark:text-white/76">{{ $fs('social_credit.member_loans.ratio_label', 'สัดส่วนต่อยอดสินเชื่อรวม') }}</p>
                            <i class="fa-solid fa-chevron-right ml-auto text-emerald-500" aria-hidden="true"></i>
                        </div>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="flex items-start gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-100 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-hand-holding-heart text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-base font-semibold text-emerald-800 dark:text-white/86">ทุนสนับสนุนและพัฒนาสังคม</p>
                                <div class="mt-1.5">
                                    <span class="odometer whitespace-nowrap text-[clamp(1.75rem,2.45vw,2.55rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('social_credit.social_development_fund.odometer', 9.58) }}">{{ $fs('social_credit.social_development_fund.value', '9.58') }}</span>
                                    <span class="ml-1 text-xs font-medium text-emerald-700 dark:text-white/62">{{ $fs('social_credit.social_development_fund.unit', 'ล้าน') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 h-1.5 rounded-full bg-emerald-900/10 dark:bg-white/12"><div class="h-full rounded-full bg-emerald-500" style="width: {{ $fs('social_credit.social_development_fund.progress', 54) }}%"></div></div>
                        <p class="mt-4 inline-flex items-center gap-2 text-xs font-medium text-emerald-800 dark:text-white/76">
                            <span class="grid h-7 w-7 place-items-center rounded-md bg-emerald-100 text-emerald-700 dark:bg-white dark:text-emerald-800"><i class="fa-solid fa-users"></i></span>
                            {{ $fs('social_credit.social_development_fund.description', 'สร้างคุณภาพชีวิตที่ดีและพัฒนาสังคมอย่างยั่งยืน') }}
                        </p>
                    </article>

                    <article class="relative min-h-32 overflow-hidden rounded-lg border border-emerald-900/10 bg-white/92 p-5 shadow-[0_14px_38px_rgba(4,60,50,0.08)] backdrop-blur dark:border-white/10 dark:bg-emerald-950/88">
                        <div class="flex items-start gap-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-700 shadow-[0_10px_24px_rgba(4,60,50,0.09)] dark:bg-white dark:text-emerald-800">
                                <i class="fa-solid fa-handshake text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-base font-semibold text-emerald-800 dark:text-white/86">ให้สินเชื่อสหกรณ์อื่น</p>
                                <div class="mt-1.5 flex min-w-0 flex-wrap items-baseline gap-x-1">
                                    <span class="odometer max-w-full whitespace-nowrap text-[clamp(1.25rem,1.75vw,1.8rem)] font-black leading-none text-emerald-950 dark:text-white" data-odometer-value="{{ $fs('social_credit.coop_loans.odometer', 36000000) }}">{{ $fs('social_credit.coop_loans.value', '36,000,000') }}</span>
                                    <span class="text-xs font-semibold text-emerald-700 dark:text-white/70">{{ $fs('social_credit.coop_loans.unit', 'บาท') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex items-center gap-4 border-t border-emerald-900/8 pt-4 dark:border-white/12">
                            <div class="grid h-[3.25rem] w-[3.25rem] place-items-center rounded-full p-1" style="background: conic-gradient(#059669 0 {{ $fs('social_credit.coop_loans.ratio', 11) }}%, #e5e7eb {{ $fs('social_credit.coop_loans.ratio', 11) }}% 100%)">
                                <div class="grid h-full w-full place-items-center rounded-full bg-white text-xs font-black text-emerald-800">{{ $fs('social_credit.coop_loans.ratio', 11) }}%</div>
                            </div>
                            <p class="text-xs font-medium text-emerald-800 dark:text-white/76">{{ $fs('social_credit.coop_loans.ratio_label', 'สัดส่วนต่อยอดสินเชื่อรวม') }}</p>
                            <i class="fa-solid fa-chevron-right ml-auto text-emerald-500" aria-hidden="true"></i>
                        </div>
                    </article>
                </div>
            </div>
        </div>

    </div>
</section>
