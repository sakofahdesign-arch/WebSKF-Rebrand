# Home Cylinder Hero Design

**Goal:** Replace the existing first homepage carousel with an organization-focused 3D cylinder image hero while preserving Laravel routes, backend behavior, and existing content sources.

**Scope:** Phase 1 changes only the public homepage hero. Admin pages, login, database queries, member search, uploads, and route slugs remain unchanged.

**Design Direction:** Trust-first public website redesign for cooperative members, with a calm premium visual language. Brand color stays emerald with small gold accents. Motion is meaningful: the image cylinder introduces the organization archive, while hover and reveal states support hierarchy and feedback.

**Hero Structure:**
- A warm ivory hero surface with subtle geometric texture.
- A compact brand panel using the existing logo and organization name.
- Primary CTA to member services and secondary CTA to branches/contact.
- A CSS 3D cylinder carousel with real organization images from `public/images`.
- Mobile fallback changes the cylinder into a horizontal scroll gallery.
- `prefers-reduced-motion` disables continuous rotation and keeps the carousel readable.

**Technical Approach:**
- Use the existing Laravel Blade and Tailwind v4 stack.
- Create `resources/views/components/welcomes/organization-cylinder.blade.php`.
- Add scoped CSS utilities in `resources/css/app.css`.
- Replace `components.welcomes.main-carousel` include in `resources/views/welcome.blade.php`.
- Add a feature test that asserts homepage renders the new hero marker.

**Verification:**
- Run the new feature test and full test suite.
- Run `npm run build`.
- Start local Laravel server and inspect the homepage.
