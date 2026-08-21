import React from "react";
import { createRoot } from "react-dom/client";
import { StaggeredNewsGrid, type NewsCategory } from "../../components/ui/staggered-news-grid";

document.querySelectorAll<HTMLElement>("[data-staggered-news]").forEach((mount) => {
    const categories = JSON.parse(mount.dataset.categories || "[]") as NewsCategory[];

    createRoot(mount).render(
        <React.StrictMode>
            <StaggeredNewsGrid categories={categories} />
        </React.StrictMode>,
    );
});
