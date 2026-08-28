"use client";

import { motion } from "framer-motion";
import { ArrowDown } from "lucide-react";
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

    if (!safeItems.length) {
        return null;
    }

    return (
        <section
            id="member-benefits"
            data-section="member-benefits"
            className="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden bg-[#0b0d0c] text-white"
        >
            <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(16,185,129,0.18),transparent_32rem)]" />
            <div className="relative mx-auto max-w-[1560px] px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
                <div className="mb-16 grid min-h-[72dvh] content-between border border-white/10 bg-[#101311] p-5 sm:p-8 lg:min-h-[780px]">
                    <div className="flex items-start justify-between gap-6">
                        <p className="text-[10px] font-black uppercase tracking-[0.42em] text-white/72">
                            Member Benefits
                        </p>
                        <p className="hidden text-[10px] font-black uppercase tracking-[0.42em] text-white/72 sm:block">
                            Scroll Inside
                        </p>
                    </div>

                    <div className="mx-auto w-full max-w-6xl text-center">
                        <GooeyTextReveal
                            mode="scroll"
                            duration={1.45}
                            stagger={0.12}
                            blurAmount={0.42}
                            start="top 72%"
                            className="mx-auto"
                        >
                            <h2
                                data-gooey-reveal-item
                                className="mx-auto max-w-5xl text-balance text-[clamp(3.25rem,9vw,9.5rem)] font-black leading-[0.9] tracking-normal"
                            >
                                {title}
                            </h2>
                        </GooeyTextReveal>

                        {subtitle ? (
                            <p className="mx-auto mt-7 max-w-2xl text-base font-semibold leading-relaxed text-white/62 sm:text-lg">
                                {subtitle}
                            </p>
                        ) : null}
                    </div>

                    <div className="mx-auto flex items-center justify-center">
                        <a
                            href="#member-benefit-list"
                            className="inline-flex min-h-10 items-center justify-center gap-3 border border-white/20 px-5 text-[10px] font-black uppercase tracking-[0.18em] text-white/86 transition hover:border-white/45 hover:bg-white/8"
                        >
                            Scroll to reveal
                            <ArrowDown className="h-3.5 w-3.5" strokeWidth={2.1} />
                        </a>
                    </div>
                </div>

                <div id="member-benefit-list" className="space-y-24 lg:space-y-32">
                    {safeItems.map((item, index) => {
                        const isEven = index % 2 === 0;

                        return (
                            <article
                                key={`${item.title}-${index}`}
                                className="grid items-center gap-7 lg:grid-cols-12 lg:gap-10"
                            >
                                <motion.div
                                    className={[
                                        "relative overflow-hidden border border-white/10 bg-white/5",
                                        isEven ? "lg:col-span-5" : "lg:col-span-5 lg:col-start-8",
                                    ].join(" ")}
                                    initial={{ opacity: 0, y: 42, filter: "blur(10px)" }}
                                    whileInView={{ opacity: 1, y: 0, filter: "blur(0px)" }}
                                    viewport={{ once: true, amount: 0.42 }}
                                    transition={{ duration: 0.9, ease: [0.22, 1, 0.36, 1] }}
                                >
                                    <img
                                        src={item.image}
                                        alt={item.title}
                                        className="aspect-[4/3] w-full object-cover"
                                        loading="lazy"
                                    />
                                </motion.div>

                                <div
                                    className={[
                                        isEven ? "lg:col-span-7" : "lg:col-span-7 lg:col-start-1 lg:row-start-1",
                                    ].join(" ")}
                                >
                                    <GooeyTextReveal
                                        mode="scroll"
                                        duration={1.25}
                                        stagger={0.1}
                                        blurAmount={0.38}
                                        start="top 76%"
                                    >
                                        <p
                                            data-gooey-reveal-item
                                            className="text-[clamp(2.4rem,6.2vw,6.6rem)] font-black leading-[0.9] tracking-normal text-white"
                                        >
                                            {item.title}
                                        </p>
                                    </GooeyTextReveal>

                                    <div className="mt-7 flex max-w-2xl items-start gap-5">
                                        <span className="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-white text-sm font-black text-emerald-900">
                                            {String(index + 1).padStart(2, "0")}
                                        </span>
                                        {item.description ? (
                                            <p className="pt-2 text-base font-semibold leading-relaxed text-white/66 sm:text-lg">
                                                {item.description}
                                            </p>
                                        ) : null}
                                    </div>
                                </div>
                            </article>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}

export default MemberBenefitsReveal;
