import React from "react";
import { createRoot } from "react-dom/client";
import { AssetSalesMap, type AssetSaleLocation } from "../../components/ui/asset-sales-map";

document.querySelectorAll<HTMLElement>("[data-asset-sales-map]").forEach((mount) => {
    const assets = JSON.parse(mount.dataset.assets ?? "[]") as AssetSaleLocation[];

    createRoot(mount).render(
        <React.StrictMode>
            <AssetSalesMap assets={assets} />
        </React.StrictMode>,
    );
});
