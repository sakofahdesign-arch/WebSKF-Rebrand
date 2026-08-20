import React from "react";
import { createRoot } from "react-dom/client";
import { JournalCompleteShelf, type JournalShelfItem } from "../../components/ui/journal-complete-shelf";

document.querySelectorAll<HTMLElement>("[data-journal-complete-shelf]").forEach((mount) => {
    if (mount.dataset.journalShelfMounted === "true") {
        return;
    }

    mount.dataset.journalShelfMounted = "true";

    let journals: JournalShelfItem[] = [];

    try {
        journals = JSON.parse(mount.dataset.journals ?? "[]") as JournalShelfItem[];
    } catch (error) {
        console.error("Unable to parse journal shelf data", error);
    }

    createRoot(mount).render(<JournalCompleteShelf journals={journals} />);
});
