# Phase 9 — Cleanup

**Goal:** Remove jQuery/Bootstrap packages and static leftovers; prevent creep.  
**Date:** 2026-07-11  
**Status:** Done.

---

## What changed

### npm

- Removed `jquery` from `package.json` / `node_modules`
- `bootstrap` was already removed in Phase 6

### Static files (moved to `public/js/archive/`)

- `jquery-3.7.1.min.js`
- `jquery.easing.1.3.min.js`
- `bootstrap.bundle.min.js`
- Duplicate `admin-confirm.js` / `admin-csp-actions.js` (Vite owns these)

Also archived unused `public/css/bootstrap-social.css`.

### Vite

- No `vendor-jquery` / `vendor-bootstrap` chunk groups (already gone)
- Audit fails if they reappear in `vite.config.js` or build manifest

### Audit script (immigration-style)

```bash
npm run audit:legacy-js
```

Checks:

1. `package.json` — no `jquery` / `bootstrap`
2. Live `public/js/` — no jquery/bootstrap/plugin filenames (archive/ allowed)
3. Live `public/css/` — no stock `bootstrap*.css`
4. Blade views — no jquery/bootstrap asset or CDN links
5. `resources/js` — no `import 'jquery'` / `import 'bootstrap'`
6. Vite manifest + config — no `vendor-jquery` / `vendor-bootstrap`

## Review fixes (cross-phase audit)

| Issue | Fix |
|-------|-----|
| Login still loaded Flatpickr | `vendor-admin-login.js` (Lucide only) |
| Unwired scaffolds on disk | Moved to `resources/js/_archive/` |
| Audit blind spot `bootstrap-social` | Pattern added to `audit-legacy-js.mjs` |

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| No jquery/bootstrap in package.json | Done |
| No live `public/js/jquery*` / `bootstrap.bundle*` | Done |
| No vendor-jquery / vendor-bootstrap chunks | Done |
| `npm run audit:legacy-js` passes | Done |

---

## Intentional leftovers

- `public/js/archive/**` — historical copies only
- `style_lawyer.min.css` — theme (may still contain BS-era CSS rules)
- Live `public/js/{main,footer-animations,analytics-engagement,tinymce-config}.js` — still used

## Build

```bash
npm run build
npm run audit:legacy-js
```
