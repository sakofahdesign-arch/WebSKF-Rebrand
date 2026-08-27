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
    const [volume] = useState(0.82);
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
        <div className="fixed bottom-4 right-4 z-[90] w-[min(20rem,calc(100vw-2rem))] sm:bottom-5 sm:right-5">
            <audio ref={audioRef} src={src} preload="auto" playsInline />

            <div
                className={cn(
                    "relative ml-auto overflow-visible rounded-[10px] border border-white/15 bg-[#4a4038]/94 text-white shadow-[0_14px_42px_rgba(0,0,0,0.3)] backdrop-blur-xl transition-[width,min-height,transform,opacity] duration-500",
                    isCollapsed ? "min-h-[74px] w-[158px]" : "min-h-[68px] w-full",
                )}
            >
                <button
                    type="button"
                    onClick={() => setIsCollapsed((value) => !value)}
                    className="absolute -right-2.5 -top-2.5 z-20 grid h-7 w-7 place-items-center rounded-full border border-white/15 bg-[#5b564f] text-white shadow-[0_8px_20px_rgba(0,0,0,0.32)] transition hover:bg-[#686057] active:scale-95"
                    aria-label={isCollapsed ? "Expand music player" : "Collapse music player"}
                >
                    {isCollapsed ? <span className="text-lg leading-none">+</span> : <Minus className="h-3.5 w-3.5" />}
                </button>

                {artwork ? (
                    <div
                        className={cn(
                            "absolute -left-2 -top-3 z-10 h-[58px] w-[58px] overflow-hidden rounded-lg bg-white p-1 shadow-[0_12px_24px_rgba(0,0,0,0.32)] transition duration-500",
                            isCollapsed && "left-0 top-1/2 -translate-y-1/2 translate-x-0",
                        )}
                    >
                        <img src={artwork} alt="" className="h-full w-full rounded-md object-contain" loading="lazy" />
                    </div>
                ) : null}

                <div
                    className={cn(
                        "grid min-h-[68px] grid-cols-[1fr_auto] items-center gap-3 px-2.5 py-2 transition-opacity duration-300",
                        artwork ? "pl-[4.05rem]" : "pl-2.5",
                        isCollapsed && "pointer-events-none opacity-0",
                    )}
                >
                    <div className="min-w-0">
                        <div className="flex min-w-0 items-center gap-3">
                            <div className="flex h-6 w-4 shrink-0 items-end gap-[2px] text-orange-500" aria-hidden="true">
                                {equalizerBars.map((bar) => (
                                    <span
                                        key={bar}
                                        className={cn(
                                            "block w-[2px] origin-bottom rounded-full bg-current",
                                            isPlaying ? "animate-[sakofah-eq_0.72s_ease-in-out_infinite]" : "h-2",
                                        )}
                                        style={{
                                            height: isPlaying ? `${8 + bar * 2}px` : undefined,
                                            animationDelay: `${bar * 0.12}s`,
                                        }}
                                    />
                                ))}
                            </div>
                            <div className="min-w-0">
                                <p className="truncate text-[11px] font-black uppercase leading-tight tracking-wide">
                                    {title}
                                </p>
                                <p className="truncate text-[8.5px] font-bold uppercase tracking-[0.16em] text-white/48">
                                    {autoPlayBlocked ? "Tap to play" : artist}
                                </p>
                            </div>
                        </div>

                        <div className="mt-1.5 grid grid-cols-[2.25rem_1fr_2.25rem] items-center gap-1.5">
                            <span className="w-9 text-[8.5px] font-bold tabular-nums text-white/52">{formatTime(currentTime)}</span>
                            <input
                                type="range"
                                min={0}
                                max={100}
                                value={progress}
                                onChange={(event) => seekTo(Number(event.target.value))}
                                className="h-1 flex-1 cursor-pointer appearance-none rounded-full bg-white/18 accent-orange-500 [&::-webkit-slider-thumb]:h-2.5 [&::-webkit-slider-thumb]:w-2.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:shadow-[0_0_0_3px_rgba(249,115,22,0.25)]"
                                style={progressStyle}
                                aria-label="Song position"
                            />
                            <span className="w-9 text-right text-[8.5px] font-bold tabular-nums text-white/52">{formatTime(duration)}</span>
                        </div>
                    </div>

                    <div className="flex items-center gap-0.5">
                        <button
                            type="button"
                            onClick={() => seekTo(0)}
                            className="grid h-5 w-5 place-items-center rounded-full text-white/72 transition hover:bg-white/10 hover:text-white active:scale-95"
                            aria-label="Restart"
                        >
                            <SkipBack className="h-3 w-3" fill="currentColor" />
                        </button>
                        <button
                            type="button"
                            onClick={togglePlayback}
                            className="grid h-7 w-7 place-items-center rounded-full bg-white text-[#4a4038] shadow-[0_7px_16px_rgba(0,0,0,0.22)] transition hover:bg-orange-50 active:scale-95"
                            aria-label={isPlaying ? "Pause song" : "Play song"}
                        >
                            {isPlaying ? <Pause className="h-4 w-4" fill="currentColor" /> : <Play className="ml-0.5 h-4 w-4" fill="currentColor" />}
                        </button>
                        <button
                            type="button"
                            onClick={() => seekTo(Math.min(progress + 12, 100))}
                            className="grid h-5 w-5 place-items-center rounded-full text-white/72 transition hover:bg-white/10 hover:text-white active:scale-95"
                            aria-label="Forward"
                        >
                            <SkipForward className="h-3 w-3" fill="currentColor" />
                        </button>
                        <button
                            type="button"
                            onClick={() => setIsMuted((value) => !value)}
                            className="grid h-5 w-5 place-items-center rounded-full text-white/72 transition hover:bg-white/10 hover:text-white active:scale-95"
                            aria-label={isMuted ? "Unmute" : "Mute"}
                        >
                            {isMuted ? <VolumeX className="h-3 w-3" /> : <Volume2 className="h-3 w-3" />}
                        </button>
                    </div>
                </div>

                <div
                    className={cn(
                        "absolute inset-y-0 left-[66px] flex items-center transition-opacity duration-300",
                        isCollapsed ? "opacity-100" : "pointer-events-none opacity-0",
                    )}
                    aria-hidden={!isCollapsed}
                >
                    <button type="button" onClick={togglePlayback} className="flex h-12 w-16 items-end gap-[4px] px-2 pb-4 text-orange-500" aria-label={isPlaying ? "Pause song" : "Play song"}>
                        {equalizerBars.map((bar) => (
                            <span
                                key={bar}
                                className={cn("block w-[3px] origin-bottom rounded-full bg-current", isPlaying ? "animate-[sakofah-eq_0.72s_ease-in-out_infinite]" : "h-2")}
                                style={{ height: isPlaying ? `${10 + bar * 4}px` : undefined, animationDelay: `${bar * 0.12}s` }}
                            />
                        ))}
                    </button>
                </div>
            </div>
        </div>
    );
}