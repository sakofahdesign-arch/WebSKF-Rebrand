import React, { useEffect, useMemo, useRef, useState } from "react";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import imagesLoaded from "imagesloaded";
import { cn } from "@/lib/utils";

gsap.registerPlugin(ScrollTrigger);

export interface BentoItem {
    id: number | string;
    title: string;
    subtitle: string;
    description: string;
    icon: React.ReactNode;
    content?: React.ReactNode;
    image?: string;
    href?: string;
}

export interface StaggeredGridProps {
    images: string[];
    bentoItems: BentoItem[];
    centerText?: string;
    logoImage?: string;
    credits?: {
        madeBy: { text: string; href: string };
        moreDemos: { text: string; href: string };
    };
    className?: string;
    showFooter?: boolean;
    scroller?: string | Element | Window | null;
}

type TileLayout = {
    src: string;
    colSpan: number;
    rowSpan: number;
    aspectRatio: string;
};

const DEFAULT_TILE_LAYOUTS: Omit<TileLayout, "src">[] = [
    { colSpan: 1, rowSpan: 27, aspectRatio: "3 / 4" },
    { colSpan: 1, rowSpan: 36, aspectRatio: "4 / 5" },
    { colSpan: 1, rowSpan: 22, aspectRatio: "1 / 1" },
    { colSpan: 1, rowSpan: 31, aspectRatio: "3 / 4" },
    { colSpan: 1, rowSpan: 40, aspectRatio: "2 / 3" },
    { colSpan: 1, rowSpan: 26, aspectRatio: "4 / 5" },
    { colSpan: 1, rowSpan: 33, aspectRatio: "3 / 4" },
    { colSpan: 2, rowSpan: 24, aspectRatio: "16 / 10" },
    { colSpan: 1, rowSpan: 37, aspectRatio: "2 / 3" },
    { colSpan: 1, rowSpan: 24, aspectRatio: "1 / 1" },
];

function calculateTileLayout(src: string, index: number, width?: number, height?: number): TileLayout {
    if (!width || !height) {
        return { src, ...DEFAULT_TILE_LAYOUTS[index % DEFAULT_TILE_LAYOUTS.length] };
    }

    const ratio = width / height;
    const isWide = ratio >= 1.28;
    const isSquare = ratio > 0.86 && ratio < 1.18;
    const colSpan = isWide ? 2 : 1;
    const rowSpan = Math.max(20, Math.min(46, Math.round((height / width) * (isWide ? 18 : 30))));

    return {
        src,
        colSpan,
        rowSpan: isSquare ? Math.max(22, Math.min(30, rowSpan)) : rowSpan,
        aspectRatio: `${width} / ${height}`,
    };
}

export function StaggeredGrid({
    images,
    bentoItems,
    centerText = "บริการ",
    logoImage,
    credits = {
        madeBy: { text: "@codrops", href: "https://x.com/codrops" },
        moreDemos: { text: "More demos", href: "https://tympanus.net/codrops/demos" },
    },
    className,
    showFooter = true,
    scroller,
}: StaggeredGridProps) {
    const [isLoaded, setIsLoaded] = useState(false);
    const [activeBento, setActiveBento] = useState(0);
    const [imageLayouts, setImageLayouts] = useState<TileLayout[]>(() =>
        images.map((src, index) => ({ src, ...DEFAULT_TILE_LAYOUTS[index % DEFAULT_TILE_LAYOUTS.length] })),
    );
    const gridFullRef = useRef<HTMLDivElement>(null);
    const textRef = useRef<HTMLDivElement>(null);

    const splitText = (text: string) =>
        text.split("").map((char, i) => (
            <span key={i} className="char inline-block" style={{ willChange: "transform" }}>
                {char === " " ? "\u00A0" : char}
            </span>
        ));

    useEffect(() => {
        const handleLoad = () => {
            document.body.classList.remove("loading");
            setIsLoaded(true);
        };

        const trackedImages = document.querySelectorAll(".grid__item-img");
        const loader = imagesLoaded(trackedImages, { background: true }, handleLoad);

        return () => {
            loader.off("always", handleLoad);
        };
    }, []);

    useEffect(() => {
        if (!images.length) {
            setImageLayouts([]);
            return;
        }

        let cancelled = false;

        Promise.all(
            images.map(
                (src, index) =>
                    new Promise<TileLayout>((resolve) => {
                        const image = new Image();

                        image.onload = () => {
                            resolve(calculateTileLayout(src, index, image.naturalWidth, image.naturalHeight));
                        };

                        image.onerror = () => {
                            resolve({ src, ...DEFAULT_TILE_LAYOUTS[index % DEFAULT_TILE_LAYOUTS.length] });
                        };

                        image.src = src;
                    }),
            ),
        ).then((layouts) => {
            if (!cancelled) {
                setImageLayouts(layouts);
                requestAnimationFrame(() => {
                    ScrollTrigger.refresh();
                });
            }
        });

        return () => {
            cancelled = true;
        };
    }, [images]);

    useEffect(() => {
        if (!isLoaded) return;

        const ctx = gsap.context(() => {
            if (textRef.current) {
                const chars = textRef.current.querySelectorAll(".char");
                gsap.timeline({
                    scrollTrigger: {
                        trigger: textRef.current,
                        scroller: scroller || undefined,
                        start: "top bottom",
                        end: "center center-=25%",
                        scrub: 1,
                    },
                }).from(chars, {
                    ease: "sine.out",
                    yPercent: 240,
                    autoAlpha: 0,
                    stagger: {
                        each: 0.05,
                        from: "center",
                    },
                });
            }

            if (gridFullRef.current) {
                const gridItems = gridFullRef.current.querySelectorAll(".grid__item");

                gsap.from(gridItems, {
                    scrollTrigger: {
                        trigger: gridFullRef.current,
                        scroller: scroller || undefined,
                        start: "top bottom",
                        end: "center center",
                        scrub: 1.2,
                    },
                    yPercent: 180,
                    autoAlpha: 0,
                    ease: "sine.out",
                    stagger: 0.045,
                });

                const bentoContainer = gridFullRef.current.querySelector(".bento-container");

                if (bentoContainer) {
                    gsap.timeline({
                        scrollTrigger: {
                            trigger: gridFullRef.current,
                            scroller: scroller || undefined,
                            start: "top top+=15%",
                            end: "bottom center",
                            scrub: 1,
                            invalidateOnRefresh: true,
                        },
                    }).to(
                        bentoContainer,
                        {
                            y: window.innerHeight * 0.04,
                            scale: 1.12,
                            zIndex: 1000,
                            ease: "power2.out",
                            duration: 1,
                            force3D: true,
                        },
                        0,
                    );
                }
            }
        }, gridFullRef);

        return () => ctx.revert();
    }, [isLoaded, scroller]);

    const mixedGridItems = useMemo<(TileLayout | "BENTO_GROUP")[]>(() => {
        if (!images.length) return [];

        const items = Array.from({ length: Math.max(images.length, 20) }, (_, index) => {
            const layoutFromState = imageLayouts.length
                ? imageLayouts[index % imageLayouts.length]
                : undefined;
            const layout = layoutFromState ?? calculateTileLayout(images[index % images.length], index);
            return layout;
        });

        items.splice(Math.min(12, items.length), 0, "BENTO_GROUP");
        return items;
    }, [imageLayouts, images]);

    return (
        <div className={cn("relative w-full overflow-hidden shadow", className)}>
            <section className="relative mt-[4vh] grid w-full place-items-center">
                <div
                    ref={textRef}
                    className="flex content-center text-[clamp(3.75rem,13vw,10rem)] font-black leading-[0.72] text-emerald-950"
                >
                    {splitText(centerText)}
                </div>
            </section>

            <section className="relative grid w-full place-items-center">
                <div
                    ref={gridFullRef}
                    className="grid--full relative my-[5vh] grid h-auto w-full max-w-none grid-cols-2 gap-4 p-4 [grid-auto-flow:dense] [grid-auto-rows:8px] sm:grid-cols-4 lg:grid-cols-7"
                >
                    <div className="grid-overlay pointer-events-none absolute inset-0 z-[15] rounded-lg bg-white/80 opacity-0 transition-opacity duration-500 dark:bg-black/80" />

                    {logoImage && (
                        <img
                            src={logoImage}
                            alt=""
                            aria-hidden="true"
                            className="pointer-events-none absolute left-1/2 top-1/2 z-[12] h-[34%] w-auto -translate-x-1/2 -translate-y-1/2 object-contain opacity-[0.055]"
                        />
                    )}

                    {mixedGridItems.map((item, i) => {
                        if (item === "BENTO_GROUP") {
                            if (!bentoItems || bentoItems.length === 0) return null;

                            return (
                                <div
                                    key="bento-group"
                                    className="grid__item bento-container relative z-20 col-span-2 flex h-full min-h-[10.5rem] w-full items-center justify-center gap-3 self-stretch will-change-transform [grid-row:span_22] sm:col-span-3 lg:[grid-row:span_24]"
                                >
                                    {bentoItems.map((bentoItem, index) => {
                                        const isActive = activeBento === index;

                                        return (
                                            <div
                                                key={bentoItem.id}
                                                className={cn(
                                                    "group relative aspect-square min-h-[8.25rem] max-h-[10.5rem] flex-1 cursor-pointer overflow-hidden rounded-lg transition-all duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2",
                                                    isActive
                                                        ? "bg-emerald-950 shadow-[0_22px_60px_rgba(6,78,59,0.34)]"
                                                        : "bg-neutral-950 shadow-[0_16px_44px_rgba(15,23,42,0.18)]",
                                                )}
                                                onMouseEnter={() => setActiveBento(index)}
                                                onClick={() => {
                                                    setActiveBento(index);
                                                    if (bentoItem.href) window.location.href = bentoItem.href;
                                                }}
                                                onKeyDown={(event) => {
                                                    if (
                                                        (event.key === "Enter" || event.key === " ") &&
                                                        bentoItem.href
                                                    ) {
                                                        event.preventDefault();
                                                        window.location.href = bentoItem.href;
                                                    }
                                                }}
                                                role={bentoItem.href ? "link" : undefined}
                                                tabIndex={bentoItem.href ? 0 : undefined}
                                            >
                                                <div
                                                    className={cn(
                                                        "pointer-events-none absolute inset-0 z-50 rounded-lg border transition-colors duration-500",
                                                        isActive
                                                            ? "border-emerald-300/55"
                                                            : "border-white/10 group-hover:border-emerald-200/40",
                                                    )}
                                                />

                                                <div
                                                    className={cn(
                                                        "absolute inset-0 transition-all duration-500 ease-in-out",
                                                        isActive
                                                            ? "translate-y-0 opacity-100"
                                                            : "pointer-events-none translate-y-4 opacity-0",
                                                    )}
                                                >
                                                    <div className="absolute inset-0 z-0 overflow-hidden bg-emerald-950">
                                                        {bentoItem.image && (
                                                            <>
                                                                <img
                                                                    src={bentoItem.image}
                                                                    alt={bentoItem.title}
                                                                    className="absolute inset-0 h-full w-full object-cover opacity-28 saturate-75 transition-opacity duration-700 group-hover:opacity-38"
                                                                />
                                                                <div className="pointer-events-none absolute inset-0 bg-emerald-950/50" />
                                                            </>
                                                        )}
                                                        {logoImage && (
                                                            <img
                                                                src={logoImage}
                                                                alt=""
                                                                aria-hidden="true"
                                                                className="absolute left-1/2 top-1/2 h-[48%] w-auto -translate-x-1/2 -translate-y-1/2 object-contain opacity-[0.09]"
                                                            />
                                                        )}
                                                    </div>

                                                    <div className="absolute inset-0 z-20 flex flex-col items-center justify-center gap-3 p-4 text-center">
                                                        <div className="text-emerald-50 drop-shadow-md">
                                                            {bentoItem.icon}
                                                        </div>
                                                        <div className="flex flex-col">
                                                            <span className="text-[11px] font-semibold text-emerald-100/70">
                                                                {bentoItem.subtitle}
                                                            </span>
                                                            <h3 className="text-sm font-black leading-tight tracking-normal text-white drop-shadow-md sm:text-base">
                                                                {bentoItem.title}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    className={cn(
                                                        "absolute inset-0 flex flex-col items-center justify-center gap-3 p-4 text-center transition-all duration-500",
                                                        isActive
                                                            ? "pointer-events-none scale-95 opacity-0"
                                                            : "scale-100 opacity-100",
                                                    )}
                                                >
                                                    {logoImage && (
                                                        <img
                                                            src={logoImage}
                                                            alt=""
                                                            aria-hidden="true"
                                                            className="absolute h-16 w-16 object-contain opacity-[0.06]"
                                                        />
                                                    )}
                                                    <div className="relative z-10 text-emerald-100/70 transition-colors group-hover:text-white">
                                                        {bentoItem.icon}
                                                    </div>
                                                    <span className="relative z-10 px-2 text-center text-xs font-black leading-tight text-zinc-400 transition-colors group-hover:text-white sm:text-sm">
                                                        {bentoItem.title}
                                                    </span>
                                                </div>
                                            </div>
                                        );
                                    })}
                                </div>
                            );
                        }

                        if (typeof item !== "string") {
                            const label = ["สมาชิก", "เงินฝาก", "สินเชื่อ", "เอกสาร"][i % 4];

                            return (
                                <figure
                                    key={`img-${i}`}
                                    className="grid__item group relative z-10 m-0 cursor-pointer [perspective:800px] will-change-[transform,opacity]"
                                    style={
                                        {
                                            gridColumnEnd: `span ${item.colSpan}`,
                                            gridRowEnd: `span ${item.rowSpan}`,
                                        } as React.CSSProperties
                                    }
                                >
                                    <div className="grid__item-img relative flex h-full w-full items-center justify-center overflow-hidden rounded-lg border border-emerald-950/10 bg-white shadow-sm transition-all duration-500 ease-out [backface-visibility:hidden] group-hover:scale-[1.02] group-hover:border-emerald-900/20 group-hover:shadow-lg">
                                        <img
                                            src={item.src}
                                            alt={label}
                                            className="absolute inset-0 h-full w-full object-cover opacity-40 saturate-[0.82] contrast-95 transition-all duration-700 group-hover:scale-105 group-hover:opacity-75"
                                            style={{ aspectRatio: item.aspectRatio }}
                                        />
                                        <div className="absolute inset-0 z-0 bg-white/16" />

                                        {logoImage && (
                                            <img
                                                src={logoImage}
                                                alt=""
                                                aria-hidden="true"
                                                className="absolute left-1/2 top-1/2 z-[1] h-[38%] w-auto -translate-x-1/2 -translate-y-1/2 object-contain opacity-[0.055]"
                                            />
                                        )}

                                        <div className="absolute inset-0 z-0 bg-gradient-to-b from-emerald-950/0 via-emerald-950/10 to-emerald-950/30 opacity-0 transition-opacity duration-500 group-hover:opacity-100" />

                                        <div className="relative z-10 flex flex-col items-center justify-center gap-3">
                                            <div className="translate-y-2 text-center opacity-0 transition-all delay-75 duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                                <span className="mb-0.5 block text-[10px] font-semibold tracking-wider text-emerald-950/70">
                                                    SAKOFAH
                                                </span>
                                                <span className="block text-sm font-black tracking-normal text-emerald-950">
                                                    {label}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                            );
                        }

                        return null;
                    })}
                </div>
            </section>

            {showFooter && (
                <footer className="frame__footer relative z-50 flex w-full items-center justify-between p-8 text-xs font-medium uppercase tracking-wider text-neutral-900 dark:text-white">
                    <a href={credits.madeBy.href} className="transition-opacity hover:opacity-60">
                        {credits.madeBy.text}
                    </a>
                    <a href={credits.moreDemos.href} className="transition-opacity hover:opacity-60">
                        {credits.moreDemos.text}
                    </a>
                </footer>
            )}
        </div>
    );
}

export default StaggeredGrid;
