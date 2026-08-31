import { useMemo, useState, type CSSProperties, type HTMLAttributes, type ReactNode } from "react";
import { AnimatePresence, motion } from "framer-motion";
import {
    Building2,
    CalendarDays,
    ChevronDown,
    Download,
    Flame,
    Handshake,
    HeartHandshake,
    Home,
    Landmark,
    Menu,
    Newspaper,
    Phone,
    UserRound,
    X,
    type LucideIcon,
} from "lucide-react";
import { cn } from "@/lib/utils";
import { GooeySearch } from "@/components/ui/gooey-search";

const icons = {
    building: Building2,
    calendar: CalendarDays,
    download: Download,
    flame: Flame,
    handshake: Handshake,
    heart: HeartHandshake,
    home: Home,
    landmark: Landmark,
    newspaper: Newspaper,
    phone: Phone,
    user: UserRound,
} satisfies Record<string, LucideIcon>;

export type NotchNavIcon = keyof typeof icons;

export interface NotchNavChild {
    label: string;
    href: string;
    external?: boolean;
}

export interface NotchNavItem {
    label: string;
    href: string;
    icon?: NotchNavIcon;
    highlight?: boolean;
    children?: NotchNavChild[];
}

export interface NotchNavbarProps extends HTMLAttributes<HTMLElement> {
    logoSrc: string;
    logoAlt?: string;
    leftItems: NotchNavItem[];
    rightItems: NotchNavItem[];
}

function Anchor({
    href,
    external,
    className,
    children,
    onClick,
}: {
    href: string;
    external?: boolean;
    className?: string;
    children: ReactNode;
    onClick?: () => void;
}) {
    return (
        <a
            href={href}
            className={className}
            target={external ? "_blank" : undefined}
            rel={external ? "noreferrer" : undefined}
            onClick={onClick}
        >
            {children}
        </a>
    );
}

function NavTrigger({
    item,
    icon: Icon,
}: {
    item: NotchNavItem;
    icon?: LucideIcon;
}) {
    return (
        <button
            type="button"
            aria-haspopup="menu"
            className={cn(
                "flex items-center gap-1.5 rounded-md px-2 py-1.5 text-[13px] font-semibold text-white/76 transition duration-200 hover:bg-white/8 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/70",
                item.highlight && "text-amber-300 hover:text-amber-200",
            )}
        >
            {Icon && <Icon className="h-3.5 w-3.5 opacity-75" strokeWidth={1.9} />}
            <span className="whitespace-nowrap">{item.label}</span>
            <ChevronDown className="h-3.5 w-3.5 opacity-65 transition duration-200 group-hover:rotate-180" />
        </button>
    );
}

function NavLink({ item }: { item: NotchNavItem }) {
    const Icon = item.icon ? icons[item.icon] : undefined;
    const hasChildren = Boolean(item.children?.length);

    return (
        <div className="group relative flex h-8 items-center">
            {hasChildren ? (
                <NavTrigger item={item} icon={Icon} />
            ) : (
                <Anchor
                    href={item.href}
                    external={item.children?.[0]?.external && item.href === item.children[0].href}
                    className={cn(
                        "flex items-center gap-1.5 rounded-md px-2 py-1.5 text-[13px] font-semibold text-white/76 transition duration-200 hover:bg-white/8 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/70",
                        item.highlight && "text-amber-300 hover:text-amber-200",
                    )}
                >
                    {Icon && <Icon className="h-3.5 w-3.5 opacity-75" strokeWidth={1.9} />}
                    <span className="whitespace-nowrap">{item.label}</span>
                </Anchor>
            )}

            {hasChildren && (
                <div
                    role="menu"
                    className="pointer-events-none absolute left-1/2 top-full z-50 min-w-56 -translate-x-1/2 translate-y-2 rounded-lg border border-emerald-950/10 bg-white p-2 text-emerald-950 opacity-0 shadow-2xl shadow-emerald-950/16 ring-1 ring-black/5 transition duration-200 group-hover:pointer-events-auto group-hover:translate-y-0 group-hover:opacity-100 dark:border-white/10 dark:bg-emerald-950 dark:text-white"
                >
                    {item.children?.map((child) => (
                        <Anchor
                            key={`${item.label}-${child.label}`}
                            href={child.href}
                            external={child.external}
                            className="block rounded-md px-3 py-2 text-sm font-medium text-emerald-950/78 transition hover:bg-emerald-50 hover:text-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-700 dark:text-white/82 dark:hover:bg-white dark:hover:text-emerald-950 dark:focus-visible:outline-white"
                        >
                            <span role="menuitem">{child.label}</span>
                        </Anchor>
                    ))}
                </div>
            )}
        </div>
    );
}

function MobileTrigger({ item, icon: Icon }: { item: NotchNavItem; icon?: LucideIcon }) {
    return (
        <button
            type="button"
            className={cn(
                "flex w-full items-center gap-3 px-4 py-3 text-left text-sm font-semibold text-emerald-950 transition-colors dark:text-emerald-50",
                item.highlight && "text-amber-700 dark:text-amber-200",
            )}
        >
            {Icon && <Icon className="h-[18px] w-[18px] text-emerald-800 dark:text-emerald-200" strokeWidth={1.9} />}
            <span className="min-w-0 flex-1">{item.label}</span>
            <ChevronDown className="h-4 w-4 text-emerald-800/60 dark:text-emerald-100/70" />
        </button>
    );
}

function MobileItem({ item, onNavigate }: { item: NotchNavItem; onNavigate: () => void }) {
    const Icon = item.icon ? icons[item.icon] : undefined;
    const hasChildren = Boolean(item.children?.length);

    return (
        <div className="rounded-lg border border-emerald-900/10 bg-white shadow-[0_10px_30px_rgba(4,60,50,0.06)] dark:border-emerald-300/16 dark:bg-[#08231d]/96 dark:shadow-none dark:ring-1 dark:ring-white/5">
            {hasChildren ? (
                <MobileTrigger item={item} icon={Icon} />
            ) : (
                <Anchor
                    href={item.href}
                    className={cn(
                        "flex items-center gap-3 px-4 py-3 text-sm font-semibold text-emerald-950 transition-colors hover:bg-emerald-50 dark:text-emerald-50 dark:hover:bg-white/8",
                        item.highlight && "text-amber-700 dark:text-amber-200",
                    )}
                    onClick={onNavigate}
                >
                    {Icon && <Icon className="h-[18px] w-[18px] text-emerald-800 dark:text-emerald-200" strokeWidth={1.9} />}
                    <span>{item.label}</span>
                </Anchor>
            )}
            {item.children?.length ? (
                <div className="border-t border-emerald-900/8 bg-emerald-50/35 px-4 py-2 dark:border-emerald-300/12 dark:bg-[#061a15]/72">
                    {item.children.map((child) => (
                        <Anchor
                            key={`${item.label}-${child.label}`}
                            href={child.href}
                            external={child.external}
                            className="block rounded-md py-2 pl-7 text-sm font-medium text-emerald-950/72 transition-colors hover:bg-white/70 hover:text-emerald-950 dark:text-emerald-50/74 dark:hover:bg-white/8 dark:hover:text-white"
                            onClick={onNavigate}
                        >
                            {child.label}
                        </Anchor>
                    ))}
                </div>
            ) : null}
        </div>
    );
}

export function NotchNavbar({
    className,
    logoSrc,
    logoAlt = "SAKOFAH",
    leftItems,
    rightItems,
    ...props
}: NotchNavbarProps) {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const allItems = [...leftItems, ...rightItems];
    const searchEntries = useMemo(() => {
        const entries: { label: string; href: string; external?: boolean }[] = [];

        allItems.forEach((item) => {
            entries.push({ label: item.label, href: item.href });
            item.children?.forEach((child) => entries.push(child));
        });

        return entries.filter(
            (entry, index, list) => list.findIndex((candidate) => candidate.label === entry.label) === index,
        );
    }, [allItems]);

    const searchTheme = {
        "--foreground": "rgb(255 255 255)",
        "--background": "rgb(6 78 59)",
    } as CSSProperties;

    function handleSearchSelect(label: string) {
        const entry = searchEntries.find((item) => item.label === label);
        if (!entry) return;

        if (entry.external) {
            window.open(entry.href, "_blank", "noreferrer");
            return;
        }

        window.location.href = entry.href;
    }

    return (
        <>
            <header className={cn("fixed inset-x-0 top-0 z-50 flex h-16 px-0", className)} {...props}>
                <div className="relative z-20 h-10 min-w-0 flex-1 bg-emerald-950 shadow-[0_12px_30px_rgb(6_78_59_/_0.16)]">
                    <div className="absolute inset-x-0 bottom-0 h-px bg-white/8" />
                </div>

                <div className="relative z-30 -ml-px flex h-16 w-[min(1380px,calc(100vw-3rem))] shrink-0">
                    <div className="relative h-full w-[48px] shrink-0">
                        <div
                            className="absolute inset-0 bg-emerald-950"
                            style={{ clipPath: "path('M0 0 H48 V64 C24 64 24 40 0 40 Z')" }}
                        />
                        <svg className="pointer-events-none absolute inset-0 h-full w-full" viewBox="0 0 48 64">
                            <path
                                d="M0 39.5 C24 39.5 24 63.5 48 63.5"
                                fill="none"
                                stroke="currentColor"
                                strokeOpacity={0.16}
                                strokeWidth={0.5}
                                className="text-white"
                            />
                        </svg>
                    </div>

                    <div className="relative z-20 -ml-px h-full min-w-0 flex-1 bg-emerald-950">
                        <div className="pointer-events-none absolute inset-x-0 bottom-0 h-px bg-white/12" />

                        <div className="relative grid h-full grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] items-end gap-4 px-3 pb-2.5 lg:px-4">
                            <nav className="hidden min-w-0 items-center justify-end gap-1 xl:flex">
                                {leftItems.map((item) => (
                                    <NavLink key={item.label} item={item} />
                                ))}
                            </nav>

                            <button
                                type="button"
                                className="mb-1 grid h-9 w-9 place-items-center rounded-md text-white/82 transition hover:bg-white/8 hover:text-white xl:hidden"
                                onClick={() => setIsMobileMenuOpen((open) => !open)}
                                aria-expanded={isMobileMenuOpen}
                                aria-label="Toggle navigation"
                            >
                                {isMobileMenuOpen ? <X className="h-5 w-5" /> : <Menu className="h-5 w-5" />}
                            </button>

                            <a
                                href="/"
                                className="mb-0.5 grid h-10 w-10 shrink-0 place-items-center overflow-hidden rounded-full bg-white shadow-lg shadow-emerald-950/20 ring-1 ring-white/60 transition hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                                aria-label={logoAlt}
                            >
                                <img src={logoSrc} alt={logoAlt} className="h-full w-full rounded-full object-cover" />
                            </a>

                            <nav className="hidden min-w-0 items-center justify-start gap-1 xl:flex">
                                {rightItems.map((item) => (
                                    <NavLink key={item.label} item={item} />
                                ))}
                                <div className="-ml-2 flex h-8 items-center pr-12" style={searchTheme}>
                                    <GooeySearch
                                        items={searchEntries.map((entry) => entry.label)}
                                        buttonLabel="ค้นหา"
                                        placeholder="ค้นหาเมนู..."
                                        maxResults={4}
                                        debounceMs={220}
                                        onSelect={handleSearchSelect}
                                    />
                                </div>
                            </nav>

                            <div className="h-9 w-9 xl:hidden" aria-hidden="true" />
                        </div>
                    </div>

                    <div className="relative z-10 -ml-px h-full w-[48px] shrink-0">
                        <div
                            className="absolute inset-0 bg-emerald-950"
                            style={{ clipPath: "path('M0 0 H48 V40 C24 40 24 64 0 64 Z')" }}
                        />
                        <svg className="pointer-events-none absolute inset-0 h-full w-full" viewBox="0 0 48 64">
                            <path
                                d="M0 63.5 C24 63.5 24 39.5 48 39.5"
                                fill="none"
                                stroke="currentColor"
                                strokeOpacity={0.16}
                                strokeWidth={0.5}
                                className="text-white"
                            />
                        </svg>
                    </div>
                </div>

                <div className="relative z-20 -ml-px h-10 min-w-0 flex-1 bg-emerald-950 shadow-[0_12px_30px_rgb(6_78_59_/_0.16)]">
                    <div className="absolute inset-x-0 bottom-0 h-px bg-white/8" />
                </div>
            </header>

            <AnimatePresence>
                {isMobileMenuOpen && (
                    <motion.div
                        initial={{ opacity: 0, y: -12 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: -12 }}
                        transition={{ duration: 0.18 }}
                        className="fixed inset-x-3 top-[5.5rem] z-40 max-h-[calc(100dvh-6.5rem)] overflow-auto rounded-xl border border-emerald-950/10 bg-emerald-50/96 p-3 shadow-2xl shadow-emerald-950/18 backdrop-blur xl:hidden dark:border-emerald-200/18 dark:bg-[#dff7ec]/92 dark:shadow-black/32"
                    >
                        <nav className="grid gap-2">
                            {allItems.map((item) => (
                                <MobileItem
                                    key={`mobile-${item.label}`}
                                    item={item}
                                    onNavigate={() => setIsMobileMenuOpen(false)}
                                />
                            ))}
                        </nav>
                    </motion.div>
                )}
            </AnimatePresence>
        </>
    );
}
