# Tailwind 4 upgrade

**Date:** 2026-07-11  
**Status:** Done (T0–T4).

## What changed

| Item | Before | After |
|------|--------|-------|
| `tailwindcss` | ^3.1 (unused in live CSS) | ^4.3 |
| Plugin | PostCSS `tailwindcss` + autoprefixer | `@tailwindcss/vite` |
| Live CSS | Component CSS only | Tailwind 4 + component CSS |
| `app.css` | Missing | Not restored — shared `tailwind-setup.css` instead |
| `postcss.config.js` | v3 plugins | Empty (immigration-style) |
| `admin-login.css` | Slim tokens only | Unchanged (no Tailwind import) |

## Coexistence

- Named components (`.btn`, `.form-control`, `.card`, grid) stay in Vite component CSS and load **after** Tailwind so they win over Preflight.
- `style_lawyer.min.css` still linked on frontend/appointment.
- Use Tailwind utilities for **new** UI; do not mass-convert blades in this upgrade.
- All `@import`s come before style rules (invalid CSS if `[x-cloak]` sits between imports).

## Brand theme

- Shared: `resources/css/tailwind-setup.css` (`@import "tailwindcss"`, forms plugin, `@config`, `@theme`)
- `@theme`: `--color-lawyer-blue`, `--color-lawyer-orange`, `--font-sans` (Poppins)
- `tailwind.config.js` still extends Poppins + brand colors for `@config` compatibility
- Forms via `@plugin "@tailwindcss/forms"` (not JS plugins array)

## Verify

```bash
npm run build
npm run audit:legacy-js
```

Smoke: home, admin list/form, booking, admin login.
