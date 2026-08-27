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
    const [hoveredIndex, setHoveredIndex] = useState<number | null>(null);
    const [isPaused, setIsPaused] = useState(false);

    const items = useMemo(() => [...promotions, ...news], [promotions, news]);
    const activeItem = items[activeIndex] ?? items[0];

    const timelineNodes = useMemo(() => {
        const nodes: { type: "main" | "sub"; index: number; date?: string }[] = [];

        items.forEach((item, index) => {
            nodes.push({ type: "main", index, date: item.date || `${index + 1}` });

            if (index < items.length - 1) {
                for (let sub = 0; sub < 2; sub += 1) {
                    nodes.push({ type: "sub", index: index + (sub + 1) * 0.33 });
                }
            }
        });

        return nodes;
    }, [items]);

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
        setHoveredIndex(index);
        setActiveIndex(nextIndex);
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

            <div className="relative z-10 mx-auto w-full max-w-6xl px-4">
                <div className="mx-auto mb-12 max-w-3xl text-center">
                    <h2 className="text-3xl md:text-4xl font-extrabold text-green-800 tracking-tight">
                        โปรโมชั่นและข่าวสารล่าสุด
                    </h2>
                    <div className="mt-3 h-1 w-20 bg-green-500 mx-auto rounded-full" />
                </div>

                <div
                    className="relative mx-auto min-h-[250px] w-full max-w-6xl overflow-visible p-0 sm:min-h-[300px] md:min-h-[360px]"
                    onMouseEnter={() => setIsPaused(true)}
                    onMouseLeave={() => {
                        setIsPaused(false);
                        setHoveredIndex(null);
                    }}
                >
                    <svg xmlns="http://www.w3.org/2000/svg" className="absolute h-0 w-0" version="1.1">
                        <defs>
                            <filter id="SakofahTimeMachineFilter">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
                                <feColorMatrix
                                    in="blur"
                                    mode="matrix"
                                    values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -6"
                                    result="goo"
                                />
                                <feBlend in="SourceGraphic" in2="goo" />
                            </filter>
                        </defs>
                    </svg>

                    <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(6,78,59,0.08),transparent_72%)]" />

                    <div className="relative z-10 w-full">
                        <button
                            type="button"
                            className="relative mx-auto flex aspect-[1920/610] w-[min(80vw,1024px)] items-center justify-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-600"
                            style={{ perspective: "900px" }}
                            onClick={openActive}
                        >
                            {items.length ? (
                                items.map((item, index) => {
                                    const offset = index - activeIndex;
                                    const isPast = index < activeIndex;
                                    const distance = Math.abs(offset);

                                    return (
                                        <motion.div
                                            key={item.id}
                                            className="pointer-events-none absolute flex aspect-[1920/610] w-[min(74vw,1024px)] origin-center flex-col overflow-hidden rounded-2xl border border-emerald-950/10 bg-white shadow-[0_24px_60px_rgba(6,78,59,0.16),0_10px_28px_rgba(15,23,42,0.12)]"
                                            initial={false}
                                            animate={{
                                                z: isPast ? 210 : -offset * 64,
                                                y: isPast ? 260 : -offset * 13,
                                                rotateX: isPast ? -20 : offset * 2.5,
                                                opacity: isPast ? 0 : Math.max(0, 1 - distance * 0.2),
                                                scale: isPast ? 1.28 : 1 - Math.min(distance, 4) * 0.015,
                                            }}
                                            transition={{
                                                type: "spring",
                                                stiffness: 250,
                                                damping: 25,
                                                mass: 0.8,
                                            }}
                                            style={{
                                                zIndex: items.length - index,
                                                filter: "url(#SakofahTimeMachineFilter)",
                                            }}
                                        >
                                            <img
                                                src={item.image}
                                                alt={item.title}
                                                className={cn(
                                                    "h-full w-full",
                                                    item.type === "promotion" ? "object-contain" : "object-cover",
                                                )}
                                                loading={index === 0 ? "eager" : "lazy"}
                                            />
                                            {item.type === "news" && (
                                                <div className="absolute inset-0 bg-gradient-to-t from-black/78 via-black/14 to-transparent" />
                                            )}
                                            <div className="absolute inset-x-0 bottom-0 p-4 text-left">
                                                {item.type === "news" && item.date && (
                                                    <div className="mb-1 text-[10px] font-bold text-sky-300">
                                                        {item.date}
                                                    </div>
                                                )}
                                                {item.type === "news" && (
                                                    <div className="line-clamp-2 text-sm font-extrabold leading-snug text-white sm:text-base">
                                                        {item.title || index + 1}
                                                    </div>
                                                )}
                                            </div>
                                            {item.type === "news" && <div className="absolute inset-0 bg-black/8" />}
                                        </motion.div>
                                    );
                                })
                            ) : (
                                <div className="grid aspect-[1920/610] w-[min(74vw,1024px)] place-items-center rounded-2xl border border-emerald-950/10 bg-white text-sm font-bold text-emerald-950/50 shadow-[0_24px_60px_rgba(6,78,59,0.12)]">
                                    ยังไม่มีข่าวสาร
                                </div>
                            )}
                        </button>

                        {items.length > 1 && (
                            <div
                                className="absolute right-0 top-1/2 z-50 flex -translate-y-1/2 flex-col items-end py-2 max-md:right-1 max-md:translate-x-1/2"
                                onMouseLeave={() => setHoveredIndex(null)}
                            >
                                {timelineNodes.map((node) => {
                                    if (node.type === "main") {
                                        const isSelected = activeIndex === node.index;

                                        return (
                                            <button
                                                key={`main-${node.index}`}
                                                type="button"
                                                className="group relative inline-flex w-16 cursor-pointer items-center justify-end border-0 bg-transparent py-[1px] sm:w-20"
                                                onMouseEnter={() => selectIndex(node.index)}
                                                onClick={(event) => {
                                                    event.stopPropagation();
                                                    selectIndex(node.index);
                                                }}
                                            >
                                                {hoveredIndex === node.index ? (
                                                    <motion.span
                                                        className={cn(
                                                            "absolute right-9 top-0 max-w-34 truncate text-[10px] font-semibold whitespace-nowrap",
                                                            isSelected ? "text-emerald-700" : "text-emerald-950/72",
                                                        )}
                                                        initial={{ opacity: 0, filter: "blur(2px)", scale: 0.8 }}
                                                        animate={{ opacity: 1, filter: "blur(0px)", scale: 1 }}
                                                        transition={{ duration: 0.15 }}
                                                    >
                                                        {node.date}
                                                    </motion.span>
                                                ) : null}
                                                <motion.div
                                                    className={cn(
                                                        "h-[3px] w-6 origin-right rounded-full transition-colors",
                                                        isSelected ? "bg-emerald-600" : "bg-slate-400 group-hover:bg-emerald-500",
                                                    )}
                                                    animate={{
                                                        scaleX:
                                                            hoveredIndex === null
                                                                ? 1
                                                                : isSelected
                                                                  ? 1.4
                                                                  : Math.abs(node.index - hoveredIndex) < 0.5
                                                                    ? 1.25
                                                                    : 1,
                                                    }}
                                                    transition={{ type: "spring", stiffness: 400, damping: 25 }}
                                                />
                                            </button>
                                        );
                                    }

                                    const isHoveringNear = hoveredIndex !== null && Math.abs(node.index - hoveredIndex) <= 0.5;

                                    return (
                                        <button
                                            key={`sub-${node.index}`}
                                            type="button"
                                            className="flex w-16 cursor-pointer justify-end border-0 bg-transparent py-[1px] sm:w-20"
                                            onMouseEnter={() => selectIndex(node.index)}
                                            onClick={(event) => {
                                                event.stopPropagation();
                                                selectIndex(node.index);
                                            }}
                                        >
                                            <motion.div
                                                className="h-[3px] w-6 origin-right rounded-full bg-slate-300"
                                                animate={{
                                                    scaleX: hoveredIndex === null ? 1 : isHoveringNear ? 1.15 : 1,
                                                    opacity: hoveredIndex === null ? 0.3 : isHoveringNear ? 0.5 : 0.3,
                                                }}
                                                transition={{ type: "spring", stiffness: 400, damping: 25 }}
                                            />
                                        </button>
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
