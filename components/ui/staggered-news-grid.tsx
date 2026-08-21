import React, { useEffect, useMemo, useState } from "react";
import { CalendarDays, CreditCard, Heart, Megaphone, Users } from "lucide-react";
import { cn } from "@/lib/utils";

export interface NewsCardItem {
    id: string;
    title: string;
    image: string;
    date?: string;
    href: string;
}

export interface NewsCategory {
    id: string;
    label: string;
    items: NewsCardItem[];
}

export interface StaggeredNewsGridProps {
    categories: NewsCategory[];
}

const categoryIcons: Record<string, React.ReactNode> = {
    information: <Megaphone className="h-4 w-4" strokeWidth={2} />,
    welfare: <Users className="h-4 w-4" strokeWidth={2} />,
    foundation: <Heart className="h-4 w-4" strokeWidth={2} />,
    credit: <CreditCard className="h-4 w-4" strokeWidth={2} />,
};

const fallbackRatios = ["3 / 4", "4 / 5", "16 / 10", "1 / 1", "2 / 3", "3 / 2"];

export function StaggeredNewsGrid({ categories }: StaggeredNewsGridProps) {
    const [activeCategoryId, setActiveCategoryId] = useState(categories[0]?.id ?? "");
    const [aspectRatios, setAspectRatios] = useState<string[]>([]);

    const activeCategory = useMemo(
        () => categories.find((category) => category.id === activeCategoryId) ?? categories[0],
        [activeCategoryId, categories],
    );

    const activeItems = activeCategory?.items ?? [];

    useEffect(() => {
        if (!categories.length) return;
        if (!categories.some((category) => category.id === activeCategoryId)) {
            setActiveCategoryId(categories[0].id);
        }
    }, [activeCategoryId, categories]);

    useEffect(() => {
        if (!activeItems.length) {
            setAspectRatios([]);
            return;
        }

        let cancelled = false;

        Promise.all(
            activeItems.map(
                (item, index) =>
                    new Promise<string>((resolve) => {
                        const image = new Image();

                        image.onload = () => {
                            if (image.naturalWidth && image.naturalHeight) {
                                resolve(`${image.naturalWidth} / ${image.naturalHeight}`);
                            } else {
                                resolve(fallbackRatios[index % fallbackRatios.length]);
                            }
                        };

                        image.onerror = () => {
                            resolve(fallbackRatios[index % fallbackRatios.length]);
                        };

                        image.src = item.image;
                    }),
            ),
        ).then((nextRatios) => {
            if (!cancelled) {
                setAspectRatios(nextRatios);
            }
        });

        return () => {
            cancelled = true;
        };
    }, [activeItems]);

    if (!activeCategory) {
        return null;
    }

    return (
        <section className="relative isolate overflow-visible bg-transparent py-14 text-slate-950 md:py-16">
            <div className="homepage-heading-spotlight pointer-events-none absolute inset-x-0 top-0 -z-10 h-64" />

            <div className="relative z-20 mx-auto mb-12 max-w-3xl text-center">
                <div className="inline-flex max-w-full gap-1 overflow-x-auto rounded-full border border-slate-200 bg-white p-1.5 shadow-[0_10px_30px_rgba(15,23,42,0.08)]">
                    {categories.map((category) => {
                        const isActive = category.id === activeCategory.id;

                        return (
                            <button
                                key={category.id}
                                type="button"
                                onClick={() => setActiveCategoryId(category.id)}
                                className={cn(
                                    "inline-flex shrink-0 items-center gap-2 rounded-full px-4 py-2 text-sm font-bold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 sm:px-5",
                                    isActive
                                        ? "bg-white text-emerald-700 shadow-sm ring-1 ring-slate-950/5"
                                        : "text-slate-500 hover:bg-white/80 hover:text-slate-800",
                                )}
                            >
                                {categoryIcons[category.id]}
                                <span>{category.label}</span>
                            </button>
                        );
                    })}
                </div>
            </div>

            {activeItems.length ? (
                <div className="mx-auto w-full max-w-[1500px] px-4">
                    <div className="columns-1 gap-4 sm:columns-2 lg:columns-3 xl:columns-4 [column-gap:1rem]">
                        {activeItems.map((item, index) => (
                            <NewsBlock
                                key={item.id}
                                item={item}
                                index={index}
                                aspectRatio={aspectRatios[index] ?? fallbackRatios[index % fallbackRatios.length]}
                            />
                        ))}
                    </div>
                </div>
            ) : (
                <div className="mx-auto grid min-h-[220px] max-w-5xl place-items-center rounded-lg border border-dashed border-slate-200 bg-slate-50 text-sm font-bold text-slate-500">
                    ยังไม่มีข่าวในหมวดนี้
                </div>
            )}
        </section>
    );
}

function NewsBlock({
    item,
    index,
    aspectRatio,
}: {
    item: NewsCardItem;
    index: number;
    aspectRatio: string;
}) {
    return (
        <a
            href={item.href}
            className="group mb-4 block break-inside-avoid overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_3px_12px_rgba(15,23,42,0.08)] transition duration-500 ease-out hover:z-30 hover:-translate-y-1 hover:border-emerald-500/35 hover:shadow-[0_24px_60px_rgba(15,23,42,0.18)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-600"
            style={{ aspectRatio } as React.CSSProperties}
        >
            <div className="relative h-full w-full">
                <img
                    src={item.image}
                    alt={item.title}
                    className="absolute inset-0 h-full w-full object-cover opacity-62 saturate-[0.86] transition duration-700 group-hover:scale-105 group-hover:opacity-100"
                    loading={index < 7 ? "eager" : "lazy"}
                />
                <div className="absolute inset-0 bg-gradient-to-b from-white/20 via-slate-950/24 to-slate-950/88 opacity-70 transition group-hover:opacity-95" />

                <div className="relative z-10 mt-auto flex h-full w-full translate-y-4 flex-col justify-end gap-2 p-4 opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100 group-focus-visible:translate-y-0 group-focus-visible:opacity-100">
                    <h3 className="line-clamp-2 text-sm font-black leading-6 text-white drop-shadow-md">
                        {item.title}
                    </h3>
                    <div className="flex items-center justify-between gap-3 text-[11px] font-semibold text-white/80">
                        <span className="inline-flex min-w-0 items-center gap-1.5">
                            <CalendarDays className="h-3.5 w-3.5 shrink-0" strokeWidth={1.8} />
                            <span className="truncate">{item.date}</span>
                        </span>
                        <span className="shrink-0 text-emerald-300">อ่านต่อ →</span>
                    </div>
                </div>
            </div>
        </a>
    );
}

export default StaggeredNewsGrid;
