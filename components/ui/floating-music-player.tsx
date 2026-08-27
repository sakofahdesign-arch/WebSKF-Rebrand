import { useEffect, useRef, useState } from "react";
import { Pause, Play, Volume2, VolumeX } from "lucide-react";
import { cn } from "@/lib/utils";

export interface FloatingMusicPlayerProps {
    src: string;
    title?: string;
}

function formatTime(value: number) {
    if (!Number.isFinite(value) || value <= 0) return "0:00";

    const minutes = Math.floor(value / 60);
    const seconds = Math.floor(value % 60);

    return `${minutes}:${seconds.toString().padStart(2, "0")}`;
}

export function FloatingMusicPlayer({
    src,
    title = "อนาชีดษะกอฟะฮ",
}: FloatingMusicPlayerProps) {
    const audioRef = useRef<HTMLAudioElement | null>(null);
    const [isPlaying, setIsPlaying] = useState(false);
    const [duration, setDuration] = useState(0);
    const [currentTime, setCurrentTime] = useState(0);
    const [volume, setVolume] = useState(0.72);
    const [isMuted, setIsMuted] = useState(false);

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
        const handleEnded = () => setIsPlaying(false);

        audio.addEventListener("loadedmetadata", handleLoadedMetadata);
        audio.addEventListener("timeupdate", handleTimeUpdate);
        audio.addEventListener("ended", handleEnded);

        return () => {
            audio.removeEventListener("loadedmetadata", handleLoadedMetadata);
            audio.removeEventListener("timeupdate", handleTimeUpdate);
            audio.removeEventListener("ended", handleEnded);
        };
    }, []);

    const togglePlayback = async () => {
        const audio = audioRef.current;
        if (!audio) return;

        if (audio.paused) {
            try {
                await audio.play();
                setIsPlaying(true);
            } catch {
                setIsPlaying(false);
            }
            return;
        }

        audio.pause();
        setIsPlaying(false);
    };

    const seekTo = (value: number) => {
        const audio = audioRef.current;
        if (!audio || !duration) return;

        audio.currentTime = (value / 100) * duration;
        setCurrentTime(audio.currentTime);
    };

    const progress = duration ? (currentTime / duration) * 100 : 0;

    return (
        <div className="fixed bottom-4 right-4 z-[90] w-[min(22rem,calc(100vw-2rem))] sm:bottom-6 sm:right-6">
            <audio ref={audioRef} src={src} preload="metadata" />

            <div className="overflow-hidden rounded-2xl border border-emerald-950/15 bg-white/92 shadow-[0_20px_52px_rgba(2,44,34,0.22)] backdrop-blur-xl dark:border-white/15 dark:bg-[#06120f]/92">
                <div className="flex items-center gap-3 p-3">
                    <button
                        type="button"
                        onClick={togglePlayback}
                        className="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-emerald-800 text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.2),0_10px_24px_rgba(6,78,59,0.24)] transition hover:bg-emerald-700 active:scale-95"
                        aria-label={isPlaying ? "หยุดเพลง" : "เล่นเพลง"}
                    >
                        {isPlaying ? <Pause className="h-5 w-5" /> : <Play className="ml-0.5 h-5 w-5" />}
                    </button>

                    <div className="min-w-0 flex-1">
                        <div className="flex items-center justify-between gap-3">
                            <p className="truncate text-sm font-extrabold text-emerald-950 dark:text-white">
                                {title}
                            </p>
                            <span className="shrink-0 text-[11px] font-semibold tabular-nums text-emerald-950/60 dark:text-white/60">
                                {formatTime(currentTime)}
                            </span>
                        </div>

                        <input
                            type="range"
                            min={0}
                            max={100}
                            value={progress}
                            onChange={(event) => seekTo(Number(event.target.value))}
                            className="mt-2 h-1.5 w-full cursor-pointer accent-emerald-700"
                            aria-label="ตำแหน่งเพลง"
                        />
                    </div>

                    <button
                        type="button"
                        onClick={() => setIsMuted((value) => !value)}
                        className={cn(
                            "grid h-9 w-9 shrink-0 place-items-center rounded-full border transition active:scale-95",
                            isMuted
                                ? "border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-400/30 dark:bg-rose-400/10 dark:text-rose-200"
                                : "border-emerald-950/10 bg-emerald-50 text-emerald-800 dark:border-white/10 dark:bg-white/10 dark:text-white",
                        )}
                        aria-label={isMuted ? "เปิดเสียง" : "ปิดเสียง"}
                    >
                        {isMuted ? <VolumeX className="h-4 w-4" /> : <Volume2 className="h-4 w-4" />}
                    </button>
                </div>

                <div className="flex items-center gap-2 border-t border-emerald-950/10 px-3 py-2 dark:border-white/10">
                    <span className="text-[10px] font-bold text-emerald-950/50 dark:text-white/50">
                        VOL
                    </span>
                    <input
                        type="range"
                        min={0}
                        max={1}
                        step={0.01}
                        value={isMuted ? 0 : volume}
                        onChange={(event) => {
                            setVolume(Number(event.target.value));
                            setIsMuted(false);
                        }}
                        className="h-1.5 flex-1 cursor-pointer accent-emerald-700"
                        aria-label="ระดับเสียง"
                    />
                    <span className="w-10 text-right text-[10px] font-bold tabular-nums text-emerald-950/50 dark:text-white/50">
                        {formatTime(duration)}
                    </span>
                </div>
            </div>
        </div>
    );
}
