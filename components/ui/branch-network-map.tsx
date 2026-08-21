import { type ReactNode, useCallback, useEffect, useMemo, useRef, useState } from "react";
import { ChevronRight, ExternalLink, MapPin, MapPinned, Navigation, Phone } from "lucide-react";
import {
    Map,
    MapControls,
    MapMarker,
    MapPopup,
    MarkerContent,
    type MapRef,
} from "@/components/ui/map";

export type BranchLocation = {
    id: string;
    name: string;
    address: string;
    phone: string;
    mapLink: string;
    image: string;
    markerLogo: string;
    markerKind: "branch" | "fuel" | "business";
    group: "branch" | "business";
    latitude: number;
    longitude: number;
};

type BranchNetworkMapProps = {
    branches: BranchLocation[];
    variant?: "section" | "fullscreen";
};

function getMapCenter(branches: BranchLocation[]): [number, number] {
    if (!branches.length) {
        return [99.08, 8.02];
    }

    const totals = branches.reduce(
        (sum, branch) => ({
            latitude: sum.latitude + branch.latitude,
            longitude: sum.longitude + branch.longitude,
        }),
        { latitude: 0, longitude: 0 },
    );

    return [totals.longitude / branches.length, totals.latitude / branches.length];
}

function getMapBounds(branches: BranchLocation[]): [[number, number], [number, number]] | null {
    if (!branches.length) {
        return null;
    }

    const longitudes = branches.map((branch) => branch.longitude);
    const latitudes = branches.map((branch) => branch.latitude);

    return [
        [Math.min(...longitudes), Math.min(...latitudes)],
        [Math.max(...longitudes), Math.max(...latitudes)],
    ];
}

function BranchPopupCard({ branch }: { branch: BranchLocation }) {
    return (
        <div className="w-[min(78vw,304px)] overflow-hidden rounded-lg bg-white text-slate-950 shadow-2xl shadow-slate-950/25 ring-1 ring-emerald-900/10 font-sans [font-family:var(--font-sans)]">
            <img
                src={branch.image}
                alt={branch.name}
                className="h-auto max-h-[260px] w-full object-contain bg-slate-100"
                loading="lazy"
            />
            <div className="p-4">
                <p className="text-lg font-extrabold leading-tight text-emerald-800">{branch.name}</p>
                <div className="mt-3 space-y-3">
                    <div className="flex gap-2.5">
                        <MapPin className="mt-0.5 h-4 w-4 shrink-0 text-emerald-700" />
                        <p className="text-sm leading-relaxed text-slate-600">{branch.address}</p>
                    </div>
                    <div className="flex items-center gap-2.5">
                        <Phone className="h-4 w-4 shrink-0 text-emerald-700" />
                        <p className="text-sm font-extrabold text-slate-900">{branch.phone}</p>
                    </div>
                </div>
                <a
                    href={branch.mapLink}
                    target="_blank"
                    rel="noreferrer"
                    className="mt-4 inline-flex min-h-10 w-full items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-bold text-white shadow-[0_12px_26px_rgba(16,185,129,0.25)] transition hover:bg-emerald-700 active:translate-y-px"
                >
                    <Navigation className="h-4 w-4" />
                    นำทาง
                    <ExternalLink className="h-4 w-4" />
                </a>
            </div>
        </div>
    );
}

export function BranchNetworkMap({ branches, variant = "section" }: BranchNetworkMapProps) {
    const mapRef = useRef<MapRef | null>(null);
    const [activeId, setActiveId] = useState(branches[0]?.id || "");
    const [popupBranchId, setPopupBranchId] = useState<string | null>(null);
    const activeBranch = branches.find((branch) => branch.id === activeId) || null;
    const popupBranch = branches.find((branch) => branch.id === popupBranchId);
    const branchLocations = useMemo(() => branches.filter((branch) => branch.group === "branch"), [branches]);
    const businessLocations = useMemo(() => branches.filter((branch) => branch.group === "business"), [branches]);
    const center = useMemo(() => getMapCenter(branches), [branches]);
    const bounds = useMemo(() => getMapBounds(branches), [branches]);

    const fitBoundsForOverview = useCallback(() => {
        setPopupBranchId(null);

        if (!bounds) {
            return;
        }

        mapRef.current?.fitBounds(bounds, {
            padding: { top: 74, right: 78, bottom: 76, left: 360 },
            duration: 900,
            maxZoom: 8.6,
            essential: true,
        });
    }, [bounds]);

    useEffect(() => {
        const timer = window.setTimeout(fitBoundsForOverview, 300);

        return () => window.clearTimeout(timer);
    }, [fitBoundsForOverview]);

    function focusBranch(branch: BranchLocation, showPopup = false) {
        setActiveId(branch.id);
        if (showPopup) {
            setPopupBranchId(branch.id);
        }

        mapRef.current?.flyTo({
            center: [branch.longitude, branch.latitude],
            zoom: 11.5,
            duration: 900,
            essential: true,
        });
    }

    if (!branches.length) {
        return (
            <div className="grid min-h-[420px] place-items-center rounded-xl bg-slate-50 text-sm font-semibold text-slate-500">
                ยังไม่มีข้อมูลสาขา
            </div>
        );
    }

    const isFullscreen = variant === "fullscreen";
    const sidebarPositionClass = isFullscreen ? "top-24 md:top-24" : "top-4 md:top-5";
    const sidebarHeightClass = isFullscreen
        ? "max-h-[min(560px,calc(100dvh-8rem))]"
        : "max-h-[min(430px,calc(100%-2rem))] md:max-h-[min(460px,calc(100%-2.5rem))]";
    const markerImageClass = (branch: BranchLocation) => {
        if (branch.markerKind === "fuel") {
            return "h-7 w-7 object-contain";
        }

        if (branch.group === "business") {
            return "h-7 w-7 object-contain";
        }

        return "h-8 w-8 object-contain";
    };

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
                zoom={8}
                theme="dark"
                className="h-full w-full"
                attributionControl={{ compact: true }}
            >
                <MapControls showFullscreen />
                {branches.map((branch) => {
                    const isActive = branch.id === activeBranch?.id;

                    return (
                        <MapMarker
                            key={branch.id}
                            longitude={branch.longitude}
                            latitude={branch.latitude}
                            onClick={() => focusBranch(branch, true)}
                        >
                            <MarkerContent>
                                <button
                                    type="button"
                                    onClick={(event) => {
                                        event.stopPropagation();
                                        focusBranch(branch, true);
                                    }}
                                    className={[
                                        "grid h-11 w-11 place-items-center rounded-full bg-white p-1 transition duration-300",
                                        isActive
                                            ? "scale-110 shadow-[0_0_0_11px_rgba(16,185,129,0.24),0_14px_30px_rgba(0,0,0,0.36)]"
                                            : "shadow-[0_8px_18px_rgba(0,0,0,0.3)] hover:scale-105",
                                    ].join(" ")}
                                >
                                    <img
                                        src={branch.markerLogo}
                                        alt={`${branch.name} marker`}
                                        className={markerImageClass(branch)}
                                        loading="lazy"
                                    />
                                </button>
                            </MarkerContent>
                        </MapMarker>
                    );
                })}

                {popupBranch && (
                    <MapPopup
                        longitude={popupBranch.longitude}
                        latitude={popupBranch.latitude}
                        offset={[0, -28]}
                        className="!max-w-none !rounded-none !border-0 !bg-transparent !p-0 !text-inherit !shadow-none"
                        closeButton
                        onClose={() => setPopupBranchId(null)}
                    >
                        <BranchPopupCard branch={popupBranch} />
                    </MapPopup>
                )}

                <aside
                    className={[
                        "absolute left-4 z-20 flex w-[min(280px,calc(100vw-2rem))] flex-col overflow-hidden rounded-2xl bg-white font-sans shadow-[0_22px_55px_rgba(2,6,23,0.30)] [font-family:var(--font-sans)] md:left-5",
                        sidebarPositionClass,
                        sidebarHeightClass,
                    ].join(" ")}
                >
                    <div className="flex items-center gap-3 bg-emerald-800 px-4 py-4 text-white">
                        <MapPinned className="h-5 w-5" />
                        <p className="text-base font-extrabold">เลือกสาขาที่ต้องการ</p>
                    </div>
                    <div className="min-h-0 overflow-y-auto p-2 [font-family:var(--font-sans)]">
                        <button
                            type="button"
                            onClick={() => fitBoundsForOverview(false)}
                            className="mb-2 flex w-full items-center gap-3 rounded-lg border border-emerald-200 bg-emerald-50/70 px-3.5 py-3 text-left text-[13px] font-bold text-emerald-800 transition hover:bg-emerald-100 active:translate-y-px"
                        >
                            <span className="grid h-5 w-5 shrink-0 place-items-center rounded-full bg-emerald-700 text-white">
                                <MapPin className="h-3.5 w-3.5" />
                            </span>
                            <span className="min-w-0 flex-1">ภาพรวม</span>
                            <ChevronRight className="h-4 w-4 shrink-0 text-emerald-500" />
                        </button>

                        <SidebarGroup title="สาขา">
                            {branchLocations.map((branch) => {
                                const isActive = branch.id === activeBranch?.id;

                                return <SidebarBranchButton key={branch.id} branch={branch} isActive={isActive} onClick={() => focusBranch(branch, true)} />;
                            })}
                        </SidebarGroup>

                        <SidebarGroup title="หน่วยธุรกิจ">
                            {businessLocations.map((branch) => {
                                const isActive = branch.id === activeBranch?.id;

                                return <SidebarBranchButton key={branch.id} branch={branch} isActive={isActive} onClick={() => focusBranch(branch, true)} />;
                            })}
                        </SidebarGroup>
                    </div>
                </aside>

                <div className="pointer-events-none absolute bottom-4 left-4 z-30 rounded-full bg-black/55 px-3 py-1.5 text-xs font-semibold text-white/80 md:left-[326px]">
                    พิกัดจากข้อมูลสาขาในระบบ
                </div>
            </Map>
        </div>
    );
}

function SidebarGroup({ title, children }: { title: string; children: ReactNode }) {
    return (
        <div className="mt-3 first:mt-0">
            <p className="px-3.5 pb-1.5 text-[11px] font-extrabold text-slate-400">{title}</p>
            <div className="space-y-1">{children}</div>
        </div>
    );
}

function SidebarBranchButton({
    branch,
    isActive,
    onClick,
}: {
    branch: BranchLocation;
    isActive: boolean;
    onClick: () => void;
}) {
    return (
        <button
            type="button"
            onClick={onClick}
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
            <span className="min-w-0 flex-1">{branch.name}</span>
            {isActive && <ChevronRight className="h-4 w-4 shrink-0 text-emerald-500" />}
        </button>
    );
}
