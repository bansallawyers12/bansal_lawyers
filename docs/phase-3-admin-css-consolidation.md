# Phase 3 — Admin CSS consolidation

**Goal:** End the triple CSS war (Vite `admin.css` + Stisla `components.css` + `custom.css`).  
**Date:** 2026-07-11  
**Status:** Implemented (rebuild required after pull).

---

## What changed

### Authority (single owners)

| Concern | Owner |
|---------|--------|
| Design tokens | `resources/css/variables.css` + `admin-tokens.css` (`--primary-color` aliases) |
| `.btn` / `.btn-primary` | `resources/css/components/buttons.css` (brand `#1B4D89`) |
| `.card` | `resources/css/components/cards.css` |
| `.form-control` | `resources/css/components/forms.css` |
| Shell / sidebar margin / loaders / a11y | `resources/css/components/admin-shell.css` |
| Slim legacy keepers | `resources/css/components/admin-legacy.css` |

### Layouts

| Before | After |
|--------|--------|
| Vite admin + **components.css (~159KB)** + **custom.css (~60KB)** + large inline shell/btn overrides | Vite `admin.css` + `vendor-admin.css` only |
| Login: vendor-admin + bootstrap-social + Stisla + custom + duplicate `:root` | Vite `admin.css` + `vendor-admin.css` + fonts; login layout CSS uses shared tokens |
| Layout inline `.btn-primary` gradient `#3b82f6` fighting brand | Removed — Vite buttons win |

### Peeled / archived (not deleted from disk)

| File | Status |
|------|--------|
| `public/css/components.css` | Stub; archive `components.stisla-archive.css` |
| `public/css/custom.css` | Stub; archive `custom.stisla-archive.css` |
| `public/css/bootstrap-social.css` | Unlinked from login (unused) |
| `resources/css/layouts/admin.css` | Not imported (dead `.admin-sidebar` API) |

### `scripts.js` theme forcing

- Startup `body.addClass(light / light-sidebar / theme-white)` **disabled**
- Theme picker / restore handlers **no-op**
- File still **not loaded** by admin layout; changes prevent regressions if re-linked

### Tokens

- Login `:root` duplicates removed; uses `--primary-color` etc. from `admin-tokens.css`
- OS `prefers-color-scheme: dark` gray inversion removed (admin is light-only)

---

## Weight drop (linked CSS, approximate)

| Asset | Before (linked) | After (linked) |
|-------|-----------------|----------------|
| `components.css` | ~159 KB | 0 (unlinked) |
| `custom.css` | ~60 KB | 0 (unlinked) |
| `bootstrap-social.css` (login) | ~28 KB | 0 (unlinked) |
| Layout inline shell/btn | ~4 KB | 0 (moved to Vite) |
| **Total removed from request** | | **~250 KB** |

Vite `admin-*.css` grows slightly (shell + legacy keepers + tokens) — still far below Stisla pack.

---

## Intentionally deferred

- Consolidating ~12k lines of per-page inline `modern-*` CSS into a shared Vite module (follow-up)
- Slim login-only CSS entry (still loads full `vendor-admin` for Lucide/BS)

---

## QA checklist

- [ ] Admin dashboard / sidebar collapse / mobile open
- [ ] Blog / CMS / appointments list + forms (cards, buttons, Tom Select)
- [ ] Profile upload circle
- [ ] Validation `.custom-error` display
- [ ] Admin login (tokens, no Stisla purple, Turnstile)
- [ ] Confirm dialog + modals
- [ ] No `theme-white` / `light-sidebar` on `<body>`

## Build

```bash
npm run build
```
