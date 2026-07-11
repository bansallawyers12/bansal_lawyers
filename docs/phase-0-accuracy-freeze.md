# Phase 0 — Accuracy freeze

**Goal:** Make the current hybrid stack truthful and measurable before moving assets.  
**Date:** 2026-07-11  
**Status:** Layout fixes applied; inventory / QA / bug list below. Capture Lighthouse/network baselines before Phase 1 deletes.

---

## 0.1 Layout bugs — fixed

| Issue | Fix |
|--------|-----|
| Wrong route gates (`practiceareas`, `cms/*`, `archive/*`) | `practice-areas` + `Request::routeIs('cms.slug')` for animate.css and stellar/waypoints/scrollax; DOM fallback in `frontend.js` for `.ftco-animate` / stellar attrs |
| Missing `@yield('scripts')` on `frontend.blade.php` | Added before Meta Pixel (home video modal + other page scripts now run) |
| Landing loaded static `asset('js/main.js')` | Switched to `@vite(['…', 'public/js/main.js'])` |
| Double `vendor-frontend.js` | Layouts `@vite` **only** `frontend.js` + `main.js`; `frontend.js` imports vendor once |
| Appointment layout sync scripts | Vite modules only (no duplicate vendor); dropped unused parallax plugins; **jQuery kept sync** so booking scripts stay safe |

**Review fixes (post–Phase 0 pass)**

- Restored correct-gated parallax scripts **before** Vite `main.js` (defer order). Removing them entirely raced `contentWayPoint` / Stellar init.
- Tightened animate.css gate (removed over-broad `blog*` / `isset($pagedata)` — those pages use AOS or no `fadeIn*` classes).
- `frontend.js`: dynamic scripts use `async=false` (defer is ignored on injected tags); load starts at module eval; detect `.ftco-animate` too.
- `main.js`: use `window.jQuery` (ES module scope has no free `jQuery`); guard missing jQuery; guard missing `$.animateNumber`.
- Appointment: do **not** defer jQuery (booking `@section('scripts')` historically assumes `$` is present).

**Files touched**

- `resources/views/layouts/frontend.blade.php`
- `resources/views/layouts/landing.blade.php`
- `resources/views/layouts/frontend_appointment.blade.php`
- `resources/js/frontend.js`
- `public/js/main.js`

---

## 0.2 Inventory that matters

### Actually live

**Admin** (`layouts/admin.blade.php`)

| Asset | Role |
|--------|------|
| jQuery 3.7.1 | Legacy admin UI / AJAX |
| Bootstrap 4 bundle JS | Modals, collapses, etc. |
| `scripts.js` (partial) | Sidebar / loader / shared admin chrome |
| `custom.js` | Status toggles, deletes, forms (`/admin/update_action`) |
| `custom-form-validation.js` | Form validation |
| TinyMCE | Blog / CMS editors |
| Vite `admin.js` + `vendor-admin.css` / admin CSS | Modern admin stack |
| `components.css` / `custom.css` | Admin theme |

**Frontend** (`frontend` / `landing` / `frontend_appointment`)

| Asset | Role |
|--------|------|
| BS4 CSS theme (`bootstrap_lawyers.min.css`, `style_lawyer.min.css`) | Layout / theme |
| jQuery + easing | Booking + residual `main.js` |
| Vite `frontend.js` → `vendor-frontend.js` | AOS, Swiper, Lucide |
| Vite `public/js/main.js` | Loader, residual theme JS, Stellar init when present |
| `footer-animations.js`, `analytics-engagement.js` | Footer / analytics |
| Booking page `@section('scripts')` | Multi-step appointment jQuery |
| Turnstile / gtag / Meta Pixel | Forms & tracking |

### Dead / near-dead (verify in QA, delete in Phase 1)

| Asset | Evidence | Phase 1 action |
|--------|----------|----------------|
| Scrollax | Only loaded if `[data-scrollax]` (none found in views) | Delete after confirm |
| `jquery.animateNumber.min.js` | Still in frontend layout; counters rare/absent | Confirm no `.number` counters → delete |
| `google-map.min.js` | DOM-gated on `#map` / `#google-map` | Keep gate; prune if maps unused |
| Most of `main.js` | Targets `.ftco_navbar`, `#image_logo`, owl, etc. — header is vanilla | Slim or replace |
| Stellar + error patches | `practiceareas.blade.php` **and** `Frontend/cms/index.blade.php` use `data-stellar-background-ratio` | Decide: keep Stellar or CSS parallax, then drop patches |
| `data-bootstrap-switch` | Markup still present; modern toggles don’t need plugin | Remove attr + unused plugin |
| `legacy-scripts-replacement.js` | Wrong selectors/endpoints — **do not activate** | Rewrite or delete in migration |
| Unused Vite scaffolds (`app.js` / `app.css` if unused) | Confirm no layout references | Drop from `vite.config.js` |

---

## 0.3 QA matrix (must pass before Phase 1)

### Admin

| Check | Steps | Pass? |
|--------|--------|-------|
| Blog status toggle | Admin → Blog → toggle status; row stays; flash OK | ☐ |
| CMS page status toggle | Admin → CMS → toggle; row stays (override present) | ☐ |
| Blog category status toggle | Admin → Blog categories → toggle; **expect row removal bug** until migration fix | ☐ document |
| Recent case status toggle | Admin → Recent cases → toggle; **expect row removal bug** until migration fix | ☐ document |
| Blog/CMS create-edit | TinyMCE loads; save works | ☐ |

### Frontend

| Check | Steps | Pass? |
|--------|--------|-------|
| Home Swiper | `/` testimonials carousel advances | ☐ |
| About AOS | `/about` fade-ups fire (desktop) | ☐ |
| Contact AOS | `/contact` animations | ☐ |
| Practice areas | `/practice-areas` hero; Stellar loads only if attrs present | ☐ |
| CMS slug hero | e.g. `/migration-law` or `/family-law` — hero + content | ☐ |
| Booking flow | `/book-an-appointment` multi-step + Turnstile | ☐ |
| Landing | Divorce/family landing — Vite `main.js`, page scripts | ☐ |
| Home video modal | Open/close modal (needs `@yield('scripts')`) | ☐ |

### Login

| Check | Steps | Pass? |
|--------|--------|-------|
| Admin login | `/admin/login` — Turnstile + submit | ☐ |
| `scripts.js` / `custom.js` | Confirm unnecessary on login (layout still loads them) — candidate to drop in Phase 1 | ☐ |

### Baseline metrics (capture before Phase 1)

Record date, URL, device, and tool (Chrome DevTools Network + Lighthouse mobile).

| Page | LCP | TBT | Transfer (JS) | Notes |
|------|-----|-----|---------------|-------|
| `/` | | | | |
| `/about` | | | | |
| `/practice-areas` | | | | |
| `/book-an-appointment` | | | | |
| Admin dashboard | | | | |

Save HAR or Lighthouse JSON under `docs/baselines/` if available.

---

## 0.4 Known bugs — fix during migration (do not ignore)

### 1. `custom.js` `updateStatus` removes the row

```317:340:public/js/custom.js
	function updateStatus( id, current_status, table,col ) {
		// ...
					$('#id_'+id).remove();
```

- **Symptom:** Status toggle succeeds, then the table row disappears.
- **Mitigated on:** Blog index, CMS index (local `window.updateStatus` overrides).
- **Still broken on:** Blog category, recent cases (and any list without an override).
- **Migration fix:** Update UI state / switch only; never `.remove()` on status toggle. Reserve remove for delete.

### 2. Layout inline jQuery targets dead header DOM

In `frontend.blade.php`, scroll/logo handlers use `#image_logo` and `.ftco_navbar`.

- **Reality:** `Elements/Frontend/header.blade.php` is vanilla sticky nav — no those IDs/classes.
- **Effect:** Dead code + wasted jQuery work on every page.
- **Migration fix:** Remove block, or reimplement scroll styling against the current header if needed.

### 3. `legacy-scripts-replacement.js` — wrong mental model

- Targets `.main-sidebar` / AdminLTE-style DOM (not this admin chrome).
- Posts to `/admin/update-status` (real endpoint is `/admin/update_action` via `custom.js`).
- **Do not “activate” blindly** — rewrite against real markup/endpoints or delete.

### 4. Stellar error surface

- Global handlers in layout + `main.js` suppress `particles is undefined`.
- After Stellar keep/drop decision, remove patches with the plugin.

### 5. Login still loads admin legacy JS

- `admin-login.blade.php` loads `scripts.js` + `custom.js` with no clear login dependency.
- Confirm in QA, then drop to shrink login surface.

---

## Exit criteria

- [x] Layouts consistent (frontend / landing / appointment Vite + defer pattern)
- [x] Route gates corrected or replaced with CMS/DOM detection
- [ ] Baseline Lighthouse/network captured (fill table above)
- [x] Bug list written (this doc)

**Next:** Phase 1 — delete verified-dead assets; fix `updateStatus` row-removal; slim `main.js` / header jQuery.  
**Update:** Phase 1 deletions applied — see `docs/phase-1-delete-dead-weight.md`. `updateStatus` row-removal remains a known migration bug.
