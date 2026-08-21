import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import { ChevronRight, ExternalLink, MapPin, Navigation, Phone, Signpost } from "lucide-react";
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
};

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

function AssetPopupCard({ asset }: { asset: AssetSaleLocation }) {
    return (
        <div className="w-[min(82vw,332px)] overflow-hidden rounded-lg bg-white text-slate-950 shadow-2xl shadow-slate-950/25 ring-1 ring-emerald-900/10 font-sans [font-family:var(--font-sans)]">
            <img
                src={asset.image}
                alt={asset.title}
                className="h-auto max-h-[260px] w-full object-contain bg-slate-100"
                loading="lazy"
            />
            <div className="p-4">
                <div className="mb-2 inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                    {asset.category}
                </div>
                <p className="text-lg font-extrabold leading-tight text-emerald-800">{asset.title}</p>
                <div className="mt-3 space-y-3">
                    <div className="flex gap-2.5">
                        <MapPin className="mt-0.5 h-4 w-4 shrink-0 text-emerald-700" />
                        <p className="text-sm leading-relaxed text-slate-600">
                            {asset.description1 || `${asset.latitude}, ${asset.longitude}`}
                        </p>
                    </div>
                    {asset.description2 ? (
                        <p className="rounded-lg bg-slate-50 p-3 text-sm leading-relaxed text-slate-600">
                            {asset.description2}
                        </p>
                    ) : null}
                    <div className="flex items-center gap-2.5">
                        <Phone className="h-4 w-4 shrink-0 text-emerald-700" />
                        <p className="text-sm font-extrabold text-slate-900">{asset.contact || "ติดต่อเจ้าหน้าที่"}</p>
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
                        className="inline-flex min-h-10 items-center justify-center gap-2 rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm font-bold text-emerald-700 transition hover:bg-emerald-50 active:translate-y-px"
                    >
                        แก้ไข
                        <ExternalLink className="h-4 w-4" />
                    </a>
                </div>
            </div>
        </div>
    );
}

export function AssetSalesMap({ assets }: AssetSalesMapProps) {
    const mapRef = useRef<MapRef | null>(null);
    const [activeId, setActiveId] = useState(assets[0]?.id || "");
    const [popupId, setPopupId] = useState<string | null>(null);
    const activeAsset = assets.find((asset) => asset.id === activeId) || null;
    const popupAsset = assets.find((asset) => asset.id === popupId) || null;
    const center = useMemo(() => getMapCenter(assets), [assets]);
    const bounds = useMemo(() => getMapBounds(assets), [assets]);

    const fitOverview = useCallback(() => {
        setPopupId(null);

        if (!bounds) {
            return;
        }

        mapRef.current?.fitBounds(bounds, {
            padding: { top: 82, right: 82, bottom: 78, left: 340 },
            duration: 900,
            maxZoom: 13,
            essential: true,
        });
    }, [bounds]);

    useEffect(() => {
        const timer = window.setTimeout(fitOverview, 300);

        return () => window.clearTimeout(timer);
    }, [fitOverview]);

    function focusAsset(asset: AssetSaleLocation, showPopup = false) {
        setActiveId(asset.id);
        setPopupId(showPopup ? asset.id : null);

        mapRef.current?.flyTo({
            center: [asset.longitude, asset.latitude],
            zoom: 14,
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
        <div className="relative h-full min-h-[480px] overflow-hidden bg-slate-950 font-sans [font-family:var(--font-sans)]">
            <Map
                ref={mapRef}
                center={center}
                zoom={12}
                theme="dark"
                className="h-full w-full"
                attributionControl={{ compact: true }}
            >
                <MapControls showFullscreen />

                {assets.map((asset) => {
                    const isActive = asset.id === activeAsset?.id;

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
                                        "grid h-10 w-10 place-items-center rounded-full bg-white text-emerald-700 transition duration-300",
                                        isActive
                                            ? "scale-110 shadow-[0_0_0_10px_rgba(16,185,129,0.24),0_14px_30px_rgba(0,0,0,0.36)]"
                                            : "shadow-[0_8px_18px_rgba(0,0,0,0.3)] hover:scale-105",
                                    ].join(" ")}
                                >
                                    <Signpost className="h-5 w-5" />
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

                <aside className="absolute left-4 top-4 z-20 flex max-h-[calc(100%-2rem)] w-[min(290px,calc(100vw-2rem))] flex-col overflow-hidden rounded-2xl bg-white font-sans shadow-[0_22px_55px_rgba(2,6,23,0.30)] [font-family:var(--font-sans)]">
                    <div className="flex items-center gap-3 bg-emerald-800 px-4 py-4 text-white">
                        <MapPin className="h-5 w-5" />
                        <p className="text-base font-extrabold">รายการขายทรัพย์สิน</p>
                    </div>
                    <div className="min-h-0 overflow-y-auto p-2">
                        <button
                            type="button"
                            onClick={fitOverview}
                            className="mb-2 flex w-full items-center gap-3 rounded-lg border border-emerald-200 bg-emerald-50/70 px-3.5 py-3 text-left text-[13px] font-bold text-emerald-800 transition hover:bg-emerald-100 active:translate-y-px"
                        >
                            <span className="grid h-5 w-5 shrink-0 place-items-center rounded-full bg-emerald-700 text-white">
                                <MapPin className="h-3.5 w-3.5" />
                            </span>
                            <span className="min-w-0 flex-1">ภาพรวม</span>
                            <ChevronRight className="h-4 w-4 shrink-0 text-emerald-500" />
                        </button>

                        <div className="space-y-1">
                            {assets.map((asset) => {
                                const isActive = asset.id === activeAsset?.id;

                                return (
                                    <button
                                        key={asset.id}
                                        type="button"
                                        onClick={() => focusAsset(asset, true)}
                                        className={[
                                            "flex w-full items-center gap-3 rounded-lg border-l-4 border-transparent px-3.5 py-3 text-left text-[13px] font-semibold transition",
                                            isActive
                                                ? "border-l-4 border-emerald-600 bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200"
                                                : "text-slate-500 hover:bg-slate-50 hover:text-emerald-800",
                                        ].join(" ")}
                                    >
                                        <span
                                            className={[
                                                "h-2.5 w-2.5 shrink-0 rounded-full",
                                                isActive ? "bg-emerald-600" : "bg-slate-300",
                                            ].join(" ")}
                                        />
                                        <span className="min-w-0 flex-1">
                                            <span className="block truncate">{asset.title}</span>
                                            <span className="mt-0.5 block text-[11px] font-bold text-slate-400">{asset.category}</span>
                                        </span>
                                        {isActive && <ChevronRight className="h-4 w-4 shrink-0 text-emerald-500" />}
                                    </button>
                                );
                            })}
                        </div>
                    </div>
                </aside>

                <div className="pointer-events-none absolute bottom-4 left-4 z-30 rounded-full bg-black/55 px-3 py-1.5 text-xs font-semibold text-white/80 md:left-[330px]">
                    พิกัดจากข้อมูลขายทรัพย์สินในระบบ
                </div>
            </Map>
        </div>
    );
}
