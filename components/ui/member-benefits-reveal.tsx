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
            className="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden bg-transparent text-emerald-950"
        >
            <div className="relative mx-auto max-w-[1280px] px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
                <div className="mb-14 grid min-h-[420px] content-between bg-transparent p-0 sm:min-h-[460px]">
                    <div className="flex items-start justify-between gap-6">
                        <p className="text-[10px] font-black uppercase tracking-[0.42em] text-emerald-950/60">
                            Member Benefits
                        </p>
                        <p className="hidden text-[10px] font-black uppercase tracking-[0.42em] text-emerald-950/60 sm:block">
                            Scroll Inside
                        </p>
                    </div>

                    <div className="mx-auto w-full max-w-4xl text-center">
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
                                className="mx-auto max-w-3xl text-balance break-keep whitespace-normal text-3xl font-black leading-snug tracking-normal text-emerald-900 sm:text-4xl lg:text-5xl"
                            >
                                {title}
                            </h2>
                        </GooeyTextReveal>

                        {subtitle ? (
                            <p className="mx-auto mt-5 max-w-2xl text-balance break-keep text-sm font-semibold leading-relaxed text-black sm:text-base">
                                {subtitle}
                            </p>
                        ) : null}
                    </div>

                    <div className="mx-auto flex items-center justify-center">
                        <a
                            href="#member-benefit-list"
                            className="inline-flex min-h-10 items-center justify-center gap-3 rounded-full border border-emerald-900/20 px-5 text-[10px] font-black uppercase tracking-[0.18em] text-emerald-950 transition hover:border-emerald-700 hover:bg-emerald-50/80"
                        >
                            Scroll to reveal
                            <ArrowDown className="h-3.5 w-3.5" strokeWidth={2.1} />
                        </a>
                    </div>
                </div>

                <div id="member-benefit-list" className="space-y-16 lg:space-y-20">
                    {safeItems.map((item, index) => {
                        const isEven = index % 2 === 0;

                        return (
                            <article
                                key={`${item.title}-${index}`}
                                className="grid items-center gap-7 lg:grid-cols-12 lg:gap-10"
                            >
                                <motion.div
                                    className={[
                                        "relative overflow-hidden rounded-2xl bg-white/70 shadow-[0_18px_48px_rgba(6,78,59,0.10)] ring-1 ring-emerald-900/10 backdrop-blur-sm",
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
                                        className="aspect-[4/3] w-full rounded-2xl object-cover"
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
                                            className="text-balance break-keep whitespace-normal text-2xl font-black leading-snug tracking-normal text-emerald-900 sm:text-3xl lg:text-4xl"
                                        >
                                            {item.title}
                                        </p>
                                    </GooeyTextReveal>

                                    <div className="mt-5 flex max-w-2xl items-start gap-4">
                                        <span className="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-emerald-800 text-xs font-black text-white">
                                            {String(index + 1).padStart(2, "0")}
                                        </span>
                                        {item.description ? (
                                            <p className="pt-1.5 text-sm font-semibold leading-relaxed text-black sm:text-base">
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
