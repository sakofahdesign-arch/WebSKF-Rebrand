import React from "react";

export interface JournalShelfItem {
    id: string;
    title: string;
    subtitle?: string;
    year?: string | number;
    href: string;
    downloadUrl?: string;
    cover: string;
    themeColor: string;
    foilColor: string;
}

export function JournalCompleteShelf({ journals }: { journals: JournalShelfItem[] }) {
    return (
        <div className="rounded-xl border border-emerald-900/10 bg-white p-6 text-center font-sans">
            <p className="text-lg font-semibold text-emerald-950">วารสารออนไลน์</p>
            <p className="mt-2 text-sm text-slate-600">
                {journals.length > 0 ? `มีวารสาร ${journals.length} ฉบับ` : "ยังไม่มีวารสารออนไลน์"}
            </p>
        </div>
    );
}
