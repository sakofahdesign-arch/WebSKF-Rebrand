# Journal Complete Shelf Design

## Goal

Replace the current "วารสารและสื่อประชาสัมพันธ์" book showcase with a desktop-first 3D shelf experience inspired by Complete Shelf. The section should feel close to the reference: a continuous shelf of hardbound journal volumes, a selected volume that pulls into a detail/open-book state, and a background/theme that changes color based on the selected cover.

The implementation must use Sakofah journal data and branding. It must not copy the reference titles, covers, audio assets, or editorial copy.

## Scope

In scope:

- Desktop-first Three.js shelf embedded in the existing homepage journals section.
- Journal data from `resources/views/components/welcomes/journals-public.blade.php`.
- Per-journal theme colors, initially declared in the journal data for deterministic results.
- Smooth section background transition when the selected journal changes.
- Shelf browsing with previous/next controls, marker navigation, mouse wheel navigation, and keyboard arrows.
- Click a journal to enter a detail/open-book state.
- In the detail state, show the selected journal title, year, short description, and an "เปิดอ่าน" action.
- Opening the reader should happen in-page using an overlay/modal with an iframe pointing to the existing AnyFlip/mobile URL.
- Close controls for reader and detail state.
- WebGL fallback showing the same journals as a clean static shelf/list if Three.js fails.

Out of scope for the first implementation:

- Mobile optimization beyond a usable fallback.
- Full physical page-by-page PDF turning inside WebGL.
- Audio, generated sound effects, and persistent volume controls.
- Copying Complete Shelf embedded artwork or audio.

## User Experience

The section keeps the current heading style used across homepage sections. Below the heading, the 3D shelf fills a large desktop viewport area.

Default state:

- A row of Sakofah annual report / journal books is shown in 3D.
- The active book is emphasized.
- The section background uses the active book's `themeColor`.
- The UI shows the selected title, year, and a short note.

Browse state:

- Wheel, arrow buttons, keyboard arrows, and dot markers change the selected journal.
- Changing selection updates the background color with a smooth transition.

Detail state:

- Clicking the active book pulls it forward into an inspection/open-book view.
- A detail panel appears with title, year, and action buttons.
- "เปิดอ่าน" opens a reader overlay in the same page.
- "กลับไปชั้นวารสาร" returns to the shelf.

Reader state:

- A large modal/overlay displays the journal URL in an iframe.
- The overlay uses the selected journal theme as a soft backdrop.
- Closing the overlay returns to the detail/open-book state.

Fallback:

- If WebGL cannot initialize, show a static horizontal shelf/grid using the same data, with "เปิดอ่าน" buttons.

## Architecture

New components:

- `components/ui/journal-complete-shelf.tsx`
  - Owns Three.js scene setup, state machine, controls, and reader overlay.
  - Receives `journals` as JSON data.
  - Uses CSS custom properties for dynamic background colors.

- `resources/js/journal-complete-shelf-mount.tsx`
  - Finds `[data-journal-complete-shelf]`.
  - Parses `data-journals`.
  - Mounts the React component.

Changed files:

- `resources/views/components/welcomes/journals-public.blade.php`
  - Replace `data-books-showcase` with `data-journal-complete-shelf`.
  - Extend existing `$ebooks` items with `themeColor`, `foilColor`, and `year`.

- `resources/js/app.js`
  - Import the new mount file.

- `tests/Feature/ExampleTest.php`
  - Add assertions that the journals section uses the new shelf mount, has theme data, and no longer mounts the old `BooksShowcase`.
  - Add assertions that the component contains the shelf/detail/reader/fallback states.

Existing `components/ui/books-showcase.tsx` can remain unused for now to avoid breaking other local experiments. It can be removed later if the user asks for cleanup.

## Data Shape

Each journal item should be normalized to:

```ts
type JournalShelfItem = {
  id: string;
  title: string;
  subtitle?: string;
  year?: string;
  href: string;
  downloadUrl?: string;
  cover: string;
  themeColor: string;
  foilColor: string;
};
```

For reader URLs, prefer `downloadUrl`; fallback to `href`.

## Interaction Model

State machine:

```text
shelf -> detail -> reader -> detail -> shelf
```

Selection can change in `shelf`. Detail opens only for the selected item. Reader opens only from detail.

The first implementation should keep the geometry simpler than Complete Shelf but preserve the feel:

- hardbound covers with spine/front/back surfaces;
- book row on a shelf;
- active volume moves forward;
- detail state rotates/opens the book enough to signal "open";
- background colors transition per selected book.

## Performance

Desktop is the target. Still:

- Dispose Three.js geometries, materials, and textures on unmount.
- Use `requestAnimationFrame` only while mounted.
- Resize renderer with a bounded pixel ratio, maximum `2`.
- Use one canvas for the section.
- Use generated canvas textures or local cover images, not remote runtime texture dependencies where avoidable.

## Testing

TDD steps:

1. Add failing tests for the Blade mount and journal data fields.
2. Add failing tests for the React component source containing key states and controls.
3. Implement the Blade data changes and mount.
4. Implement the component enough to pass.
5. Run `php .\vendor\bin\pest tests\Feature\ExampleTest.php`.
6. Run `npm.cmd run build`.
7. Run the local site and visually verify the section in browser if a dev server is available.

## Risks

- Complete Shelf is a large single-file WebGL experience; copying it directly would be brittle and may create licensing issues.
- AnyFlip URLs may block iframe embedding depending on their headers. If iframe embedding is blocked, the reader overlay should show a clear "เปิดในแท็บใหม่" fallback button.
- WebGL can fail on some machines; static fallback is required even though mobile is not the target.
