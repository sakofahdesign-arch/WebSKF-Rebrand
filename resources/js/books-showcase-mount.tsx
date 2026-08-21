import React from "react";
import { createRoot } from "react-dom/client";
import { BooksShowcase, type BookCfg } from "../../components/ui/books-showcase";

type BooksShowcaseDataset = BookCfg & {
    href?: string;
};

function parseBooks(mount: HTMLElement): BooksShowcaseDataset[] {
    try {
        return JSON.parse(mount.dataset.books || "[]") as BooksShowcaseDataset[];
    } catch (error) {
        console.error("Invalid books showcase data", error);
        return [];
    }
}

document.querySelectorAll<HTMLElement>("[data-books-showcase]").forEach((mount) => {
    const books = parseBooks(mount);

    createRoot(mount).render(
        <React.StrictMode>
            <BooksShowcase
                books={books}
                heroTitle={mount.dataset.heroTitle || "E-Book"}
                navTitle={mount.dataset.navTitle || "วารสารออนไลน์"}
                showNav
                showCarousel
                showDetailPanel
                className="h-full min-h-0 rounded-xl"
                themeColors={{
                    navy: "#043c32",
                    pink: "#00a85a",
                    cream: "#ffffff",
                    lav: "#dbe7e1",
                    peri: "#9bd8bd",
                    bgLight: "#ffffff",
                    bgDark: "#043c32",
                    foregroundLight: "#043c32",
                    foregroundDark: "#ffffff",
                }}
            />
        </React.StrictMode>,
    );
});
