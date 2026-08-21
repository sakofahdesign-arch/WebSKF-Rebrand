import React, { useId } from "react";
import { cn } from "@/lib/utils";

export interface MorphTextProps {
    words?: string[];
    interval?: number;
    subtext?: string;
    fontSize?: string;
    fontFamily?: string;
    className?: string;
    textClassName?: string;
    subtextClassName?: string;
}

export function MorphText({
    words = ["SAKOFAH", "ษะกอฟะฮ", "الثقافة"],
    interval = 3000,
    subtext,
    fontSize = "clamp(3.4rem, 8vw, 7.5rem)",
    fontFamily = "var(--font-sans)",
    className,
    textClassName,
    subtextClassName,
}: MorphTextProps) {
    const uid = useId().replace(/:/g, "");
    const filterId = `morph-threshold-${uid}`;
    const totalDuration = (interval / 1000) * words.length;
    const wordDuration = interval / 1000;

    const wordStyles = words.map((_, index) => ({
        animationDelay: `${index * wordDuration}s`,
        animationDuration: `${totalDuration}s`,
    }));

    return (
        <div className={cn("morph-text-root relative flex flex-col items-center", className)}>
            <svg
                aria-hidden="true"
                focusable="false"
                style={{ position: "absolute", width: 0, height: 0, pointerEvents: "none" }}
            >
                <defs>
                    <filter id={filterId}>
                        <feColorMatrix
                            in="SourceGraphic"
                            type="matrix"
                            values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 25 -9"
                            result="goo"
                        />
                        <feComposite in="SourceGraphic" in2="goo" operator="atop" />
                    </filter>
                </defs>
            </svg>

            <div
                className={cn("morph-text-container relative select-none", textClassName)}
                style={{
                    fontSize,
                    fontWeight: 900,
                    filter: `url(#${filterId})`,
                    fontFamily,
                }}
            >
                <div
                    className="morph-word-rotator relative flex items-center justify-center"
                    style={{ height: "1.05em", minWidth: "9ch" }}
                >
                    {words.map((word, index) => (
                        <span
                            key={`${word}-${index}`}
                            className="morph-word absolute leading-none"
                            dir={/[\u0600-\u06FF]/.test(word) ? "rtl" : undefined}
                            style={{
                                top: "50%",
                                left: "50%",
                                transform: "translate(-50%, -50%)",
                                opacity: 0,
                                whiteSpace: "nowrap",
                                animationName: "morph-word-rotate",
                                animationTimingFunction: "ease-in-out",
                                animationIterationCount: "infinite",
                                animationFillMode: "both",
                                ...wordStyles[index],
                            }}
                        >
                            {word}
                        </span>
                    ))}
                </div>
            </div>

            {subtext && (
                <p
                    className={cn(
                        "morph-subtext mt-8 uppercase tracking-[0.2em] text-[#888]",
                        subtextClassName
                    )}
                    style={{
                        fontSize: "1.2rem",
                        opacity: 0,
                        animation: "morph-fade-up 1s ease-out 1s forwards",
                        fontFamily,
                    }}
                >
                    {subtext}
                </p>
            )}

            <style>{`
                @keyframes morph-word-rotate {
                    0% {
                        opacity: 0;
                        filter: blur(20px);
                        transform: translate(-50%, -50%) scale(0.8);
                    }
                    5% {
                        opacity: 0.5;
                        filter: blur(10px);
                    }
                    15%, 35% {
                        opacity: 1;
                        filter: blur(0px);
                        transform: translate(-50%, -50%) scale(1);
                    }
                    45% {
                        opacity: 0.5;
                        filter: blur(10px);
                    }
                    50%, 100% {
                        opacity: 0;
                        filter: blur(20px);
                        transform: translate(-50%, -50%) scale(1.2);
                    }
                }

                @keyframes morph-fade-up {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            `}</style>
        </div>
    );
}

export default MorphText;
