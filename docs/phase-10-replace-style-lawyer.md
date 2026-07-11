# Phase 10 — Replace `style_lawyer.min.css`

**Goal:** Remove the 217 KB Bootstrap+FTCO theme file; keep only live theme rules in Vite.  
**Date:** 2026-07-11  
**Status:** Done.

---

## What changed

| Before | After |
|--------|--------|
| `style_lawyer.min.css` (~217 KB, BS4 + FTCO) on frontend + appointment | **Unlinked** |
| Theme rules scattered in minified BS rebuild | `resources/css/theme/theme-ftco.css` imported by `frontend.css` |

### Ported to Vite (`theme-ftco.css`)

- `#ftco-loader` + SVG spinner
- `.hero-wrap` / `.hero-wrap-2` / `.overlay` / `.slider-text` / `.bread` / `.breadcrumbs`
- `.ftco-section` / `.ftco-no-pt` / `.ftco-no-pb` + basic CMS prose
- `.blog-entry` stub, `.img-video`

### Also

- `.min-vh-100` added to `frontend-utilities.css`
- Archived: `public/css/style_lawyer.min.archive.css`
- Audit flags `style_lawyer` if re-linked in blades

### Unchanged (already self-contained)

- Header / footer / home experimental UI / about / contact / booking / landing
- `layout-global.css` + `footer-modern.css` (still static; testimonials Swiper rules stay there)

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| No `style_lawyer` on any layout | Done |
| CMS hero + ftco-section still styled | Done (Vite) |
| `npm run build` + `audit:legacy-js` | Done |

## QA

- [ ] Home (hero, testimonials, footer)
- [ ] CMS practice-area page (hero + content)
- [ ] Blog / case listing wrappers
- [ ] Booking header/footer
- [ ] Loader dismisses
- [ ] Network: no `style_lawyer`
