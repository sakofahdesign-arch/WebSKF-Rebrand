import { useCallback, useEffect, useMemo, useRef, useState } from "react";
import { Minus, Pause, Play, SkipBack, SkipForward, Volume2, VolumeX } from "lucide-react";
import { cn } from "@/lib/utils";

export interface FloatingMusicPlayerProps {
    src: string;
    title?: string;
    artist?: string;
    artwork?: string;
    autoPlay?: boolean;
}

function formatTime(value: number) {
    if (!Number.isFinite(value) || value <= 0) return "0:00";

    const minutes = Math.floor(value / 60);
    const seconds = Math.floor(value % 60);

    return `${minutes}:${seconds.toString().padStart(2, "0")}`;
}

const equalizerBars = [0, 1, 2, 3];

export function FloatingMusicPlayer({
    src,
    title = "Anasheed Sakofah",
    artist = "SAKOFAH",
    artwork,
    autoPlay = true,
}: FloatingMusicPlayerProps) {
    const audioRef = useRef<HTMLAudioElement | null>(null);
    const [isPlaying, setIsPlaying] = useState(false);
    const [duration, setDuration] = useState(0);
    const [currentTime, setCurrentTime] = useState(0);
    const [volume, setVolume] = useState(0.82);
    const [isMuted, setIsMuted] = useState(false);
    const [isCollapsed, setIsCollapsed] = useState(false);
    const [autoPlayBlocked, setAutoPlayBlocked] = useState(false);

    useEffect(() => {
        const audio = audioRef.current;
        if (!audio) return;

        audio.volume = isMuted ? 0 : volume;
    }, [isMuted, volume]);

    useEffect(() => {
        const audio = audioRef.current;
        if (!audio) return;

        const handleLoadedMetadata = () => setDuration(audio.duration || 0);
        const handleTimeUpdate = () => setCurrentTime(audio.currentTime || 0);
        const handlePlay = () => {
            setIsPlaying(true);
            setAutoPlayBlocked(false);
        };
        const handlePause = () => setIsPlaying(false);
        const handleEnded = () => {
            audio.currentTime = 0;
            void audio.play().catch(() => setIsPlaying(false));
        };

        audio.addEventListener("loadedmetadata", handleLoadedMetadata);
        audio.addEventListener("timeupdate", handleTimeUpdate);
        audio.addEventListener("play", handlePlay);
        audio.addEventListener("pause", handlePause);
        audio.addEventListener("ended", handleEnded);

        return () => {
            audio.removeEventListener("loadedmetadata", handleLoadedMetadata);
            audio.removeEventListener("timeupdate", handleTimeUpdate);
            audio.removeEventListener("play", handlePlay);
            audio.removeEventListener("pause", handlePause);
            audio.removeEventListener("ended", handleEnded);
        };
    }, []);

    const play = useCallback(async () => {
        const audio = audioRef.current;
        if (!audio) return false;

        try {
            await audio.play();
            setAutoPlayBlocked(false);
            return true;
        } catch {
            setAutoPlayBlocked(true);
            return false;
        }
    }, []);

    const pause = useCallback(() => {
        audioRef.current?.pause();
    }, []);

    useEffect(() => {
        if (!autoPlay) return;

        void play();

        const unlockPlayback = () => {
            void play().then((played) => {
                if (!played) return;

                window.removeEventListener("pointerdown", unlockPlayback);
                window.removeEventListener("keydown", unlockPlayback);
                window.removeEventListener("touchstart", unlockPlayback);
            });
        };

        window.addEventListener("pointerdown", unlockPlayback, { passive: true });
        window.addEventListener("keydown", unlockPlayback);
        window.addEventListener("touchstart", unlockPlayback, { passive: true });

        return () => {
            window.removeEventListener("pointerdown", unlockPlayback);
            window.removeEventListener("keydown", unlockPlayback);
            window.removeEventListener("touchstart", unlockPlayback);
        };
    }, [autoPlay, play]);

    const togglePlayback = async () => {
        if (isPlaying) {
            pause();
            return;
        }

        await play();
    };

    const seekTo = (value: number) => {
        const audio = audioRef.current;
        if (!audio || !duration) return;

        audio.currentTime = (value / 100) * duration;
        setCurrentTime(audio.currentTime);
    };

    const progress = duration ? (currentTime / duration) * 100 : 0;
    const progressStyle = useMemo(
        () => ({
            background: `linear-gradient(90deg, #f97316 0%, #f97316 ${progress}%, rgba(255,255,255,.18) ${progress}%, rgba(255,255,255,.18) 100%)`,
        }),
        [progress],
    );

    return (
        <div className="fixed bottom-5 left-1/2 z-[90] w-[min(27rem,calc(100vw-2rem))] -translate-x-1/2 sm:bottom-7">
            <audio ref={audioRef} src={src} preload="auto" playsInline />

            <div
                className={cn(
                    "relative mx-auto min-h-[76px] overflow-visible rounded-[10px] border border-white/15 bg-[#4a4038]/94 text-white shadow-[0_24px_70px_rgba(0,0,0,0.34)] backdrop-blur-xl transition-[width,transform,opacity] duration-500",
                    isCollapsed ? "w-[92px]" : "w-full",
                )}
            >
                <button
                    type="button"
                    onClick={() => setIsCollapsed((value) => !value)}
                    className="absolute -right-3 -top-3 z-20 grid h-9 w-9 place-items-center rounded-full border border-white/15 bg-[#5b564f] text-white shadow-[0_12px_28px_rgba(0,0,0,0.35)] transition hover:bg-[#686057] active:scale-95"
                    aria-label={isCollapsed ? "Expand music player" : "Collapse music player"}
                >
                    <Minus className="h-4 w-4" />
                </button>

                {artwork ? (
                    <div
                        className={cn(
                            "absolute -left-3 -top-5 z-10 h-[88px] w-[88px] overflow-hidden rounded-xl bg-white p-1 shadow-[0_16px_34px_rgba(0,0,0,0.38)] transition duration-500",
                            isCollapsed && "left-1/2 -translate-x-1/2",
                        )}
                    >
                        <img src={artwork} alt="" className="h-full w-full rounded-lg object-contain" loading="lazy" />
                    </div>
                ) : null}

                <div
                    className={cn(
                        "grid min-h-[76px] grid-cols-[1fr_auto] items-center gap-4 px-4 py-3 transition-opacity duration-300",
                        artwork ? "pl-[6.2rem]" : "pl-4",
                        isCollapsed && "pointer-events-none opacity-0",
                    )}
                >
                    <div className="min-w-0">
                        <div className="flex min-w-0 items-center gap-3">
                            <div className="flex h-8 w-5 shrink-0 items-end gap-[3px] text-orange-500" aria-hidden="true">
                                {equalizerBars.map((bar) => (
                                    <span
                                        key={bar}
                                        className={cn(
                                            "block w-[3px] origin-bottom rounded-full bg-current",
                                            isPlaying ? "animate-[sakofah-eq_0.72s_ease-in-out_infinite]" : "h-2",
                                        )}
                                        style={{
                                            height: isPlaying ? `${12 + bar * 4}px` : undefined,
                                            animationDelay: `${bar * 0.12}s`,
                                        }}
                                    />
                                ))}
                            </div>
                            <div className="min-w-0">
                                <p className="truncate text-[15px] font-black uppercase leading-tight tracking-wide">
                                    {title}
                                </p>
                                <p className="truncate text-[11px] font-bold uppercase tracking-[0.18em] text-white/48">
                                    {autoPlayBlocked ? "Tap to play" : artist}
                                </p>
                            </div>
                        </div>

                        <div className="mt-3 flex items-center gap-2">
                            <span className="w-8 text-[10px] font-bold tabular-nums text-white/52">{formatTime(currentTime)}</span>
                            <input
                                type="range"
                                min={0}
                                max={100}
                                value={progress}
                                onChange={(event) => seekTo(Number(event.target.value))}
                                className="h-1 flex-1 cursor-pointer appearance-none rounded-full bg-white/18 accent-orange-500 [&::-webkit-slider-thumb]:h-3 [&::-webkit-slider-thumb]:w-3 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:shadow-[0_0_0_4px_rgba(249,115,22,0.28)]"
                                style={progressStyle}
                                aria-label="Song position"
                            />
                            <span className="w-8 text-right text-[10px] font-bold tabular-nums text-white/52">{formatTime(duration)}</span>
                        </div>
                    </div>

                    <div className="flex items-center gap-2.5">
                        <button
                            type="button"
                            onClick={() => seekTo(0)}
                            className="grid h-8 w-8 place-items-center rounded-full text-white/72 transition hover:bg-white/10 hover:text-white active:scale-95"
                            aria-label="Restart"
                        >
                            <SkipBack className="h-4 w-4" fill="currentColor" />
                        </button>
                        <button
                            type="button"
                            onClick={togglePlayback}
                            className="grid h-10 w-10 place-items-center rounded-full bg-white text-[#4a4038] shadow-[0_10px_24px_rgba(0,0,0,0.22)] transition hover:bg-orange-50 active:scale-95"
                            aria-label={isPlaying ? "Pause song" : "Play song"}
                        >
                            {isPlaying ? <Pause className="h-5 w-5" fill="currentColor" /> : <Play className="ml-0.5 h-5 w-5" fill="currentColor" />}
                        </button>
                        <button
                            type="button"
                            onClick={() => seekTo(Math.min(progress + 12, 100))}
                            className="grid h-8 w-8 place-items-center rounded-full text-white/72 transition hover:bg-white/10 hover:text-white active:scale-95"
                            aria-label="Forward"
                        >
                            <SkipForward className="h-4 w-4" fill="currentColor" />
                        </button>
                        <button
                            type="button"
                            onClick={() => setIsMuted((value) => !value)}
                            className="grid h-8 w-8 place-items-center rounded-full text-white/72 transition hover:bg-white/10 hover:text-white active:scale-95"
                            aria-label={isMuted ? "Unmute" : "Mute"}
                        >
                            {isMuted ? <VolumeX className="h-4 w-4" /> : <Volume2 className="h-4 w-4" />}
                        </button>
                    </div>
                </div>

                <div
                    className={cn(
                        "absolute inset-0 grid place-items-center transition-opacity duration-300",
                        isCollapsed ? "opacity-100" : "pointer-events-none opacity-0",
                    )}
                >
                    <button
                        type="button"
                        onClick={togglePlayback}
                        className="grid h-12 w-12 place-items-center rounded-full bg-white text-[#4a4038] shadow-[0_10px_24px_rgba(0,0,0,0.22)] transition hover:bg-orange-50 active:scale-95"
                        aria-label={isPlaying ? "Pause song" : "Play song"}
                    >
                        {isPlaying ? <Pause className="h-5 w-5" fill="currentColor" /> : <Play className="ml-0.5 h-5 w-5" fill="currentColor" />}
                    </button>
                </div>
            </div>
        </div>
    );
}
