import React from "react";
import { createRoot } from "react-dom/client";
import { MorphText } from "../../components/ui/morph-text";

document.querySelectorAll<HTMLElement>("[data-morph-text]").forEach((mount) => {
    const words = JSON.parse(mount.dataset.words || "[]") as string[];
    const interval = Number(mount.dataset.interval || 3000);

    createRoot(mount).render(
        <React.StrictMode>
            <MorphText
                words={words.length ? words : undefined}
                interval={interval}
                className="text-emerald-900"
                textClassName="leading-none"
            />
        </React.StrictMode>,
    );
});
