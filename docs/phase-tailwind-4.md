# Tailwind 4 upgrade

**Date:** 2026-07-11  
**Status:** Done (T0–T4).

## What changed

| Item | Before | After |
|------|--------|-------|
| `tailwindcss` | ^3.1 (unused in live CSS) | ^4.3 |
| Plugin | PostCSS `tailwindcss` + autoprefixer | `@tailwindcss/vite` |
| Live CSS | Component CSS only | Tailwind 4 + component CSS |
| `app.css` | Missing | Not restored — wired into `frontend.css` / `admin.css` |
| `postcss.config.js` | v3 plugins | Empty (immigration-style) |
| `admin-login.css` | Slim tokens only | Unchanged (no Tailwind import) |

## Coexistence

- Named components (`.btn`, `.form-control`, `.card`, grid) stay in Vite component CSS and load **after** Tailwind so they win over Preflight.
- `style_lawyer.min.css` still linked on frontend/appointment.
- Use Tailwind utilities for **new** UI; do not mass-convert blades in this upgrade.

## Brand theme (`tailwind.config.js`)

- `fontFamily.sans` → Poppins
- `lawyer-blue` → `#1B4D89`
- `lawyer-orange` → `#F96D00`
- Forms via `@plugin "@tailwindcss/forms"` in CSS (not JS plugins array)

## Verify

```bash
npm run build
npm run audit:legacy-js
```

Smoke: home, admin list/form, booking, admin login.
