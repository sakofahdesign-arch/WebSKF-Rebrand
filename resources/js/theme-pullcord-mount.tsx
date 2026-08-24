import React from "react";
import { createRoot } from "react-dom/client";
import { ThemePullCord } from "../../components/ui/theme-pullcord";

const mount = document.querySelector<HTMLElement>("[data-theme-pullcord]");

if (mount) {
    createRoot(mount).render(
        <React.StrictMode>
            <ThemePullCord />
        </React.StrictMode>,
    );
}
