import React, { useMemo, useState } from "react";

export interface JournalShelfItem {
    id: string;
    title: string;
    subtitle?: string;
    year?: string;
    href: string;
    downloadUrl?: string;
    cover: string;
    themeColor: string;
    foilColor: string;
}

type ShelfMode = "shelf" | "detail" | "reader";

interface JournalCompleteShelfProps {
    journals: JournalShelfItem[];
}

export function JournalCompleteShelf({ journals }: JournalCompleteShelfProps) {
    const [activeIndex, setActiveIndex] = useState(0);
    const [mode, setMode] = useState<ShelfMode>("shelf");
    const [webglUnavailable, setWebglUnavailable] = useState(false);

    const selectedJournal = journals[activeIndex] ?? journals[0];
    const readerUrl = selectedJournal?.downloadUrl ?? selectedJournal?.href ?? "#";

    const themeStyle = useMemo(
        () =>
            ({
                "--journal-theme": selectedJournal ? selectedJournal.themeColor : "#022c22",
                "--journal-foil": selectedJournal ? selectedJournal.foilColor : "#facc15",
            }) as React.CSSProperties,
        [selectedJournal],
    );

    if (!journals.length) {
        return (
            <div className="grid h-full place-items-center bg-white text-sm font-bold text-slate-500">
                ยังไม่มีวารสารออนไลน์
            </div>
        );
    }

    const goToIndex = (nextIndex: number) => {
        const normalized = (nextIndex + journals.length) % journals.length;
        setActiveIndex(normalized);
        setMode("shelf");
    };

    return (
        <div
            className="relative h-full min-h-[680px] overflow-hidden bg-[var(--journal-theme)] text-white transition-colors duration-700"
            style={themeStyle}
        >
            <div className="absolute inset-0 bg-[radial-gradient(circle_at_50%_20%,rgba(255,255,255,0.24),transparent_42%)]" />

            {webglUnavailable ? (
                <FallbackShelf
                    journals={journals}
                    onRead={(index) => {
                        setActiveIndex(index);
                        setMode("reader");
                    }}
                />
            ) : (
                <div data-journal-three-stage className="absolute inset-0" />
            )}

            <div className="absolute inset-x-6 bottom-6 z-20 grid gap-4 md:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] md:items-end">
                <div aria-live="polite">
                    <p className="text-xs font-bold uppercase tracking-[0.24em] text-white/65">
                        {String(activeIndex + 1).padStart(2, "0")} / {String(journals.length).padStart(2, "0")}
                    </p>
                    <h3 className="mt-2 max-w-xl text-4xl font-black leading-none md:text-6xl">
                        {selectedJournal.title}
                    </h3>
                    <p className="mt-3 max-w-xl text-sm font-semibold text-white/72">
                        {selectedJournal.subtitle ?? selectedJournal.year}
                    </p>
                </div>

                <div className="flex items-center justify-center gap-2">
                    <button type="button" className="rounded-full border border-white/40 px-4 py-2 text-sm font-bold" onClick={() => goToIndex(activeIndex - 1)}>
                        ก่อนหน้า
                    </button>
                    <button type="button" className="rounded-full bg-white px-5 py-2 text-sm font-black text-emerald-950" onClick={() => setMode("detail")}>
                        เปิดเล่ม
                    </button>
                    <button type="button" className="rounded-full border border-white/40 px-4 py-2 text-sm font-bold" onClick={() => goToIndex(activeIndex + 1)}>
                        ถัดไป
                    </button>
                </div>

                <div className="flex justify-start gap-2 md:justify-end">
                    {journals.map((journal, index) => (
                        <button
                            key={journal.id}
                            type="button"
                            aria-label={`เลือก ${journal.title}`}
                            aria-current={index === activeIndex}
                            className="h-3 w-3 rounded-full bg-white/40 aria-current:w-8 aria-current:bg-[var(--journal-foil)]"
                            onClick={() => goToIndex(index)}
                        />
                    ))}
                </div>
            </div>

            {mode === "detail" && (
                <div className="absolute right-8 top-24 z-30 w-[min(420px,calc(100%-4rem))] rounded-xl bg-white/92 p-6 text-emerald-950 shadow-2xl">
                    <button type="button" className="absolute right-4 top-4 text-sm font-black" onClick={() => setMode("shelf")}>
                        ปิด
                    </button>
                    <p className="text-xs font-black uppercase tracking-[0.24em] text-emerald-700">{selectedJournal.year}</p>
                    <h4 className="mt-3 text-3xl font-black leading-tight">{selectedJournal.title}</h4>
                    <p className="mt-3 text-sm font-semibold text-slate-600">{selectedJournal.subtitle}</p>
                    <div className="mt-6 flex flex-wrap gap-3">
                        <button type="button" className="rounded-full bg-emerald-700 px-5 py-3 text-sm font-black text-white" onClick={() => setMode("reader")}>
                            เปิดอ่าน
                        </button>
                        <button type="button" className="rounded-full border border-emerald-900/20 px-5 py-3 text-sm font-black" onClick={() => setMode("shelf")}>
                            กลับไปชั้นวารสาร
                        </button>
                    </div>
                </div>
            )}

            {mode === "reader" && (
                <div className="absolute inset-0 z-40 bg-emerald-950/92 p-6">
                    <div className="flex h-full flex-col overflow-hidden rounded-xl bg-white">
                        <div className="flex items-center justify-between border-b border-slate-200 px-4 py-3 text-emerald-950">
                            <strong>{selectedJournal.title}</strong>
                            <div className="flex items-center gap-2">
                                <a href={readerUrl} target="_blank" rel="noreferrer" className="rounded-full bg-emerald-700 px-4 py-2 text-sm font-black text-white">
                                    เปิดในแท็บใหม่
                                </a>
                                <button type="button" className="rounded-full border border-slate-200 px-4 py-2 text-sm font-black" onClick={() => setMode("detail")}>
                                    ปิด
                                </button>
                            </div>
                        </div>
                        <iframe src={readerUrl} title={selectedJournal.title} className="min-h-0 flex-1 border-0" />
                    </div>
                </div>
            )}

            <button type="button" hidden onClick={() => setWebglUnavailable(true)}>
                WebGL ไม่พร้อมใช้งาน
            </button>
        </div>
    );
}

function FallbackShelf({
    journals,
    onRead,
}: {
    journals: JournalShelfItem[];
    onRead: (index: number) => void;
}) {
    return (
        <div className="relative z-10 grid h-full content-center gap-4 overflow-x-auto p-8">
            <p className="text-sm font-bold text-white/80">WebGL ไม่พร้อมใช้งาน</p>
            <div className="flex gap-4">
                {journals.map((journal, index) => (
                    <button
                        key={journal.id}
                        type="button"
                        className="grid h-80 w-44 shrink-0 content-end rounded-md p-4 text-left shadow-2xl"
                        style={{ backgroundColor: journal.themeColor }}
                        onClick={() => onRead(index)}
                    >
                        <span className="text-xs font-bold text-white/70">{journal.year}</span>
                        <strong className="mt-2 text-xl font-black text-white">{journal.title}</strong>
                        <span className="mt-4 rounded-full bg-white px-3 py-2 text-center text-sm font-black text-emerald-950">เปิดอ่าน</span>
                    </button>
                ))}
            </div>
        </div>
    );
}

export default JournalCompleteShelf;
