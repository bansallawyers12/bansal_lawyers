# Phase 6 — Admin CSS off Bootstrap

**Goal:** `npm bootstrap` unused by admin.  
**Date:** 2026-07-11  
**Status:** Done.

---

## What changed

### CSS ownership (Vite)

| Concern | Source |
|---------|--------|
| `.btn` / `.btn-*` | `components/buttons.css` (+ info/light/dark) |
| `.form-control` / `.form-select` | `components/forms.css` |
| `.card` | `components/cards.css` |
| `.row` / `.col-*` | `components/admin-grid.css` |
| Modals | `components/admin-modal.css` |
| Alerts, badges, flex helpers | `components/admin-utilities.css` |
| Shell / loaders | `components/admin-shell.css` |
| Tom Select tweaks | `components/admin-legacy.css` |

Blades keep familiar class names (`row`, `form-control`, `btn-primary`, …); styles come from Vite, not Bootstrap.

### Vendor CSS

- `vendor-admin.css` — **no** Bootstrap; Lucide + Flatpickr + **Tom Select default** theme (not `bootstrap5`)
- `admin-login.css` — slim entry: variables + tokens + Lucide only

### JS

- `admin-bootstrap.js` — vanilla `showAdminModal` / `hideAdminModal` (no `import 'bootstrap'`)
- Calendar / appointments assign modals use those helpers only (no `window.bootstrap.Modal`)
- Dismiss still accepts `data-bs-dismiss` / `data-admin-dismiss` for existing markup

### Package

- Removed `bootstrap` from `package.json` / `node_modules`
- Vite chunk groups no longer include `vendor-bootstrap`

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| Admin CSS without Bootstrap import | Done |
| Tom Select off bootstrap5 theme | Done |
| Slim login CSS entry | Done |
| Vanilla modals (no BS Modal JS) | Done |
| `npm bootstrap` unused by admin | Done |
| Build has no `vendor-bootstrap` chunk | Done |

---

## Intentional leftovers

- Marketing layouts still use static `bootstrap_lawyers.min.css` (BS4 theme files — not npm)
- Booking frontend may still use jQuery (Phase 5 scope was admin only)
- Stripe / thank-you pages may load Bootstrap from CDN (out of admin)

---

## QA checklist

- [ ] Admin login (slim CSS + Lucide)
- [ ] Dashboard grid / cards / forms look correct
- [ ] Alerts dismiss
- [ ] Appointments list: assign modal open/close
- [ ] Calendar: event modal open/close, Escape, backdrop
- [ ] Tom Select fields match form-control styling
- [ ] Network: no `bootstrap` / `vendor-bootstrap` on admin pages

## Build

```bash
npm run build
```
