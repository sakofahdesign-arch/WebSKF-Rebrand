import React from "react";
import { createRoot } from "react-dom/client";
import {
    PromotionNewsShowcase,
    type ShowcaseItem,
} from "../../components/ui/promotion-news-showcase";

document.querySelectorAll<HTMLElement>("[data-promotion-news-showcase]").forEach((mount) => {
    const promotions = JSON.parse(mount.dataset.promotions || "[]") as ShowcaseItem[];
    const news = JSON.parse(mount.dataset.news || "[]") as ShowcaseItem[];

    createRoot(mount).render(
        <React.StrictMode>
            <PromotionNewsShowcase promotions={promotions} news={news} />
        </React.StrictMode>,
    );
});
