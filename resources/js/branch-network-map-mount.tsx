import React from "react";
import { createRoot } from "react-dom/client";
import { BranchNetworkMap, type BranchLocation } from "../../components/ui/branch-network-map";

function parseBranches(mount: HTMLElement): BranchLocation[] {
    try {
        return JSON.parse(mount.dataset.branches || "[]") as BranchLocation[];
    } catch (error) {
        console.error("Invalid branch network data", error);
        return [];
    }
}

document.querySelectorAll<HTMLElement>("[data-branch-network-map]").forEach((mount) => {
    createRoot(mount).render(
        <React.StrictMode>
            <BranchNetworkMap
                branches={parseBranches(mount)}
                variant={mount.dataset.mapVariant === "fullscreen" ? "fullscreen" : "section"}
            />
        </React.StrictMode>,
    );
});
