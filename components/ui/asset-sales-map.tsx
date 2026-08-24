import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import {
    BadgeCheck,
    Building2,
    ChevronRight,
    ExternalLink,
    FileText,
    Heart,
    Home,
    LandPlot,
    ListFilter,
    Map as MapIcon,
    MapPin,
    Navigation,
    Phone,
    Ruler,
    Signpost,
    type LucideIcon,
} from "lucide-react";
import {
    Map,
    MapControls,
    MapMarker,
    MapPopup,
    MarkerContent,
    type MapRef,
} from "@/components/ui/map";

export type AssetSaleLocation = {
    id: string;
    title: string;
    category: string;
    listingType?: "sale" | "rent";
    price?: string;
    area?: string;
    status?: string;
    description1: string;
    description2: string;
    contact: string;
    latitude: number;
    longitude: number;
    image: string;
    map_link: string;
    edit_url: string;
};

type AssetSalesMapProps = {
    assets: AssetSaleLocation[];
    variant?: "section" | "fullscreen";
};

type ListingFilter = "all" | "sale" | "rent";

const listingFilterLabels: Record<ListingFilter, string> = {
    all: "ทั้งหมด",
    sale: "ขาย",
    rent: "เช่า",
};

function getAssetListingType(asset: AssetSaleLocation): Exclude<ListingFilter, "all"> {
    return asset.listingType ?? "sale";
}

function getAssetListingLabel(asset: AssetSaleLocation): string {
    return listingFilterLabels[getAssetListingType(asset)];
}

function getMapCenter(assets: AssetSaleLocation[]): [number, number] {
    if (!assets.length) {
        return [99.09, 7.81];
    }

    const totals = assets.reduce(
        (sum, asset) => ({
            latitude: sum.latitude + asset.latitude,
            longitude: sum.longitude + asset.longitude,
        }),
        { latitude: 0, longitude: 0 },
    );

    return [totals.longitude / assets.length, totals.latitude / assets.length];
}

function getMapBounds(assets: AssetSaleLocation[]): [[number, number], [number, number]] | null {
    if (!assets.length) {
        return null;
    }

    const longitudes = assets.map((asset) => asset.longitude);
    const latitudes = assets.map((asset) => asset.latitude);

    return [
        [Math.min(...longitudes), Math.min(...latitudes)],
        [Math.max(...longitudes), Math.max(...latitudes)],
    ];
}

function getAssetMarker(category: string): { Icon: LucideIcon; iconClassName: string; markerClassName: string } {
    if (category.includes("บ้าน") || category.includes("ทาวน์")) {
        return {
            Icon: Home,
            iconClassName: "text-white",
            markerClassName: "bg-emerald-700 ring-2 ring-white/90",
        };
    }

    if (category.includes("ที่ดิน")) {
        return {
            Icon: LandPlot,
            iconClassName: "text-white",
            markerClassName: "bg-yellow-500 ring-2 ring-white/90",
        };
    }

    if (category.includes("คอนโด")) {
        return {
            Icon: Building2,
            iconClassName: "text-white",
            markerClassName: "bg-red-600 ring-2 ring-white/90",
        };
    }

    return {
        Icon: Signpost,
        iconClassName: "text-white",
        markerClassName: "bg-slate-700 ring-2 ring-white/90",
    };
}

function AssetPopupCard({ asset }: { asset: AssetSaleLocation }) {
    return (
        <div className="w-[min(82vw,332px)] overflow-hidden rounded-lg bg-white text-slate-950 shadow-2xl shadow-slate-950/25 ring-1 ring-emerald-900/10 font-sans [font-family:var(--font-sans)] dark:bg-[#061f19] dark:text-emerald-50 dark:ring-emerald-300/18">
            <img
                src={asset.image}
                alt={asset.title}
                className="h-auto max-h-[260px] w-full object-contain bg-slate-100 dark:bg-[#0a2b24]"
                loading="lazy"
            />
            <div className="p-4">
                <div className="mb-2 inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-300/12 dark:text-emerald-100">
                    {asset.category}
                </div>
                <p className="text-lg font-extrabold leading-tight text-emerald-800 dark:text-emerald-50">{asset.title}</p>
                {asset.price ? (
                    <p className="mt-2 text-3xl font-black leading-none text-emerald-950 dark:text-emerald-300">฿{asset.price}</p>
                ) : null}
                <div className="mt-3 flex flex-wrap gap-2 text-xs font-bold text-emerald-800">
                    {asset.area ? <span className="rounded-full bg-emerald-50 px-2.5 py-1 dark:bg-white/10 dark:text-emerald-50">{asset.area}</span> : null}
                    {asset.status ? <span className="rounded-full bg-amber-50 px-2.5 py-1 text-amber-700 dark:bg-amber-300/14 dark:text-amber-100">{asset.status}</span> : null}
                </div>
                <div className="mt-3 space-y-3">
                    <div className="flex gap-2.5">
                        <MapPin className="mt-0.5 h-4 w-4 shrink-0 text-emerald-700" />
                        <p className="text-sm leading-relaxed text-slate-600 dark:text-emerald-50/72">
                            {asset.description1 || `${asset.latitude}, ${asset.longitude}`}
                        </p>
                    </div>
                    {asset.description2 ? (
                        <p className="rounded-lg bg-slate-50 p-3 text-sm leading-relaxed text-slate-600 dark:bg-white/8 dark:text-emerald-50/72">
                            {asset.description2}
                        </p>
                    ) : null}
                    <div className="flex items-center gap-2.5">
                        <Phone className="h-4 w-4 shrink-0 text-emerald-700" />
                        <p className="text-sm font-extrabold text-slate-900 dark:text-white">{asset.contact || "ติดต่อเจ้าหน้าที่"}</p>
                    </div>
                </div>
                <div className="mt-4 grid grid-cols-2 gap-2">
                    <a
                        href={asset.map_link}
                        target="_blank"
                        rel="noreferrer"
                        className="inline-flex min-h-10 items-center justify-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-sm font-bold text-white shadow-[0_12px_26px_rgba(16,185,129,0.25)] transition hover:bg-emerald-700 active:translate-y-px"
                    >
                        <Navigation className="h-4 w-4" />
                        นำทาง
                    </a>
                    <a
                        href={asset.edit_url}
                        className="inline-flex min-h-10 items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-bold text-emerald-700 transition hover:bg-emerald-50 active:translate-y-px dark:border-emerald-300/32 dark:bg-transparent dark:text-emerald-100 dark:hover:bg-white/8"
                    >
                        รายละเอียด
                        <ExternalLink className="h-4 w-4" />
                    </a>
                </div>
            </div>
        </div>
    );
}

export function AssetSalesMap({ assets, variant = "section" }: AssetSalesMapProps) {
    const mapRef = useRef<MapRef | null>(null);
    const [activeId, setActiveId] = useState(assets[0]?.id || "");
    const [popupId, setPopupId] = useState<string | null>(null);
    const [selectedCategory, setSelectedCategory] = useState("ทั้งหมด");
    const [selectedListingFilter, setSelectedListingFilter] = useState<ListingFilter>("all");
    const categories = useMemo(
        () => ["ทั้งหมด", ...Array.from(new Set(assets.map((asset) => asset.category).filter(Boolean)))],
        [assets],
    );
    const visibleAssets = useMemo(
        () => assets.filter((asset) => {
            const matchesCategory = selectedCategory === "ทั้งหมด" || asset.category === selectedCategory;
            const matchesListing = selectedListingFilter === "all" || getAssetListingType(asset) === selectedListingFilter;

            return matchesCategory && matchesListing;
        }),
        [assets, selectedCategory, selectedListingFilter],
    );
    const activeAsset = visibleAssets.find((asset) => asset.id === activeId) || visibleAssets[0] || null;
    const popupAsset = visibleAssets.find((asset) => asset.id === popupId) || null;
    const center = useMemo(() => getMapCenter(visibleAssets), [visibleAssets]);
    const bounds = useMemo(() => getMapBounds(visibleAssets), [visibleAssets]);

    const isFullscreen = variant === "fullscreen";
    const sidebarPositionClass = isFullscreen ? "top-24 md:top-24" : "top-4 md:top-5";
    const sidebarHeightClass = isFullscreen
        ? "max-h-[min(560px,calc(100dvh-8rem))]"
        : "max-h-[min(430px,calc(100%-2rem))] md:max-h-[min(460px,calc(100%-2.5rem))]";
    const sidebarWidthClass = "w-[min(320px,calc(100vw-2rem))]";

    const fitOverview = useCallback(() => {
        setPopupId(null);

        if (!bounds) {
            return;
        }

        mapRef.current?.fitBounds(bounds, {
            padding: { top: 74, right: 78, bottom: 76, left: 400 },
            duration: 900,
            maxZoom: 13,
            essential: true,
        });
    }, [bounds]);

    useEffect(() => {
        const timer = window.setTimeout(fitOverview, 300);

        return () => window.clearTimeout(timer);
    }, [fitOverview]);

    useEffect(() => {
        setActiveId(visibleAssets[0]?.id || "");
        setPopupId(null);
    }, [selectedCategory, selectedListingFilter, visibleAssets]);

    function focusAsset(asset: AssetSaleLocation, showPopup = false) {
        setActiveId(asset.id);
        setPopupId(showPopup ? asset.id : null);

        mapRef.current?.flyTo({
            center: [asset.longitude, asset.latitude],
            zoom: 14,
            offset: showPopup ? [70, 260] : [0, 0],
            duration: 900,
            essential: true,
        });
    }

    if (!assets.length) {
        return (
            <div className="grid h-full min-h-[420px] place-items-center bg-slate-950 text-sm font-semibold text-white/70 font-sans [font-family:var(--font-sans)]">
                ยังไม่มีรายการขายทรัพย์สินที่มีพิกัด GPS
            </div>
        );
    }

    return (
        <div
            className={[
                "relative overflow-hidden bg-slate-950 font-sans [font-family:var(--font-sans)]",
                isFullscreen
                    ? "h-[100dvh] min-h-[704px]"
                    : "h-[min(720px,calc(100dvh-7rem))] min-h-[560px]",
            ].join(" ")}
        >
            <Map
                ref={mapRef}
                center={center}
                zoom={12}
                theme="dark"
                className="h-full w-full"
                attributionControl={{ compact: true }}
            >
                <MapControls showFullscreen />

                {visibleAssets.map((asset) => {
                    const isActive = asset.id === activeAsset?.id;
                    const {
                        Icon: MarkerIcon,
                        iconClassName: markerIconClassName,
                        markerClassName,
                    } = getAssetMarker(asset.category);

                    return (
                        <MapMarker
                            key={asset.id}
                            longitude={asset.longitude}
                            latitude={asset.latitude}
                            onClick={() => focusAsset(asset, true)}
                        >
                            <MarkerContent>
                                <button
                                    type="button"
                                    onClick={(event) => {
                                        event.stopPropagation();
                                        focusAsset(asset, true);
                                    }}
                                    className={[
                                        "grid h-10 w-10 place-items-center rounded-full transition duration-300",
                                        markerClassName,
                                        isActive
                                            ? "scale-110 shadow-[0_0_0_10px_rgba(16,185,129,0.24),0_14px_30px_rgba(0,0,0,0.36)]"
                                            : "shadow-[0_8px_18px_rgba(0,0,0,0.3)] hover:scale-105",
                                    ].join(" ")}
                                    aria-label={asset.category}
                                >
                                    <MarkerIcon className={`h-5 w-5 ${markerIconClassName}`} strokeWidth={2.1} />
                                </button>
                            </MarkerContent>
                        </MapMarker>
                    );
                })}

                {popupAsset && (
                    <MapPopup
                        longitude={popupAsset.longitude}
                        latitude={popupAsset.latitude}
                        offset={[0, -28]}
                        className="!max-w-none !rounded-none !border-0 !bg-transparent !p-0 !text-inherit !shadow-none"
                        closeButton
                        onClose={() => setPopupId(null)}
                    >
                        <AssetPopupCard asset={popupAsset} />
                    </MapPopup>
                )}

                <aside
                    className={[
                        "absolute left-4 z-20 flex flex-col overflow-hidden rounded-[22px] bg-white font-sans shadow-[0_24px_60px_rgba(2,6,23,0.34)] ring-1 ring-emerald-900/8 [font-family:var(--font-sans)] md:left-5 dark:bg-[#05221c] dark:ring-emerald-300/12",
                        sidebarPositionClass,
                        sidebarHeightClass,
                        sidebarWidthClass,
                    ].join(" ")}
                >
                    <div className="relative isolate min-h-[86px] overflow-hidden bg-[linear-gradient(135deg,#065f46,#064e3b_54%,#022c22)] px-4 pb-5 pt-4 text-white">
                        <div className="absolute inset-y-0 right-0 -z-10 w-32 opacity-22 [background:radial-gradient(circle_at_20%_50%,rgba(255,255,255,.18),transparent_28%),repeating-linear-gradient(90deg,transparent_0_8px,rgba(255,255,255,.12)_8px_9px)]" />
                        <div className="flex items-center gap-3">
                            <span className="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-white/12 ring-1 ring-white/12">
                                <MapPin className="h-[18px] w-[18px]" strokeWidth={2.4} />
                            </span>
                            <div>
                                <p className="text-base font-black leading-tight">รายการขายทรัพย์สิน</p>
                                <p className="mt-0.5 text-[11px] font-bold text-emerald-200">{visibleAssets.length} รายการในแผนที่</p>
                            </div>
                        </div>
                    </div>
                    <div className="border-b border-emerald-900/8 bg-white px-3 pb-3 pt-4 dark:border-emerald-300/12 dark:bg-[#061c18]">
                        <label className="mb-2 flex items-center gap-2 text-[10px] font-medium text-black dark:text-emerald-100/72">
                            <ListFilter className="h-3.5 w-3.5" />
                            เลือกประเภทสินทรัพย์
                        </label>
                        <select
                            value={selectedCategory}
                            onChange={(event) => {
                                setSelectedCategory(event.target.value);
                                setSelectedListingFilter("all");
                            }}
                            className="h-9 w-full rounded-xl border border-emerald-200 bg-white px-3 text-xs font-extrabold text-emerald-950 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-100 dark:border-emerald-300/30 dark:bg-[#08271f] dark:text-emerald-50 dark:focus:border-emerald-300 dark:focus:bg-[#0a3027] dark:focus:ring-emerald-300/18"
                        >
                            {categories.map((category) => (
                                <option key={category} value={category}>
                                    {category}
                                </option>
                            ))}
                        </select>
                        <div className="mt-2 grid grid-cols-3 gap-2">
                            {(["all", "sale", "rent"] as ListingFilter[]).map((filter) => {
                                const isActive = selectedListingFilter === filter;

                                return (
                                    <button
                                        key={filter}
                                        type="button"
                                        onClick={() => setSelectedListingFilter(filter)}
                                        className={[
                                            "min-h-9 rounded-full border px-2 text-[11px] font-black transition",
                                            filter === "sale"
                                                ? isActive
                                                    ? "border-emerald-700 bg-emerald-700 text-white shadow-[0_8px_18px_rgba(5,150,105,0.2)]"
                                                    : "border-emerald-700 bg-white text-emerald-900 hover:bg-emerald-50 dark:bg-transparent dark:text-emerald-100 dark:hover:bg-emerald-300/12"
                                                : filter === "rent"
                                                    ? isActive
                                                        ? "border-yellow-300 bg-yellow-300 text-emerald-950 shadow-[0_8px_18px_rgba(234,179,8,0.2)]"
                                                        : "border-yellow-300 bg-white text-yellow-700 hover:bg-yellow-50 dark:bg-transparent dark:text-yellow-100 dark:hover:bg-yellow-300/12"
                                                    : isActive
                                                        ? "border-slate-950 bg-slate-950 text-white shadow-[0_8px_18px_rgba(15,23,42,0.14)] dark:border-white dark:bg-white dark:text-emerald-950"
                                                        : "border-slate-950 bg-transparent text-slate-950 hover:bg-slate-50 dark:border-white/62 dark:text-white dark:hover:bg-white/8",
                                        ].join(" ")}
                                    >
                                        {listingFilterLabels[filter]}
                                    </button>
                                );
                            })}
                        </div>
                    </div>
                    <div className="min-h-0 overflow-y-auto bg-[#fbfefd] px-3 py-3 dark:bg-[#061c18]">
                        <button
                            type="button"
                            onClick={fitOverview}
                            className="mb-2.5 flex min-h-10 w-full items-center gap-3 rounded-xl border border-emerald-200 bg-white px-3 py-2.5 text-left text-xs font-extrabold text-emerald-900 shadow-[0_8px_24px_rgba(6,78,59,0.06)] transition hover:border-emerald-300 hover:bg-emerald-50 active:translate-y-px dark:border-emerald-400/18 dark:bg-[#0a2d25] dark:text-emerald-50 dark:shadow-none dark:hover:border-emerald-300/34 dark:hover:bg-[#0d3a30]"
                        >
                            <span className="grid h-6 w-6 shrink-0 place-items-center rounded-full bg-emerald-700 text-white dark:bg-white dark:text-emerald-700">
                                <MapIcon className="h-3.5 w-3.5" />
                            </span>
                            <span className="min-w-0 flex-1">ภาพรวม</span>
                            <ChevronRight className="h-4 w-4 shrink-0 text-emerald-700" />
                        </button>
                        <div className="space-y-2.5">
                            {visibleAssets.map((asset) => {
                                const isActive = asset.id === activeAsset?.id;
                                const listingType = getAssetListingType(asset);
                                const listingLabel = getAssetListingLabel(asset);

                                return (
                                    <button
                                        key={asset.id}
                                        type="button"
                                        onClick={() => focusAsset(asset, true)}
                                        className={[
                                            "group relative flex w-full gap-2.5 rounded-xl border bg-white p-2 text-left text-xs font-semibold shadow-[0_8px_22px_rgba(15,23,42,0.07)] transition dark:shadow-none",
                                            isActive
                                                ? "border-emerald-200 text-emerald-950 shadow-[0_14px_34px_rgba(4,120,87,0.14)] dark:border-emerald-400/35 dark:bg-[#0e3a31] dark:text-white"
                                                : "border-slate-100 text-slate-500 hover:border-emerald-100 hover:text-emerald-900 dark:border-emerald-300/10 dark:bg-[#0a251f] dark:text-emerald-100/76 dark:hover:border-emerald-300/28 dark:hover:bg-[#0d3028] dark:hover:text-white",
                                        ].join(" ")}
                                    >
                                        <span className="relative h-[76px] w-[76px] shrink-0 overflow-hidden rounded-lg bg-slate-100 dark:bg-[#113a31]">
                                            <img
                                                src={asset.image}
                                                alt={asset.title}
                                                className="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                                loading="lazy"
                                            />
                                            <span className="absolute bottom-1 left-1 rounded-full bg-emerald-700/92 px-1.5 py-0.5 text-[8px] font-extrabold text-white shadow-sm">
                                                {asset.category}
                                            </span>
                                        </span>
                                        <span className="min-w-0 flex-1">
                                            <span className="flex items-start gap-2">
                                                <span className="block min-w-0 flex-1 text-xs font-extrabold leading-snug text-emerald-950 dark:text-emerald-50">{asset.title}</span>
                                                <Heart className="mt-0.5 h-4 w-4 shrink-0 text-black/72 dark:text-emerald-200/58" strokeWidth={1.7} />
                                            </span>
                                            <span className={[
                                                "mt-1 inline-flex rounded-full px-1.5 py-0.5 text-[8px] font-black shadow-sm",
                                                listingType === "rent"
                                                    ? "bg-yellow-300 text-emerald-950"
                                                    : "bg-emerald-700 text-white",
                                            ].join(" ")}>
                                                {listingLabel}
                                            </span>
                                            <span className="mt-1 flex items-center gap-1 text-[9px] font-medium text-black/72 dark:text-emerald-100/62">
                                                <MapPin className="h-3 w-3" />
                                                <span className="truncate">{asset.category}</span>
                                            </span>
                                            {asset.area ? (
                                                <span className="mt-1 flex items-center gap-1 text-[9px] font-medium text-black/72 dark:text-emerald-100/62">
                                                    <Ruler className="h-3 w-3" />
                                                    <span>{asset.area}</span>
                                                </span>
                                            ) : null}
                                            <span className="mt-1.5 flex items-end justify-between gap-1.5">
                                                {asset.price ? (
                                                    <span className="text-sm font-black leading-none text-emerald-800 dark:text-emerald-300">฿{asset.price}</span>
                                                ) : null}
                                                {asset.status ? (
                                                    <span className="inline-flex shrink-0 items-center gap-0.5 rounded-full bg-emerald-50 px-1.5 py-0.5 text-[8px] font-extrabold text-emerald-800 ring-1 ring-emerald-100 dark:bg-white dark:text-emerald-800 dark:ring-white/60">
                                                        {asset.status.includes("เอกสาร") ? (
                                                            <FileText className="h-3 w-3" />
                                                        ) : (
                                                            <BadgeCheck className="h-3 w-3" />
                                                        )}
                                                        {asset.status}
                                                    </span>
                                                ) : null}
                                            </span>
                                        </span>
                                        {isActive && <ChevronRight className="h-4 w-4 shrink-0 text-emerald-500 dark:text-emerald-200" />}
                                    </button>
                                );
                            })}
                        </div>
                    </div>
                </aside>

                <div className="pointer-events-none absolute bottom-4 left-4 z-30 rounded-full bg-black/55 px-3 py-1.5 text-xs font-semibold text-white/80 md:left-[366px]">
                    พิกัดจากข้อมูลขายทรัพย์สินในระบบ
                </div>
            </Map>
        </div>
    );
}
