# Archived frontend / admin legacy assets (Phase 4)

Moved out of the live request path. Do not re-link from layouts.

| File | Was used by | Replaced by |
|------|-------------|-------------|
| `scripts.js` | Admin (unlinked Phase 2) | `resources/js/admin.js` + modules |
| `custom.js` | Admin (unlinked Phase 2) | `admin-crud.js` etc. |
| `custom-form-validation.js` | Admin (unlinked Phase 2) | `admin-custom-validate.js` |
| `jquery.stellar.min.js` | Frontend practice-areas / CMS | Vanilla `data-parallax-bg` in `frontend.js` |
| `jquery.waypoints.min.js` | Frontend ftco-animate | AOS (`data-aos`) |
| `../css/archive/animate.min.css` | Frontend fadeIn* classes | AOS CSS via Vite |

`bootstrap.bundle.min.js` remains under `public/js/` but is **not linked** by frontend / landing / appointment layouts (Phase 4). Admin uses npm Bootstrap 5 via Vite.
