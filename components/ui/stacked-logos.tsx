"use client";

import * as React from "react";
import { cn } from "@/lib/utils";

export interface StackedLogosProps {
    logoGroups: React.ReactNode[][];
    duration?: number;
    stagger?: number;
    logoWidth?: string;
    className?: string;
}

export const StackedLogos = ({
    logoGroups,
    duration = 30,
    stagger = 0,
    logoWidth = "200px",
    className,
}: StackedLogosProps) => {
    const itemCount = logoGroups[0]?.length || 0;
    const columns = logoGroups.length;
    const containerRef = React.useRef<HTMLDivElement>(null);
    const gridRef = React.useRef<HTMLDivElement>(null);
    const cellHeight = 128;

    const handleMouseMove = React.useCallback((event: React.MouseEvent<HTMLDivElement>) => {
        if (!containerRef.current || !gridRef.current) return;

        const rect = gridRef.current.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        containerRef.current.style.setProperty("--mouse-x", `${x}px`);
        containerRef.current.style.setProperty("--mouse-y", `${y}px`);
    }, []);

    return (
        <div
            ref={containerRef}
            className={cn("stacked-logos relative w-auto", className)}
            style={
                {
                    "--duration": duration,
                    "--items": itemCount,
                    "--lists": columns,
                    "--stagger": stagger,
                    "--logo-width": logoWidth,
                    "--cell-height": `${cellHeight}px`,
                } as React.CSSProperties
            }
            onMouseMove={handleMouseMove}
        >
            <div
                ref={gridRef}
                className="relative mx-auto grid w-fit overflow-hidden rounded-xl bg-white shadow-[0_24px_80px_rgba(6,78,59,0.10)] ring-1 ring-emerald-900/10"
                style={{
                    gridTemplateColumns: `repeat(${columns}, ${logoWidth})`,
                }}
            >
                <div
                    className="stacked-logos__glow pointer-events-none absolute inset-0 z-10 opacity-0 transition-opacity duration-300"
                    style={{
                        background:
                            "radial-gradient(500px circle at var(--mouse-x, 0) var(--mouse-y, 0), rgba(16,185,129,0.13), transparent 70%)",
                    }}
                />

                <div
                    className="stacked-logos__border-glow pointer-events-none absolute inset-0 z-20 opacity-0 transition-opacity duration-300"
                    style={{
                        background:
                            "radial-gradient(600px circle at var(--mouse-x, 0) var(--mouse-y, 0), rgba(16,185,129,0.95), transparent 40%)",
                        maskImage: `
                            repeating-linear-gradient(to right, transparent, transparent calc(${logoWidth} - 1px), black calc(${logoWidth} - 1px), black ${logoWidth}),
                            linear-gradient(to bottom, black 0, black 1px, transparent 1px, transparent calc(100% - 1px), black calc(100% - 1px), black 100%)
                        `,
                        WebkitMaskImage: `
                            repeating-linear-gradient(to right, transparent, transparent calc(${logoWidth} - 1px), black calc(${logoWidth} - 1px), black ${logoWidth}),
                            linear-gradient(to bottom, black 0, black 1px, transparent 1px, transparent calc(100% - 1px), black calc(100% - 1px), black 100%)
                        `,
                        maskComposite: "add",
                        WebkitMaskComposite: "source-over",
                    }}
                />

                <div
                    className="stacked-logos__border-glow pointer-events-none absolute bottom-0 left-0 top-0 z-20 w-px opacity-0 transition-opacity duration-300"
                    style={{
                        background:
                            "radial-gradient(600px circle at var(--mouse-x, 0) var(--mouse-y, 0), rgba(16,185,129,0.95), transparent 40%)",
                    }}
                />

                {logoGroups.map((logos, groupIndex) => (
                    <div
                        key={groupIndex}
                        className="stacked-logos__cell relative grid"
                        style={
                            {
                                "--index": groupIndex,
                                gridTemplate: "1fr / 1fr",
                            } as React.CSSProperties
                        }
                    >
                        <div className="absolute bottom-0 right-0 top-0 w-px bg-emerald-900/12" />
                        <div className="absolute bottom-0 left-0 right-0 h-px bg-emerald-900/12" />
                        <div className="absolute left-0 right-0 top-0 h-px bg-emerald-900/12" />
                        {groupIndex === 0 && <div className="absolute bottom-0 left-0 top-0 w-px bg-emerald-900/12" />}

                        {logos.map((logo, logoIndex) => (
                            <div
                                key={logoIndex}
                                className="stacked-logos__item col-start-1 row-start-1 grid place-items-center px-8 py-16"
                                data-logo
                                style={{ "--i": logoIndex } as React.CSSProperties}
                            >
                                <div className="stacked-logos__logo flex h-8 w-full items-center justify-center">
                                    {logo}
                                </div>
                            </div>
                        ))}
                    </div>
                ))}
            </div>
        </div>
    );
};

StackedLogos.displayName = "StackedLogos";

export default StackedLogos;
