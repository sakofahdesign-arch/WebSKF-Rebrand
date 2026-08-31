"use client";

import { Gift, HandHeart, Landmark, Percent, ShieldCheck } from "lucide-react";
import { motion } from "framer-motion";
import { GooeyTextReveal } from "@/components/ui/gooey-text-reveal";

export type MemberBenefitItem = {
    title: string;
    description?: string;
    image: string;
};

type MemberBenefitsRevealProps = {
    title: string;
    subtitle?: string;
    items: MemberBenefitItem[];
};

export function MemberBenefitsReveal({
    title,
    subtitle,
    items,
}: MemberBenefitsRevealProps) {
    const safeItems = items.filter((item) => item.title && item.image);
    const icons = [Percent, Gift, HandHeart, Landmark, ShieldCheck];

    if (!safeItems.length) {
        return null;
    }

    return (
        <section
            id="member-benefits"
            data-section="member-benefits"
            className="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden bg-transparent text-emerald-950 dark:text-emerald-50"
        >
            <div className="relative mx-auto w-full max-w-[1560px] px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
                <motion.div
                    className="relative mx-auto min-h-[680px] w-full overflow-hidden bg-transparent py-6 sm:min-h-[760px] lg:min-h-[720px]"
                    initial={{ opacity: 0, y: 28 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true, amount: 0.22 }}
                    transition={{ duration: 0.7, ease: [0.22, 1, 0.36, 1] }}
                >
                    <svg className="pointer-events-none absolute left-0 top-20 hidden h-[520px] w-[520px] text-emerald-900/5 dark:text-white/5 sm:block" viewBox="0 0 100 100" aria-hidden="true">
                        <polygon fill="currentColor" points="50,3 61,37 97,37 68,58 79,92 50,71 21,92 32,58 3,37 39,37" />
                    </svg>
                    <svg className="pointer-events-none absolute left-0 top-10 hidden h-[640px] w-[640px] sm:block" viewBox="0 0 640 640" fill="none" aria-hidden="true">
                        <path d="M24 350 A286 286 0 0 1 224 62" stroke="url(#member-benefit-arc)" strokeWidth="16" strokeLinecap="round" />
                        <path d="M180 42 C520 100 580 448 244 594" stroke="currentColor" strokeOpacity="0.58" strokeWidth="2.1" fill="none" className="text-emerald-950 dark:text-emerald-200" />
                        <path d="M330 30 C618 118 626 420 350 582" stroke="currentColor" strokeOpacity="0.24" strokeWidth="1.4" fill="none" className="text-emerald-700 dark:text-emerald-300" />
                        <defs>
                            <linearGradient id="member-benefit-arc" x1="24" y1="350" x2="224" y2="62">
                                <stop offset="0" stopColor="#059669" />
                                <stop offset="1" stopColor="#a7f3d0" />
                            </linearGradient>
                        </defs>
                    </svg>

                    <div className="relative z-10 grid w-full gap-10 lg:grid-cols-[minmax(420px,0.9fr)_minmax(720px,1.35fr)] lg:items-center xl:gap-16">
                        <div className="relative min-h-[360px] sm:min-h-[520px] lg:min-h-[620px]">
                            <div className="absolute left-0 top-24 hidden h-[430px] w-[430px] rounded-full border border-emerald-800/10 bg-white/18 shadow-[inset_0_0_80px_rgba(16,185,129,0.10)] dark:border-emerald-200/12 dark:bg-emerald-50/8 dark:shadow-[inset_0_0_90px_rgba(167,243,208,0.07)] sm:block" />
                            <div className="relative z-10 max-w-md pt-16 sm:pl-12 sm:pt-52 lg:pl-20">
                                <GooeyTextReveal
                                    mode="scroll"
                                    duration={1.45}
                                    stagger={0.12}
                                    blurAmount={0.42}
                                    start="top 72%"
                                >
                                    <h2
                                        data-gooey-reveal-item
                                        className="max-w-[12ch] text-balance break-keep whitespace-normal text-4xl font-black leading-[1.06] tracking-normal text-emerald-900 dark:text-emerald-100 sm:text-5xl"
                                    >
                                        {title}
                                    </h2>
                                </GooeyTextReveal>
                                <div className="mt-5 h-1 w-20 rounded-full bg-emerald-500 dark:bg-emerald-300" />
                                {subtitle ? (
                                    <p className="mt-6 max-w-xs text-balance break-keep text-base font-semibold leading-relaxed text-black/70 dark:text-emerald-50/78">
                                        {subtitle}
                                    </p>
                                ) : null}
                            </div>
                        </div>

                        <div className="relative min-h-[560px] sm:min-h-[620px]">
                            <svg className="pointer-events-none absolute -left-16 top-0 hidden h-full w-56 text-emerald-950/46 dark:text-emerald-100/50 sm:block" viewBox="0 0 180 620" preserveAspectRatio="none" aria-hidden="true">
                                <path
                                    d="M60 24 C156 72 156 132 60 184 C-12 224 -8 286 72 328 C154 372 154 434 64 476 C8 504 6 560 78 600"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="1.5"
                                />
                            </svg>

                            <div className="grid gap-5 sm:gap-6">
                                {safeItems.map((item, index) => {
                                    const Icon = icons[index] ?? ShieldCheck;
                                    const offsets = [
                                        "sm:ml-0",
                                        "sm:ml-24",
                                        "sm:ml-34",
                                        "sm:ml-24",
                                        "sm:ml-2",
                                    ];

                                    return (
                                        <motion.article
                                            key={`${item.title}-${index}`}
                                            className={[
                                                "grid min-h-[88px] grid-cols-[4.5rem_1.25rem_minmax(0,1fr)] items-center gap-3 sm:min-h-[98px] sm:grid-cols-[5rem_1.5rem_minmax(0,1fr)] sm:gap-4",
                                                offsets[index] ?? "",
                                            ].join(" ")}
                                            initial={{ opacity: 0, x: 24 }}
                                            whileInView={{ opacity: 1, x: 0 }}
                                            viewport={{ once: true, amount: 0.45 }}
                                            transition={{ duration: 0.55, delay: index * 0.06, ease: [0.22, 1, 0.36, 1] }}
                                        >
                                            <span className="relative z-10 grid h-[64px] w-[64px] place-items-center rounded-full bg-[radial-gradient(circle_at_32%_25%,#ffffff,#ecfdf5_58%,#d1fae5)] text-xl font-black text-emerald-700 shadow-[0_12px_24px_rgba(15,23,42,0.16),inset_0_1px_2px_rgba(255,255,255,0.95),inset_0_-5px_10px_rgba(6,78,59,0.08)] ring-1 ring-white/80 dark:text-emerald-800 dark:shadow-[0_14px_30px_rgba(0,0,0,0.36),inset_0_1px_2px_rgba(255,255,255,0.95)] sm:h-[72px] sm:w-[72px] sm:text-2xl">
                                                {String(index + 1).padStart(2, "0")}
                                            </span>
                                            <span className="h-0.5 w-5 rounded-full bg-emerald-600 dark:bg-emerald-300" />
                                            <div className="flex min-w-0 items-start gap-3">
                                                <span className="mt-1 grid h-8 w-8 shrink-0 place-items-center text-emerald-700 dark:text-emerald-300">
                                                    <Icon className="h-7 w-7" strokeWidth={1.85} />
                                                </span>
                                                <div className="min-w-0">
                                                    <h3 className="text-balance break-keep text-base font-black leading-snug text-emerald-950 dark:text-emerald-100 sm:text-lg">
                                                        {item.title}
                                                    </h3>
                                                    {item.description ? (
                                                        <p className="mt-1.5 max-w-[42ch] text-sm font-semibold leading-relaxed text-black/72 dark:text-emerald-50/72">
                                                            {item.description}
                                                        </p>
                                                    ) : null}
                                                </div>
                                            </div>
                                        </motion.article>
                                    );
                                })}
                            </div>
                        </div>
                    </div>
                </motion.div>
            </div>
        </section>
    );
}

export default MemberBenefitsReveal;
