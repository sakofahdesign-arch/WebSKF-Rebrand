# Journal Complete Shelf Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the current homepage journals showcase with a desktop-first Three.js shelf whose active journal changes the section background and opens an in-page reader.

**Architecture:** The Blade section owns the journal data and exposes it through a `data-journals` attribute. A new React mount parses that data and renders a focused `JournalCompleteShelf` component. The component owns the shelf state machine, Three.js canvas, fallback UI, and iframe reader overlay.

**Tech Stack:** Laravel Blade, Pest, Vite, React, TypeScript, Three.js, Tailwind CSS.

**Spec:** `docs/superpowers/specs/2026-08-20-journal-complete-shelf-design.md`

## Global Constraints

- Desktop-first Three.js shelf embedded in the existing homepage journals section.
- Use Sakofah journal data and branding.
- Do not copy Complete Shelf titles, covers, audio assets, or editorial copy.
- Per-journal theme colors are declared in the journal data for deterministic results.
- Opening the reader happens in-page with an iframe pointing to the existing AnyFlip/mobile URL.
- WebGL fallback shows the same journals as a clean static shelf/list if Three.js fails.
- Do not optimize for mobile beyond a usable fallback.
- Do not implement full physical page-by-page PDF turning inside WebGL in the first implementation.
- Do not add audio, generated sound effects, or persistent volume controls.

---

## File Structure

- `tests/Feature/ExampleTest.php`
  - Existing feature test file. Add source-level assertions for the new journals mount, data shape, component states, and app import.
- `resources/views/components/welcomes/journals-public.blade.php`
  - Continue to define journal data. Replace the old `data-books-showcase` mount with `data-journal-complete-shelf`.
- `resources/js/journal-complete-shelf-mount.tsx`
  - New focused mount file. Parse `data-journals` and mount React into each journal shelf element.
- `resources/js/app.js`
  - Import the new mount and remove the old books showcase mount import when the section no longer uses it.
- `components/ui/journal-complete-shelf.tsx`
  - New React component. Own state, Three.js canvas, controls, fallback, and reader overlay.
- `resources/js/books-showcase-mount.tsx` and `components/ui/books-showcase.tsx`
  - Leave in place unless no imports remain and cleanup is explicitly requested later.

---

### Task 1: Switch The Blade Contract To Journal Shelf Data

**Files:**
- Modify: `tests/Feature/ExampleTest.php`
- Modify: `resources/views/components/welcomes/journals-public.blade.php`

**Interfaces:**
- Consumes: Existing `$ebooks` array in `journals-public.blade.php`.
- Produces: `data-journal-complete-shelf` and `data-journals` with items containing `id`, `title`, `subtitle`, `year`, `href`, `downloadUrl`, `cover`, `themeColor`, and `foilColor`.

- [ ] **Step 1: Write the failing test**

Add this test near the existing journals tests in `tests/Feature/ExampleTest.php`:

```php
test('journals section exposes complete shelf journal data', function () {
    $html = view('components.welcomes.journals-public')->render();

    preg_match("/data-journals='([^']+)'/", $html, $matches);
    $journals = json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true);

    expect($html)
        ->toContain('data-journal-complete-shelf')
        ->not->toContain('data-books-showcase')
        ->not->toContain('data-books=')
        ->and($journals)->toHaveCount(9)
        ->and($journals[0])->toHaveKeys([
            'id',
            'title',
            'subtitle',
            'year',
            'href',
            'downloadUrl',
            'cover',
            'themeColor',
            'foilColor',
        ])
        ->and($journals[0]['themeColor'])->toStartWith('#')
        ->and($journals[0]['foilColor'])->toStartWith('#')
        ->and($journals[0]['cover'])->toContain('/images/ebooks/')
        ->and($journals[0]['downloadUrl'])->toContain('online.anyflip.com');
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "complete shelf journal data"
```

Expected: FAIL because `data-journal-complete-shelf` and `data-journals` do not exist.

- [ ] **Step 3: Write minimal Blade implementation**

In `resources/views/components/welcomes/journals-public.blade.php`:

1. Rename `$ebooks` to `$journals` or keep `$ebooks` and map to `$journals`.
2. For each existing item, add:
   - `year` such as `2560`
   - `cover` using the current `images.front` value
   - `themeColor` as a hand-picked color from the cover
   - `foilColor` as a bright accent
3. Replace this mount:

```blade
<div
    data-books-showcase
    data-hero-title="E-Book"
    data-nav-title="วารสารออนไลน์"
    data-books='@json($ebooks)'
    class="h-[680px] min-h-[560px] w-full"
>
```

with:

```blade
<div
    data-journal-complete-shelf
    data-journals='@json($journals)'
    class="h-[760px] min-h-[680px] w-full"
>
    <div class="grid h-full place-items-center bg-[#022c22] p-6 text-center text-white">
        <div>
            <p class="text-3xl font-black">วารสารออนไลน์</p>
            <p class="mt-3 text-sm font-semibold text-white/65">กำลังโหลดชั้นวารสาร</p>
        </div>
    </div>
</div>
```

- [ ] **Step 4: Run test to verify it passes**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "complete shelf journal data"
```

Expected: PASS.

- [ ] **Step 5: Commit**

```bash
git add tests/Feature/ExampleTest.php resources/views/components/welcomes/journals-public.blade.php
git commit -m "feat: expose journal shelf data"
```

---

### Task 2: Add The React Mount And App Import

**Files:**
- Modify: `tests/Feature/ExampleTest.php`
- Create: `resources/js/journal-complete-shelf-mount.tsx`
- Modify: `resources/js/app.js`

**Interfaces:**
- Consumes: DOM nodes with `[data-journal-complete-shelf]` and `data-journals`.
- Produces: A React mount that calls `<JournalCompleteShelf journals={journals} />`.

- [ ] **Step 1: Write the failing test**

Add this test:

```php
test('journal complete shelf mount is wired into the app bundle', function () {
    $mount = file_exists(base_path('resources/js/journal-complete-shelf-mount.tsx'))
        ? file_get_contents(base_path('resources/js/journal-complete-shelf-mount.tsx'))
        : '';
    $app = file_get_contents(base_path('resources/js/app.js'));

    expect($app)
        ->toContain('./journal-complete-shelf-mount')
        ->and($mount)->toContain('[data-journal-complete-shelf]')
        ->and($mount)->toContain('JSON.parse(mount.dataset.journals ?? "[]")')
        ->and($mount)->toContain('createRoot(mount).render')
        ->and($mount)->toContain('<JournalCompleteShelf journals={journals} />');
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "journal complete shelf mount"
```

Expected: FAIL because the mount file and app import are missing.

- [ ] **Step 3: Create the mount**

Create `resources/js/journal-complete-shelf-mount.tsx`:

```tsx
import React from "react";
import { createRoot } from "react-dom/client";
import { JournalCompleteShelf, type JournalShelfItem } from "../../components/ui/journal-complete-shelf";

document.querySelectorAll<HTMLElement>("[data-journal-complete-shelf]").forEach((mount) => {
    if (mount.dataset.journalShelfMounted === "true") {
        return;
    }

    mount.dataset.journalShelfMounted = "true";

    let journals: JournalShelfItem[] = [];

    try {
        journals = JSON.parse(mount.dataset.journals ?? "[]") as JournalShelfItem[];
    } catch (error) {
        console.error("Unable to parse journal shelf data", error);
    }

    createRoot(mount).render(<JournalCompleteShelf journals={journals} />);
});
```

- [ ] **Step 4: Add the app import**

In `resources/js/app.js`, add:

```js
import './journal-complete-shelf-mount';
```

Keep `import './books-showcase-mount';` for now if other screens or experiments still need it. Remove it only after confirming no mount remains.

- [ ] **Step 5: Run test to verify it passes**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "journal complete shelf mount"
```

Expected: PASS.

- [ ] **Step 6: Commit**

```bash
git add tests/Feature/ExampleTest.php resources/js/journal-complete-shelf-mount.tsx resources/js/app.js
git commit -m "feat: mount journal complete shelf"
```

---

### Task 3: Build The React State Shell, Controls, Fallback, And Reader

**Files:**
- Modify: `tests/Feature/ExampleTest.php`
- Create: `components/ui/journal-complete-shelf.tsx`

**Interfaces:**
- Consumes: `JournalShelfItem[]`.
- Produces: `JournalCompleteShelf({ journals }: { journals: JournalShelfItem[] })`.

- [ ] **Step 1: Write the failing test**

Add this test:

```php
test('journal complete shelf component exposes shelf detail reader and fallback states', function () {
    $component = file_exists(base_path('components/ui/journal-complete-shelf.tsx'))
        ? file_get_contents(base_path('components/ui/journal-complete-shelf.tsx'))
        : '';

    expect($component)
        ->toContain('export interface JournalShelfItem')
        ->toContain('export function JournalCompleteShelf')
        ->toContain('type ShelfMode = "shelf" | "detail" | "reader"')
        ->toContain('const [mode, setMode] = useState<ShelfMode>("shelf")')
        ->toContain('setMode("detail")')
        ->toContain('setMode("reader")')
        ->toContain('setMode("shelf")')
        ->toContain('selectedJournal.themeColor')
        ->toContain('เปิดอ่าน')
        ->toContain('กลับไปชั้นวารสาร')
        ->toContain('<iframe')
        ->toContain('เปิดในแท็บใหม่')
        ->toContain('WebGL ไม่พร้อมใช้งาน')
        ->toContain('aria-live="polite"');
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "journal complete shelf component"
```

Expected: FAIL because the component file does not exist.

- [ ] **Step 3: Create the component shell**

Create `components/ui/journal-complete-shelf.tsx` with:

```tsx
import React, { useMemo, useState } from "react";

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

    const selectedJournal = journals[activeIndex] ?? journals[0];
    const readerUrl = selectedJournal?.downloadUrl ?? selectedJournal?.href ?? "#";

    const themeStyle = useMemo(
        () =>
            ({
                "--journal-theme": selectedJournal?.themeColor ?? "#022c22",
                "--journal-foil": selectedJournal?.foilColor ?? "#facc15",
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

    return (
        <div
            className="relative h-full min-h-[680px] overflow-hidden bg-[var(--journal-theme)] text-white transition-colors duration-700"
            style={themeStyle}
        >
            <div className="absolute inset-0 bg-[radial-gradient(circle_at_50%_20%,rgba(255,255,255,0.24),transparent_42%)]" />

            {webglUnavailable ? (
                <FallbackShelf journals={journals} onRead={(index) => {
                    setActiveIndex(index);
                    setMode("reader");
                }} />
            ) : (
                <div data-journal-three-stage className="absolute inset-0" />
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
```

- [ ] **Step 4: Run test to verify it passes**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "journal complete shelf component"
```

Expected: PASS.

- [ ] **Step 5: Commit**

```bash
git add tests/Feature/ExampleTest.php components/ui/journal-complete-shelf.tsx
git commit -m "feat: add journal shelf state shell"
```

---

### Task 4: Implement The Three.js Shelf Scene

**Files:**
- Modify: `tests/Feature/ExampleTest.php`
- Modify: `components/ui/journal-complete-shelf.tsx`

**Interfaces:**
- Consumes: `journals`, `activeIndex`, `mode`, `setActiveIndex`, `setMode`, and `setWebglUnavailable`.
- Produces: A canvas scene inside `data-journal-three-stage` with hardbound journal volumes and animated selection/detail transforms.

- [ ] **Step 1: Write the failing test**

Add this source-level behavior test:

```php
test('journal complete shelf uses threejs for animated hardbound volumes', function () {
    $component = file_get_contents(base_path('components/ui/journal-complete-shelf.tsx'));

    expect($component)
        ->toContain('import * as THREE from "three"')
        ->toContain('new THREE.WebGLRenderer')
        ->toContain('renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))')
        ->toContain('new THREE.PerspectiveCamera')
        ->toContain('new THREE.BoxGeometry')
        ->toContain('createCoverTexture')
        ->toContain('createJournalBook')
        ->toContain('requestAnimationFrame')
        ->toContain('disposeScene')
        ->toContain('setWebglUnavailable(true)')
        ->toContain('window.addEventListener("resize", handleResize)')
        ->toContain('window.addEventListener("keydown", handleKeyDown)')
        ->toContain('stage.addEventListener("wheel", handleWheel')
        ->toContain('stage.addEventListener("pointerdown", handlePointerDown');
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "animated hardbound volumes"
```

Expected: FAIL because the component shell has no Three.js scene.

- [ ] **Step 3: Add Three.js scene code**

In `components/ui/journal-complete-shelf.tsx`:

1. Add imports:

```tsx
import { useEffect, useRef } from "react";
import * as THREE from "three";
```

2. Add a `stageRef`:

```tsx
const stageRef = useRef<HTMLDivElement | null>(null);
const activeIndexRef = useRef(activeIndex);
const modeRef = useRef(mode);

activeIndexRef.current = activeIndex;
modeRef.current = mode;
```

3. Change the stage node:

```tsx
<div ref={stageRef} data-journal-three-stage className="absolute inset-0 cursor-grab active:cursor-grabbing" />
```

4. Add a `useEffect` that:
   - creates `scene`, `camera`, `renderer`;
   - appends `renderer.domElement`;
   - creates lights;
   - maps journals to `createJournalBook(journal, index)`;
   - uses animation loop to position books based on `activeIndexRef.current`;
   - moves selected book forward and rotates it when `modeRef.current === "detail"`;
   - registers resize, keydown, wheel, and pointerdown handlers;
   - sets `setWebglUnavailable(true)` if renderer creation throws;
   - disposes all resources in cleanup.

5. Use these helper names so tests and later tasks have stable seams:

```tsx
function createCoverTexture(journal: JournalShelfItem): THREE.CanvasTexture
function createJournalBook(journal: JournalShelfItem, index: number): THREE.Group
function disposeScene(scene: THREE.Scene, renderer: THREE.WebGLRenderer): void
```

6. Pointer behavior:
   - Raycast against book groups.
   - If clicked book is not active, set it active.
   - If clicked book is active, call `setMode("detail")`.

- [ ] **Step 4: Run test to verify it passes**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "animated hardbound volumes"
```

Expected: PASS.

- [ ] **Step 5: Run TypeScript/build verification**

Run:

```bash
npm.cmd run build
```

Expected: PASS. Existing warnings about `@property --radialprogress` and large chunks may remain.

- [ ] **Step 6: Commit**

```bash
git add tests/Feature/ExampleTest.php components/ui/journal-complete-shelf.tsx
git commit -m "feat: render journal shelf in threejs"
```

---

### Task 5: Polish The Complete Shelf Feel And Remove Old Journals Mount Usage

**Files:**
- Modify: `tests/Feature/ExampleTest.php`
- Modify: `components/ui/journal-complete-shelf.tsx`
- Modify: `resources/js/app.js`
- Modify: `resources/views/components/welcomes/journals-public.blade.php`

**Interfaces:**
- Consumes: Working shelf from Tasks 1-4.
- Produces: A polished journal section that no longer depends on the old `BooksShowcase` mount.

- [ ] **Step 1: Write the failing test**

Add this test:

```php
test('journals complete shelf replaces the old books showcase mount', function () {
    $app = file_get_contents(base_path('resources/js/app.js'));
    $section = file_get_contents(base_path('resources/views/components/welcomes/journals-public.blade.php'));
    $component = file_get_contents(base_path('components/ui/journal-complete-shelf.tsx'));

    expect($app)
        ->toContain('./journal-complete-shelf-mount')
        ->not->toContain('./books-showcase-mount')
        ->and($section)
        ->toContain('data-journal-complete-shelf')
        ->toContain('h-[760px] min-h-[680px]')
        ->not->toContain('data-books-showcase')
        ->and($component)
        ->toContain('mixColor')
        ->toContain('activeBook.position.lerp')
        ->toContain('activeBook.rotation.y')
        ->toContain('modeRef.current === "detail"')
        ->toContain('bg-[var(--journal-theme)]')
        ->toContain('transition-colors duration-700')
        ->toContain('cursor-grab');
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "replaces the old books showcase"
```

Expected: FAIL if old import remains or polish markers are missing.

- [ ] **Step 3: Polish implementation**

In `resources/js/app.js`, remove:

```js
import './books-showcase-mount';
```

In `components/ui/journal-complete-shelf.tsx`:

1. Add a helper:

```tsx
function mixColor(color: string, amount: number): string {
    const parsed = new THREE.Color(color);
    return `#${parsed.lerp(new THREE.Color("#ffffff"), amount).getHexString()}`;
}
```

2. Use `mixColor(selectedJournal.themeColor, 0.08)` for subtle panel/highlight tones where useful.
3. Make active book animation use `position.lerp` and `rotation` interpolation rather than abrupt assignment.
4. In detail mode, rotate the active book partly open and move it toward camera.
5. Keep all labels in Thai and all fonts using the app font stack.

- [ ] **Step 4: Run test to verify it passes**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php --filter "replaces the old books showcase"
```

Expected: PASS.

- [ ] **Step 5: Run full verification**

Run:

```bash
php .\vendor\bin\pest tests\Feature\ExampleTest.php
npm.cmd run build
```

Expected: PASS. Existing build warnings may remain.

- [ ] **Step 6: Commit**

```bash
git add tests/Feature/ExampleTest.php resources/js/app.js resources/views/components/welcomes/journals-public.blade.php components/ui/journal-complete-shelf.tsx
git commit -m "feat: replace journals with complete shelf"
```

---

## Visual Verification

After all tasks pass:

- [ ] Start or reuse the local server at `http://127.0.0.1:8000/`.
- [ ] Open the homepage and scroll to "วารสารและสื่อประชาสัมพันธ์".
- [ ] Confirm the section shows the new 3D shelf.
- [ ] Confirm selecting different books changes the background color.
- [ ] Confirm clicking the active book opens detail mode.
- [ ] Confirm "เปิดอ่าน" opens an in-page iframe reader.
- [ ] Confirm "เปิดในแท็บใหม่" exists if iframe display is blocked.
- [ ] Confirm the console has no new runtime errors.

## Self-Review

- Spec coverage: Tasks cover Blade data, React mount, Three.js shelf, color-changing backgrounds, shelf/detail/reader states, in-page iframe reader, and WebGL fallback.
- Placeholder scan: No unfinished placeholder text remains.
- Type consistency: The plan consistently uses `JournalShelfItem`, `JournalCompleteShelf`, `data-journal-complete-shelf`, and `data-journals`.
