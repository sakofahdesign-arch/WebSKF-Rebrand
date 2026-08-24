import React, { useEffect, useState } from "react";
import { createRoot } from "react-dom/client";
import { WaveGridBackground } from "../../components/ui/wave-grid-background";

const mounts = document.querySelectorAll<HTMLElement>("[data-wave-grid-homepage-background]");

function getTheme() {
    return document.documentElement.classList.contains("dark") ? "dark" : "light";
}

function ThemedHomepageWaveGrid() {
    const [theme, setTheme] = useState(getTheme);
    const isDark = theme === "dark";

    useEffect(() => {
        const observer = new MutationObserver(() => setTheme(getTheme()));

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ["class", "data-theme"],
        });

        return () => observer.disconnect();
    }, []);

    return (
        <WaveGridBackground
            colorBase={isDark ? "#202725" : "#f0fff7"}
            colorHigh={isDark ? "#080b0a" : "#00b86b"}
            gridSize={30}
            waveAmplitude={isDark ? 0.68 : 0.44}
            waveMaxHeight={isDark ? 0.74 : 0.52}
            waveSpeed={5.8}
            waveWidth={isDark ? 5.8 : 4.6}
            waveJitter={0.2}
            vignette={false}
            className="h-full w-full"
        />
    );
}

mounts.forEach((mount) => {
    createRoot(mount).render(
        <React.StrictMode>
            <ThemedHomepageWaveGrid />
        </React.StrictMode>
    );
});
