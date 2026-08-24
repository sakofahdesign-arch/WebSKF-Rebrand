import React from "react";
import { createRoot } from "react-dom/client";
import { AssetSalesMap, type AssetSaleLocation } from "../../components/ui/asset-sales-map";

document.querySelectorAll<HTMLElement>("[data-asset-sales-map]").forEach((mount) => {
    const assets = JSON.parse(mount.dataset.assets ?? "[]") as AssetSaleLocation[];
    const variant = mount.dataset.mapVariant === "fullscreen" ? "fullscreen" : "section";

    createRoot(mount).render(
        <React.StrictMode>
            <AssetSalesMap assets={assets} variant={variant} />
        </React.StrictMode>,
    );
});
