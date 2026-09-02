import { useEffect, useMemo, useState } from "react";
import { motion } from "framer-motion";
import { cn } from "@/lib/utils";

export interface ShowcaseItem {
    id: string;
    title: string;
    subtitle?: string;
    image: string;
    date?: string;
    href?: string;
    modalId?: string;
    type: "promotion" | "news";
}

export interface PromotionNewsShowcaseProps {
    promotions: ShowcaseItem[];
    news: ShowcaseItem[];
}

function safeShowDialog(modalId?: string) {
    if (!modalId) return;

    const modal = document.getElementById(modalId) as HTMLDialogElement | null;
    modal?.showModal?.();
}

export function PromotionNewsShowcase({ promotions, news }: PromotionNewsShowcaseProps) {
    const [activeIndex, setActiveIndex] = useState(0);
    const [isPaused, setIsPaused] = useState(false);

    const items = useMemo(() => [...promotions, ...news], [promotions, news]);
    const activeItem = items[activeIndex] ?? items[0];

    useEffect(() => {
        if (activeIndex <= items.length - 1) return;
        setActiveIndex(0);
    }, [activeIndex, items.length]);

    useEffect(() => {
        if (items.length <= 1 || isPaused) return;

        const timer = window.setInterval(() => {
            setActiveIndex((index) => (index + 1) % items.length);
        }, 4800);

        return () => window.clearInterval(timer);
    }, [isPaused, items.length]);

    const selectIndex = (index: number) => {
        if (!items.length) return;

        const nextIndex = Math.max(0, Math.min(items.length - 1, Math.round(index)));
        setActiveIndex(nextIndex);
    };

    const getSlideOffset = (index: number) => {
        if (!items.length) return 0;

        const rawOffset = index - activeIndex;
        const half = items.length / 2;

        if (rawOffset > half) return rawOffset - items.length;
        if (rawOffset < -half) return rawOffset + items.length;

        return rawOffset;
    };

    const openActive = () => {
        if (!activeItem) return;

        if (activeItem.modalId) {
            safeShowDialog(activeItem.modalId);
            return;
        }

        if (activeItem.href) {
            window.location.href = activeItem.href;
        }
    };

    return (
        <section data-section="promotion-news-showcase" className="relative isolate overflow-visible bg-transparent py-14 md:py-18">
            <div className="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64" />

            <div className="relative z-10 mx-auto w-full max-w-[1680px] px-4 sm:px-6 lg:px-8">
                <div className="mx-auto mb-12 max-w-3xl text-center">
                    <h2 className="text-3xl md:text-4xl font-extrabold text-green-800 tracking-tight">
                        โปรโมชั่นและข่าวสารล่าสุด
                    </h2>
                    <div className="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full" />
                </div>

                <div
                    className="relative mx-auto min-h-[260px] w-full max-w-[1680px] overflow-visible p-0 sm:min-h-[340px] md:min-h-[420px]"
                    onMouseEnter={() => setIsPaused(true)}
                    onMouseLeave={() => setIsPaused(false)}
                >
                    <div className="pointer-events-none absolute inset-x-4 top-1/2 h-44 -translate-y-1/2 rounded-[999px] bg-[radial-gradient(ellipse_at_center,rgba(16,185,129,0.16),transparent_72%)] blur-2xl" />

                    <div className="relative z-10 w-full">
                        <div
                            className="relative mx-auto flex aspect-[1920/610] w-[min(72vw,1280px)] items-center justify-center overflow-visible"
                            aria-live="polite"
                        >
                            {items.length ? (
                                items.map((item, index) => {
                                    const offset = getSlideOffset(index);
                                    const isActive = offset === 0;
                                    const distance = Math.abs(offset);
                                    const isVisible = distance <= 1;

                                    return (
                                        <motion.div
                                            key={item.id}
                                            className="absolute left-1/2 top-1/2 aspect-[1920/610] w-full origin-center"
                                            initial={false}
                                            animate={{
                                                x: `calc(-50% + ${offset * 64}%)`,
                                                y: "-50%",
                                                scale: isActive ? 1 : 0.78,
                                                opacity: isVisible ? (isActive ? 1 : 0.86) : 0,
                                                filter: "blur(0px)",
                                            }}
                                            transition={{
                                                type: "spring",
                                                stiffness: 220,
                                                damping: 28,
                                                mass: 0.9,
                                            }}
                                            style={{
                                                zIndex: isActive ? 30 : 10 - distance,
                                                pointerEvents: isVisible ? "auto" : "none",
                                            }}
                                        >
                                            <button
                                                type="button"
                                                className={cn(
                                                    "group relative h-full w-full overflow-hidden rounded-2xl border bg-white shadow-[0_24px_70px_rgba(6,78,59,0.18),0_10px_28px_rgba(15,23,42,0.14)] transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-600",
                                                    isActive
                                                        ? "border-emerald-500/70 ring-1 ring-emerald-950/20"
                                                        : "border-slate-300/70",
                                                )}
                                                aria-label={item.title}
                                                aria-current={isActive}
                                                onClick={() => {
                                                    if (isActive) {
                                                        openActive();
                                                        return;
                                                    }

                                                    selectIndex(index);
                                                }}
                                            >
                                                <img
                                                    src={item.image}
                                                    alt={item.title}
                                                    className="h-full w-full object-contain"
                                                    loading={index === 0 ? "eager" : "lazy"}
                                                />
                                                {!isActive && <div className="absolute inset-0 bg-white/18" />}
                                                {item.type === "news" && (
                                                    <>
                                                        <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent" />
                                                        <div className="absolute inset-x-0 bottom-0 p-4 text-left">
                                                            {item.date && (
                                                                <div className="mb-1 text-[10px] font-bold text-sky-300">
                                                                    {item.date}
                                                                </div>
                                                            )}
                                                            <div className="line-clamp-2 text-sm font-extrabold leading-snug text-white sm:text-base">
                                                                {item.title || index + 1}
                                                            </div>
                                                        </div>
                                                    </>
                                                )}
                                            </button>
                                        </motion.div>
                                    );
                                })
                            ) : (
                                <div className="grid aspect-[1920/610] w-[min(74vw,1024px)] place-items-center rounded-2xl border border-emerald-950/10 bg-white text-sm font-bold text-emerald-950/50 shadow-[0_24px_60px_rgba(6,78,59,0.12)]">
                                    ยังไม่มีข่าวสาร
                                </div>
                            )}
                        </div>

                        {items.length > 1 && (
                            <div className="mt-8 flex justify-center gap-2">
                                {items.map((item, index) => {
                                    const isSelected = index === activeIndex;

                                    return (
                                        <button
                                            key={`dot-${item.id}`}
                                            type="button"
                                            className={cn(
                                                "h-2.5 rounded-full transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-600",
                                                isSelected
                                                    ? "w-10 bg-emerald-600"
                                                    : "w-2.5 bg-emerald-950/20 hover:bg-emerald-600/60",
                                            )}
                                            aria-label={`Select slide ${index + 1}`}
                                            aria-current={isSelected}
                                            onClick={() => selectIndex(index)}
                                        />
                                    );
                                })}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
}
