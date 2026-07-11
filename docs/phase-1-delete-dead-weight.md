# Phase 1 — Delete dead weight

**Goal:** Shrink the dual stack without rewriting behavior.  
**Date:** 2026-07-11  
**Status:** Done (rebuild completed). Re-run QA matrix before Phase 2.

---

## 1.1 Frontend deletions

| Removed | Notes |
|---------|--------|
| `public/js/scrollax.min.js` + layout/init | Zero `[data-scrollax]` markup |
| `public/js/jquery.animateNumber.min.js` | Zero `.number` counter markup |
| `public/js/google-map.min.js` + Maps API loader | No `#map`; contact uses iframe |
| `jquery.easing.1.3.min.js` from layouts | Only used by deleted OnePageNav / dead animate paths |
| ~70% of `main.js` | Dropped video modal, case carousel, counters, txt-rotate, dead nav/logo scroll, fullHeight, dropdown hover, Scrollax |
| Duplicate Stellar error handler in layout | Single handler remains in `main.js` |
| Orphan Vite inputs | Removed `resources/js/app.js`, `resources/js/bootstrap.js`, `resources/css/app.css` from disk + `vite.config.js` |
| Dead layout head jQuery block | Logo/`ftco_navbar` scroll, testimony init, unused `#home3` / blog fallbacks |

**Kept in slim `main.js`:** `#ftco-loader` dismiss, Stellar init + particles patch, `ftco-animate` waypoints.

**Moved:** Homepage Swiper `.carousel-testimony` → `resources/js/frontend.js`.

## 1.2 Still live (intentional)

| Asset | Why |
|--------|-----|
| `#ftco-loader` | Still in frontend + appointment layouts |
| Swiper testimony | Homepage via Vite |
| AOS | about/contact |
| `footer-animations.js`, `analytics-engagement.js` | Live; Vite-import later |
| Static BS4 CSS theme | No SCSS source; high regression risk |
| Stellar + waypoints on practice-areas / cms.slug | Phase 3 decide CSS replacement |

## 1.3 Admin quick cuts

| Action | Result |
|--------|--------|
| Strip `scripts.js` / `custom.js` from `admin-login` | Login keeps jQuery/BS + Vite `vendor-admin` (Lucide) + Turnstile; tiny loader hide |
| Remove `data-bootstrap-switch` | Stripped from blog / blogcategory / cms_page / recent_case views |
| Unwired scaffolds | `legacy-scripts-replacement.js`, `performance-monitor.js`, `lazy-loading.js` remain on disk but **not** wired — do not treat as done |

## Build delta (approx.)

| Bundle | Before (gzip) | After (gzip) |
|--------|---------------|--------------|
| `main.js` | ~2.4 kB | **0.92 kB** |
| `frontend.js` | ~0.63 kB | **0.82 kB** (added Swiper testimony) |
| Orphan `app.js` + lodash/jquery/bootstrap chunks | present | **gone** from manifest |

## QA checklist (must re-pass)

- [ ] `/` — Swiper testimony, loader dismiss, video modal (`@section('scripts')`)
- [ ] `/about`, `/contact` — AOS
- [ ] `/practice-areas` — hero + Stellar/ftco-animate (no console Stellar crash)
- [ ] One CMS slug (e.g. `/migration-law` or non–practice-area CMS) — hero
- [ ] `/book-an-appointment` — multi-step booking
- [ ] Landing page — Vite main + page scripts
- [ ] Admin login — Turnstile + submit; no `custom.js` errors
- [ ] Admin blog/CMS status toggles — still work (attrs only removed)

## Exit criteria

- [x] Fewer HTTP requests (scrollax, animateNumber, maps, easing, duplicate handlers, orphan Vite entries)
- [ ] No behavior change on QA matrix (manual)
- [x] Orphan Vite entries gone

**Next:** Phase 2 — move remaining live static JS into Vite imports; Phase 3 — Stellar → CSS decision.
