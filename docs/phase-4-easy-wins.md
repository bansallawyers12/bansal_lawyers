# Phase 4 — Easy wins (marketing JS)

**Goal:** Marketing pages load without Bootstrap JS or jQuery plugins.  
**Date:** 2026-07-11  
**Status:** Implemented (rebuild required after pull).

---

## What changed

### Layouts

| Layout | Before | After |
|--------|--------|--------|
| `frontend.blade.php` | jQuery + BS bundle + (gated) Stellar/Waypoints + animate.css + Vite | Vite `frontend.js` + slim `main.js` only |
| `landing.blade.php` | jQuery + BS bundle + Vite | Vite only |
| `frontend_appointment.blade.php` | sync jQuery + BS bundle + Vite | **sync jQuery kept** (booking `$` scripts) + Vite; **BS JS dropped** |

### Heroes (practice-areas + CMS)

- `data-stellar-background-ratio` → `data-parallax-bg` (vanilla scroll in `frontend.js`)
- `ftco-animate` → `data-aos="fade-up"`
- Removed `animate.min.css` gate

### `main.js`

- Vanilla loader dismiss only (no jQuery / Stellar / Waypoints)

### Archived (`public/js/archive/`, `public/css/archive/`)

- `scripts.js`, `custom.js`, `custom-form-validation.js`
- `jquery.stellar.min.js`, `jquery.waypoints.min.js`
- `animate.min.css`

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| No `bootstrap.bundle.min.js` on frontend / landing / appointment | Done |
| No jQuery plugins (Stellar / Waypoints) on marketing | Done |
| No jQuery on frontend / landing | Done |
| Booking still has jQuery (large inline `$` scripts) | Intentional follow-up |
| AOS / IO replace animate + waypoints | Done (AOS + existing practice-areas IO for `.fade-in`) |

---

## QA checklist

- [ ] Home: Swiper testimony, AOS sections, mobile nav toggle
- [ ] Practice areas: hero fade + parallax (desktop), card IO animations
- [ ] One CMS slug hero (e.g. `/family-law` or `/about` CMS)
- [ ] Landing page (divorce family) loads without `$` / BS JS errors
- [ ] Book appointment: tabs / validation still work (jQuery present)
- [ ] Network: no `bootstrap.bundle`, `jquery.stellar`, `jquery.waypoints`, `animate.min` on marketing

## Review fixes (post Phase 4)

- **Invisible CMS content:** `style_lawyer` still has `.ftco-animate { opacity:0; visibility:hidden }`. Two CMS pages (`about`, `case` content) still contain that class. `frontend.js` now migrates leftovers to `data-aos` before `AOS.init`; `frontend.css` adds a visibility safety net.
- **Mobile nav:** outside-click handler null-guards `mobileMenu` / `mobileToggle` (avoids throw if either is missing).
