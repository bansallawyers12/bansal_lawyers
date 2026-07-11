# Phase 8 — Frontend CSS off Bootstrap

**Goal:** No Bootstrap CSS on any layout.  
**Date:** 2026-07-11  
**Status:** Done.

---

## What changed

### Layouts

| Layout | Before | After |
|--------|--------|-------|
| `frontend.blade.php` | `bootstrap_lawyers.min.css` + `style_lawyer` | Vite grid/utilities only + **keep** `style_lawyer` (ftco/theme) |
| `landing.blade.php` | BS + `style_lawyer` | Vite only (landing page is self-contained) |
| `frontend_appointment.blade.php` | Already no BS (Phase 7) + footer shim | Vite grid; shim removed |
| `stripe` / `payment-thankyou` / `contact-thankyou` | CDN Bootstrap 5.3.8 | Page-local minimal CSS |

### Vite CSS

`frontend.css` now imports:

- `components/admin-grid.css` (+ `col-lg-2`, `col-lg-9`, `no-gutters`)
- `components/admin-utilities.css` (alerts, flex, spacing, …)
- `components/frontend-utilities.css` (**new** — BS4 `mr-*`, `mb-5`, `bg-light`, `img-fluid`, …)
- Existing `buttons` / `forms` / `cards`

### Retired

- Layout links to `bootstrap_lawyers.min.css`
- CDN Bootstrap on payment/thank-you pages
- `footer-grid-shim.css` Vite entry (grid covered by `frontend.css`)

Static file may remain under `public/css/` as archive; it is **not** linked.

## Review fixes (post Phase 8 / cross-phase audit)

| Issue | Fix |
|-------|-----|
| `style_lawyer` loaded after Vite → `#002247` buttons overrode brand | Load `style_lawyer` **before** Vite on frontend + appointment |
| Login pulled Flatpickr via `vendor-admin.js` | New `vendor-admin-login.js` (Lucide only) |
| Missing Phase 7 doc | Added `docs/phase-7-booking-off-jquery.md` |
| Appointment layout lacked `@yield('scripts')` | Added `@stack` + `@yield` |
| Dead scaffolds / footer-grid-shim | Moved to `resources/js/_archive` / `resources/css/_archive` |

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| No `bootstrap_lawyers` on layouts | Done |
| No Bootstrap CDN on stripe/thank-you | Done |
| Public blades keep `row`/`col-*`/`form-control` via Vite | Done |
| `style_lawyer` only where theme still needed | Done (frontend + booking) |

---

## Intentional leftover

**`style_lawyer.min.css`** still ships themed Bootstrap-era rules (`.row`, `.btn`, ftco/owl/hero). It stays on marketing + booking for brand/theme. Vite owns the framework classes first; theme cascade may override `.btn`/`.form-control`.

True “strip BS out of style_lawyer” is a follow-up (extract ftco-only CSS).

---

## QA checklist

- [ ] Home: hero, service grids, footer columns (md/lg)
- [ ] Blog / case listings
- [ ] Contact + floating contact form
- [ ] CMS practice-area pages
- [ ] Book appointment (footer + form)
- [ ] Divorce landing (no style_lawyer)
- [ ] Stripe payment + thank-you pages
- [ ] Network: no `bootstrap_lawyers` / no CDN bootstrap CSS

## Build

```bash
npm run build
```
