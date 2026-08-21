import React from "react";
import { createRoot } from "react-dom/client";
import { NotchNavbar, type NotchNavItem } from "../../components/ui/notch-navbar";

document.querySelectorAll<HTMLElement>("[data-notch-navbar]").forEach((mount) => {
    const leftItems = JSON.parse(mount.dataset.leftItems || "[]") as NotchNavItem[];
    const rightItems = JSON.parse(mount.dataset.rightItems || "[]") as NotchNavItem[];
    const logoSrc = mount.dataset.logoSrc || "";
    const logoAlt = mount.dataset.logoAlt || "SAKOFAH";

    createRoot(mount).render(
        <React.StrictMode>
            <NotchNavbar
                logoSrc={logoSrc}
                logoAlt={logoAlt}
                leftItems={leftItems}
                rightItems={rightItems}
            />
        </React.StrictMode>,
    );
});
