# Archived frontend / admin legacy assets

Moved out of the live request path. Do not re-link from layouts.
Run `npm run audit:legacy-js` to ensure these do not creep back into live `public/js/`.

| File | Notes |
|------|-------|
| `scripts.js`, `custom.js`, `custom-form-validation.js` | Admin (unlinked Phase 2) → Vite `admin.js` |
| `admin-confirm.js`, `admin-csp-actions.js` | Duplicates; live copies in `resources/js/` |
| `jquery-3.7.1.min.js`, `jquery.easing.1.3.min.js` | Phase 9 — removed from live path |
| `bootstrap.bundle.min.js` | Phase 4 unlinked; Phase 9 archived |
| `jquery.stellar.min.js`, `jquery.waypoints.min.js` | Phase 4 → AOS / parallax |
| `scrollax.min.js`, `jquery.animateNumber.min.js` | Phase 1 dead weight (if present) |

`style_lawyer.min.css` remains live for ftco theme (may embed BS-era rules). Stock `bootstrap_lawyers` is archived under `public/css/`.
