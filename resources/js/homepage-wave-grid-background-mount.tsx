import React from "react";
import { createRoot } from "react-dom/client";
import { WaveGridBackground } from "../../components/ui/wave-grid-background";

const mounts = document.querySelectorAll<HTMLElement>("[data-wave-grid-homepage-background]");

mounts.forEach((mount) => {
    createRoot(mount).render(
        <React.StrictMode>
            <WaveGridBackground
                colorBase="#f0fff7"
                colorHigh="#00b86b"
                gridSize={30}
                waveAmplitude={0.44}
                waveMaxHeight={0.52}
                waveSpeed={5.8}
                waveWidth={4.6}
                waveJitter={0.2}
                vignette={false}
                className="h-full w-full"
            />
        </React.StrictMode>
    );
});
