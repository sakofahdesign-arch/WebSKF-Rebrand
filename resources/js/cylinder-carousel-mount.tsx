import React from "react";
import { createRoot } from "react-dom/client";
import { CylinderCarousel, type CarouselImage } from "../../components/ui/cylinder-carousel";

const mounts = document.querySelectorAll<HTMLElement>("[data-cylinder-carousel]");

mounts.forEach((mount) => {
    const images: CarouselImage[] = JSON.parse(mount.dataset.images || "[]");
    const animationDuration = Number(mount.dataset.animationDuration || 32);
    const cardWidth = Number(mount.dataset.cardWidth || 250);
    const depthScale = Number(mount.dataset.depthScale || 1);
    const perspectiveDistance = mount.dataset.perspectiveDistance || "35em";
    const maskStops = mount.dataset.maskStops || "20% 80%";

    createRoot(mount).render(
        <React.StrictMode>
            <CylinderCarousel
                images={images}
                animationDuration={animationDuration}
                cardWidth={cardWidth}
                depthScale={depthScale}
                perspectiveDistance={perspectiveDistance}
                maskStops={maskStops}
                className="org-react-cylinder-frame"
                cardClassName="org-react-cylinder-card"
            />
        </React.StrictMode>
    );
});
