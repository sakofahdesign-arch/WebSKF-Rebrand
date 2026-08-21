"use client";

import React from "react";
import { cn } from "@/lib/utils";

export interface CarouselImage {
    src: string;
    alt?: string;
}

export interface CylinderCarouselProps extends React.HTMLAttributes<HTMLDivElement> {
    images: CarouselImage[];
    containerClassName?: string;
    cardClassName?: string;
    animationDuration?: number;
    cardWidth?: number;
    depthScale?: number;
    perspectiveDistance?: string;
    maskStops?: string;
}

export const CylinderCarousel = React.forwardRef<HTMLDivElement, CylinderCarouselProps>(
    (
        {
            images,
            className,
            containerClassName,
            cardClassName,
            animationDuration = 32,
            cardWidth = 250,
            depthScale = 1,
            perspectiveDistance = "35em",
            maskStops = "20% 80%",
            ...props
        },
        ref
    ) => {
        const N = images.length;

        const customStyle = {
            "--n": N,
            "--w": `${cardWidth}px`,
            "--ba": "calc(1turn / var(--n))",
            "--anim-dur": `${animationDuration}s`,
            "--depth-scale": depthScale,
        } as React.CSSProperties;

        return (
            <div
                ref={ref}
                className={cn(
                    "w-full h-full min-h-[500px] grid place-items-center overflow-hidden",
                    className
                )}
                style={{
                    perspective: perspectiveDistance,
                    maskImage: `linear-gradient(90deg, transparent, #000 ${maskStops}, transparent)`,
                    WebkitMaskImage: `linear-gradient(90deg, transparent, #000 ${maskStops}, transparent)`,
                }}
                {...props}
            >
                <div
                    className={cn(
                        "grid place-items-center [transform-style:preserve-3d] motion-reduce:!animate-[ry_128s_linear_infinite]",
                        containerClassName
                    )}
                    style={{
                        ...customStyle,
                        animation: "ry var(--anim-dur) linear infinite",
                    }}
                >
                    <style>
                        {`
                            @keyframes ry {
                                to { transform: rotateY(1turn); }
                            }
                        `}
                    </style>

                    {images.map((img, i) => (
                        <img
                            key={i}
                            src={img.src}
                            alt={img.alt || `Carousel image ${i}`}
                            className={cn(
                                "[grid-area:1/1] object-cover rounded-2xl [backface-visibility:hidden]",
                                cardClassName
                            )}
                            style={{
                                width: "var(--w)",
                                aspectRatio: "7/10",
                                "--i": i,
                                transform:
                                    "rotateY(calc(var(--i) * var(--ba))) translateZ(calc(-1 * var(--depth-scale) * (0.5 * var(--w) + 0.5em) / tan(0.5 * var(--ba))))",
                            } as React.CSSProperties}
                        />
                    ))}
                </div>
            </div>
        );
    }
);

CylinderCarousel.displayName = "CylinderCarousel";
