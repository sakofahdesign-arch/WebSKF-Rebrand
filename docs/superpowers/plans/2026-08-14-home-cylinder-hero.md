# Home Cylinder Hero Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the first homepage carousel with a responsive Blade-based 3D organization image cylinder hero.

**Architecture:** The feature stays inside the existing Laravel Blade homepage. The component owns markup and image data; global CSS owns the reusable 3D cylinder and reduced-motion behavior.

**Tech Stack:** Laravel 12, Blade, Tailwind CSS v4, Vite, Pest/PHPUnit.

## Global Constraints

- Do not change route slugs, backend controllers, database queries, login, upload flows, or admin pages.
- Do not add React, shadcn, GSAP, or new runtime dependencies for this phase.
- Use real existing organization images from `public/images`.
- Animate only `transform` and `opacity`.
- Support mobile and `prefers-reduced-motion`.

---

### Task 1: Regression Test

**Files:**
- Modify: `tests/Feature/ExampleTest.php`

**Interfaces:**
- Consumes: homepage route `/`
- Produces: assertions for `data-section="organization-cylinder-hero"` and absence of `id="hero-carousel"`

- [ ] Add a feature test named `homepage renders the organization cylinder hero`.
- [ ] Run `php artisan test tests/Feature/ExampleTest.php` and verify it fails because the new hero marker does not exist.

### Task 2: Hero Component

**Files:**
- Create: `resources/views/components/welcomes/organization-cylinder.blade.php`
- Modify: `resources/views/welcome.blade.php`

**Interfaces:**
- Produces: Blade section with `data-section="organization-cylinder-hero"`
- Replaces: `@include('components.welcomes.main-carousel')`

- [ ] Create the component with local `$slides` image data.
- [ ] Render desktop 3D carousel and mobile horizontal fallback.
- [ ] Replace the homepage include.

### Task 3: Motion CSS

**Files:**
- Modify: `resources/css/app.css`

**Interfaces:**
- Consumes: `.org-cylinder-*` classes from the component.
- Produces: 3D cylinder rotation, responsive sizing, reduced-motion fallback.

- [ ] Add keyframes and classes for cylinder perspective, card radius, reflections, and mobile behavior.
- [ ] Add `@media (prefers-reduced-motion: reduce)` rules.

### Task 4: Verification

**Files:**
- No production files.

**Commands:**
- `php artisan test tests/Feature/ExampleTest.php`
- `php artisan test`
- `npm run build`
- `php artisan serve --host=127.0.0.1 --port=8000`

- [ ] Verify tests pass.
- [ ] Verify Vite build passes.
- [ ] Open local homepage and inspect the hero visually.
