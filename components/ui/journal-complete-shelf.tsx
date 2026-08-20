import React, { useEffect, useMemo, useRef, useState } from "react";
import * as THREE from "three";

export interface JournalShelfItem {
    id: string;
    title: string;
    subtitle?: string;
    year?: string;
    href: string;
    downloadUrl?: string;
    cover: string;
    themeColor: string;
    foilColor: string;
}

type ShelfMode = "shelf" | "detail" | "reader";

interface JournalCompleteShelfProps {
    journals: JournalShelfItem[];
}

export function JournalCompleteShelf({ journals }: JournalCompleteShelfProps) {
    const [activeIndex, setActiveIndex] = useState(0);
    const [mode, setMode] = useState<ShelfMode>("shelf");
    const [webglUnavailable, setWebglUnavailable] = useState(false);
    const stageRef = useRef<HTMLDivElement | null>(null);
    const activeIndexRef = useRef(activeIndex);
    const modeRef = useRef(mode);

    activeIndexRef.current = activeIndex;
    modeRef.current = mode;

    const selectedJournal = journals[activeIndex] ?? journals[0];
    const readerUrl = selectedJournal?.downloadUrl ?? selectedJournal?.href ?? "#";

    const themeStyle = useMemo(
        () =>
            ({
                "--journal-theme": selectedJournal ? selectedJournal.themeColor : "#022c22",
                "--journal-foil": selectedJournal ? selectedJournal.foilColor : "#facc15",
            }) as React.CSSProperties,
        [selectedJournal],
    );

    if (!journals.length) {
        return (
            <div className="grid h-full place-items-center bg-white text-sm font-bold text-slate-500">
                ยังไม่มีวารสารออนไลน์
            </div>
        );
    }

    const goToIndex = (nextIndex: number) => {
        const normalized = (nextIndex + journals.length) % journals.length;
        setActiveIndex(normalized);
        setMode("shelf");
    };

    useEffect(() => {
        const stage = stageRef.current;

        if (!stage || webglUnavailable) {
            return;
        }

        let scene: THREE.Scene | null = null;
        let renderer: THREE.WebGLRenderer | null = null;
        let animationFrame = 0;
        let cleanedUp = false;
        let handleResize: () => void = () => {};
        let handleKeyDown: (event: KeyboardEvent) => void = () => {};
        let handleWheel: (event: WheelEvent) => void = () => {};
        let handlePointerDown: (event: PointerEvent) => void = () => {};

        const cleanup = () => {
            if (cleanedUp) {
                return;
            }

            cleanedUp = true;
            cancelAnimationFrame(animationFrame);
            window.removeEventListener("resize", handleResize);
            window.removeEventListener("keydown", handleKeyDown);
            stage.removeEventListener("wheel", handleWheel);
            stage.removeEventListener("pointerdown", handlePointerDown);

            if (scene && renderer) {
                disposeScene(scene, renderer);
            } else if (renderer) {
                renderer.dispose();
                renderer.domElement.remove();
            }
        };

        try {
            scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(42, stage.clientWidth / stage.clientHeight, 0.1, 100);
            camera.position.set(0, 0.15, 6.4);

            renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.setSize(stage.clientWidth, stage.clientHeight);
            renderer.outputColorSpace = THREE.SRGBColorSpace;
            stage.appendChild(renderer.domElement);

            scene.add(new THREE.AmbientLight(0xffffff, 1.4));

            const keyLight = new THREE.DirectionalLight(0xffffff, 2.2);
            keyLight.position.set(3, 5, 5);
            scene.add(keyLight);

            const rimLight = new THREE.DirectionalLight(0xfff4cf, 1.1);
            rimLight.position.set(-4, 1, 2);
            scene.add(rimLight);

            const books = journals.map((journal, index) => createJournalBook(journal, index));
            books.forEach((book) => scene?.add(book));

            const raycaster = new THREE.Raycaster();
            const pointer = new THREE.Vector2();

            const getBookIndex = (object: THREE.Object3D) => {
                let current: THREE.Object3D | null = object;

                while (current) {
                    if (typeof current.userData.bookIndex === "number") {
                        return current.userData.bookIndex as number;
                    }

                    current = current.parent;
                }

                return null;
            };

            handleResize = () => {
                const width = Math.max(stage.clientWidth, 1);
                const height = Math.max(stage.clientHeight, 1);

                camera.aspect = width / height;
                camera.updateProjectionMatrix();
                renderer?.setSize(width, height);
            };

            handleKeyDown = (event: KeyboardEvent) => {
                if (modeRef.current === "reader") {
                    return;
                }

                if (event.key === "ArrowLeft") {
                    goToIndex(activeIndexRef.current - 1);
                }

                if (event.key === "ArrowRight") {
                    goToIndex(activeIndexRef.current + 1);
                }

                if (event.key === "Enter" && modeRef.current === "shelf") {
                    setMode("detail");
                }
            };

            handleWheel = (event: WheelEvent) => {
                event.preventDefault();

                if (Math.abs(event.deltaY) > Math.abs(event.deltaX)) {
                    goToIndex(activeIndexRef.current + (event.deltaY > 0 ? 1 : -1));
                }
            };

            handlePointerDown = (event: PointerEvent) => {
                const bounds = stage.getBoundingClientRect();
                pointer.x = ((event.clientX - bounds.left) / bounds.width) * 2 - 1;
                pointer.y = -((event.clientY - bounds.top) / bounds.height) * 2 + 1;
                raycaster.setFromCamera(pointer, camera);

                const hit = raycaster.intersectObjects(books, true)[0];
                const bookIndex = hit ? getBookIndex(hit.object) : null;

                if (bookIndex === null) {
                    return;
                }

                if (bookIndex === activeIndexRef.current) {
                    setMode("detail");
                    return;
                }

                setActiveIndex(bookIndex);
                setMode("shelf");
            };

            const animate = () => {
                const selectedIndex = activeIndexRef.current;
                const showingDetail = modeRef.current === "detail";

                books.forEach((book, index) => {
                    let offset = index - selectedIndex;

                    if (offset > journals.length / 2) offset -= journals.length;
                    if (offset < -journals.length / 2) offset += journals.length;

                    const isSelected = index === selectedIndex;
                    const targetX = offset * 1.28;
                    const targetY = isSelected ? (showingDetail ? 0.35 : 0.14) : -0.08 - Math.min(Math.abs(offset) * 0.04, 0.18);
                    const targetZ = isSelected ? (showingDetail ? 1.45 : 0.45) : -Math.abs(offset) * 0.35;
                    const targetRotation = isSelected ? (showingDetail ? -0.32 : -0.08) : offset * -0.12;
                    const targetScale = isSelected ? (showingDetail ? 1.2 : 1.08) : Math.max(0.76, 0.98 - Math.abs(offset) * 0.04);

                    book.position.x = THREE.MathUtils.lerp(book.position.x, targetX, 0.1);
                    book.position.y = THREE.MathUtils.lerp(book.position.y, targetY, 0.1);
                    book.position.z = THREE.MathUtils.lerp(book.position.z, targetZ, 0.1);
                    book.rotation.y = THREE.MathUtils.lerp(book.rotation.y, targetRotation, 0.1);
                    book.rotation.z = THREE.MathUtils.lerp(book.rotation.z, isSelected ? 0 : offset * 0.025, 0.1);
                    book.scale.lerp(new THREE.Vector3(targetScale, targetScale, targetScale), 0.1);
                });

                renderer?.render(scene as THREE.Scene, camera);
                animationFrame = requestAnimationFrame(animate);
            };

            handleResize();
            window.addEventListener("resize", handleResize);
            window.addEventListener("keydown", handleKeyDown);
            stage.addEventListener("wheel", handleWheel, { passive: false });
            stage.addEventListener("pointerdown", handlePointerDown);
            animate();

            return cleanup;
        } catch {
            cleanup();
            setWebglUnavailable(true);
        }
    }, [journals, webglUnavailable]);

    return (
        <div
            className="relative h-full min-h-[680px] overflow-hidden bg-[var(--journal-theme)] text-white transition-colors duration-700"
            style={themeStyle}
        >
            <div className="absolute inset-0 bg-[radial-gradient(circle_at_50%_20%,rgba(255,255,255,0.24),transparent_42%)]" />

            {webglUnavailable ? (
                <FallbackShelf
                    journals={journals}
                    onRead={(index) => {
                        setActiveIndex(index);
                        setMode("reader");
                    }}
                />
            ) : (
                <div ref={stageRef} data-journal-three-stage className="absolute inset-0 cursor-grab active:cursor-grabbing" />
            )}

            <div className="absolute inset-x-6 bottom-6 z-20 grid gap-4 md:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] md:items-end">
                <div aria-live="polite">
                    <p className="text-xs font-bold uppercase tracking-[0.24em] text-white/65">
                        {String(activeIndex + 1).padStart(2, "0")} / {String(journals.length).padStart(2, "0")}
                    </p>
                    <h3 className="mt-2 max-w-xl text-4xl font-black leading-none md:text-6xl">
                        {selectedJournal.title}
                    </h3>
                    <p className="mt-3 max-w-xl text-sm font-semibold text-white/72">
                        {selectedJournal.subtitle ?? selectedJournal.year}
                    </p>
                </div>

                <div className="flex items-center justify-center gap-2">
                    <button type="button" className="rounded-full border border-white/40 px-4 py-2 text-sm font-bold" onClick={() => goToIndex(activeIndex - 1)}>
                        ก่อนหน้า
                    </button>
                    <button type="button" className="rounded-full bg-white px-5 py-2 text-sm font-black text-emerald-950" onClick={() => setMode("detail")}>
                        เปิดเล่ม
                    </button>
                    <button type="button" className="rounded-full border border-white/40 px-4 py-2 text-sm font-bold" onClick={() => goToIndex(activeIndex + 1)}>
                        ถัดไป
                    </button>
                </div>

                <div className="flex justify-start gap-2 md:justify-end">
                    {journals.map((journal, index) => (
                        <button
                            key={journal.id}
                            type="button"
                            aria-label={`เลือก ${journal.title}`}
                            aria-current={index === activeIndex}
                            className="h-3 w-3 rounded-full bg-white/40 aria-current:w-8 aria-current:bg-[var(--journal-foil)]"
                            onClick={() => goToIndex(index)}
                        />
                    ))}
                </div>
            </div>

            {mode === "detail" && (
                <div className="absolute right-8 top-24 z-30 w-[min(420px,calc(100%-4rem))] rounded-xl bg-white/92 p-6 text-emerald-950 shadow-2xl">
                    <button type="button" className="absolute right-4 top-4 text-sm font-black" onClick={() => setMode("shelf")}>
                        ปิด
                    </button>
                    <p className="text-xs font-black uppercase tracking-[0.24em] text-emerald-700">{selectedJournal.year}</p>
                    <h4 className="mt-3 text-3xl font-black leading-tight">{selectedJournal.title}</h4>
                    <p className="mt-3 text-sm font-semibold text-slate-600">{selectedJournal.subtitle}</p>
                    <div className="mt-6 flex flex-wrap gap-3">
                        <button type="button" className="rounded-full bg-emerald-700 px-5 py-3 text-sm font-black text-white" onClick={() => setMode("reader")}>
                            เปิดอ่าน
                        </button>
                        <button type="button" className="rounded-full border border-emerald-900/20 px-5 py-3 text-sm font-black" onClick={() => setMode("shelf")}>
                            กลับไปชั้นวารสาร
                        </button>
                    </div>
                </div>
            )}

            {mode === "reader" && (
                <div className="absolute inset-0 z-40 bg-emerald-950/92 p-6">
                    <div className="flex h-full flex-col overflow-hidden rounded-xl bg-white">
                        <div className="flex items-center justify-between border-b border-slate-200 px-4 py-3 text-emerald-950">
                            <strong>{selectedJournal.title}</strong>
                            <div className="flex items-center gap-2">
                                <a href={readerUrl} target="_blank" rel="noreferrer" className="rounded-full bg-emerald-700 px-4 py-2 text-sm font-black text-white">
                                    เปิดในแท็บใหม่
                                </a>
                                <button type="button" className="rounded-full border border-slate-200 px-4 py-2 text-sm font-black" onClick={() => setMode("detail")}>
                                    ปิด
                                </button>
                            </div>
                        </div>
                        <iframe src={readerUrl} title={selectedJournal.title} className="min-h-0 flex-1 border-0" />
                    </div>
                </div>
            )}

            <button type="button" hidden onClick={() => setWebglUnavailable(true)}>
                WebGL ไม่พร้อมใช้งาน
            </button>
        </div>
    );
}

function createCoverTexture(journal: JournalShelfItem): THREE.CanvasTexture {
    const canvas = document.createElement("canvas");
    canvas.width = 512;
    canvas.height = 720;
    const context = canvas.getContext("2d");

    if (!context) {
        throw new Error("Canvas 2D context is unavailable");
    }

    context.fillStyle = journal.themeColor;
    context.fillRect(0, 0, canvas.width, canvas.height);
    context.strokeStyle = journal.foilColor;
    context.lineWidth = 18;
    context.strokeRect(42, 42, canvas.width - 84, canvas.height - 84);
    context.fillStyle = journal.foilColor;
    context.fillRect(76, 108, canvas.width - 152, 6);
    context.font = "700 28px sans-serif";
    context.textAlign = "center";
    context.fillText(journal.year ?? "SAKOFAH", canvas.width / 2, 166);
    context.font = "800 42px sans-serif";

    const titleLines = journal.title.match(/.{1,16}(?:\s|$)/g) ?? [journal.title];
    titleLines.slice(0, 4).forEach((line, index) => {
        context.fillText(line.trim(), canvas.width / 2, 292 + index * 58);
    });

    const texture = new THREE.CanvasTexture(canvas);
    texture.colorSpace = THREE.SRGBColorSpace;
    return texture;
}

function createJournalBook(journal: JournalShelfItem, index: number): THREE.Group {
    const book = new THREE.Group();
    book.userData.bookIndex = index;

    const coverTexture = createCoverTexture(journal);
    const coverGeometry = new THREE.BoxGeometry(1.08, 1.56, 0.2);
    const coverMaterial = new THREE.MeshStandardMaterial({ color: journal.themeColor, roughness: 0.38, metalness: 0.08 });
    const frontMaterial = new THREE.MeshStandardMaterial({ map: coverTexture, roughness: 0.42, metalness: 0.04 });
    const cover = new THREE.Mesh(coverGeometry, [coverMaterial, coverMaterial, coverMaterial, coverMaterial, frontMaterial, coverMaterial]);
    cover.castShadow = true;
    cover.receiveShadow = true;
    book.add(cover);

    const pages = new THREE.Mesh(
        new THREE.BoxGeometry(0.98, 1.46, 0.16),
        new THREE.MeshStandardMaterial({ color: "#fff9e9", roughness: 0.82 }),
    );
    pages.position.z = -0.025;
    book.add(pages);

    const foil = new THREE.Mesh(
        new THREE.BoxGeometry(0.04, 1.5, 0.215),
        new THREE.MeshStandardMaterial({ color: journal.foilColor, roughness: 0.28, metalness: 0.62 }),
    );
    foil.position.x = -0.54;
    book.add(foil);

    return book;
}

function disposeScene(scene: THREE.Scene, renderer: THREE.WebGLRenderer): void {
    scene.traverse((object) => {
        const mesh = object as THREE.Mesh;

        mesh.geometry?.dispose();

        const materials = Array.isArray(mesh.material) ? mesh.material : [mesh.material];
        materials.filter(Boolean).forEach((material) => {
            Object.values(material).forEach((value) => {
                if (value instanceof THREE.Texture) {
                    value.dispose();
                }
            });
            material.dispose();
        });
    });

    renderer.dispose();
    renderer.forceContextLoss();
    renderer.domElement.remove();
}

function FallbackShelf({
    journals,
    onRead,
}: {
    journals: JournalShelfItem[];
    onRead: (index: number) => void;
}) {
    return (
        <div className="relative z-10 grid h-full content-center gap-4 overflow-x-auto p-8">
            <p className="text-sm font-bold text-white/80">WebGL ไม่พร้อมใช้งาน</p>
            <div className="flex gap-4">
                {journals.map((journal, index) => (
                    <button
                        key={journal.id}
                        type="button"
                        className="grid h-80 w-44 shrink-0 content-end rounded-md p-4 text-left shadow-2xl"
                        style={{ backgroundColor: journal.themeColor }}
                        onClick={() => onRead(index)}
                    >
                        <span className="text-xs font-bold text-white/70">{journal.year}</span>
                        <strong className="mt-2 text-xl font-black text-white">{journal.title}</strong>
                        <span className="mt-4 rounded-full bg-white px-3 py-2 text-center text-sm font-black text-emerald-950">เปิดอ่าน</span>
                    </button>
                ))}
            </div>
        </div>
    );
}

export default JournalCompleteShelf;
