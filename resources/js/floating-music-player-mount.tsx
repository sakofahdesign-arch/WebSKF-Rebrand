import React from "react";
import { createRoot } from "react-dom/client";
import { FloatingMusicPlayer } from "../../components/ui/floating-music-player";

document.querySelectorAll<HTMLElement>("[data-floating-music-player]").forEach((mount) => {
    const src = mount.dataset.audioSrc || "/audio/anasheed-sakofah.m4a";
    const title = mount.dataset.title || "Anasheed Sakofah";
    const artist = mount.dataset.artist || "SAKOFAH";
    const artwork = mount.dataset.artwork || "";
    const autoPlay = mount.dataset.autoplay !== "false";

    createRoot(mount).render(
        <React.StrictMode>
            <FloatingMusicPlayer
                src={src}
                title={title}
                artist={artist}
                artwork={artwork}
                autoPlay={autoPlay}
            />
        </React.StrictMode>,
    );
});
