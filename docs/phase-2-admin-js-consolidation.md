# Phase 2 — Admin JS consolidation

**Goal:** One Vite-owned admin JS path; jQuery still allowed temporarily.  
**Date:** 2026-07-11  
**Status:** Implemented (rebuild required after pull).

---

## What changed

### Layout (`admin.blade.php`)

| Before | After |
|--------|--------|
| Static jQuery + **BS4.3.1** `bootstrap.bundle.min.js` | Sync jQuery 3.7.1 only (for inline `@section('scripts')`); **Bootstrap 5** from npm via `admin.js` |
| `scripts.js`, `custom.js`, `custom-form-validation.js`, `admin-confirm.js`, `admin-csp-actions.js` | All folded into `@vite(['resources/js/admin.js'])` |
| Duplicate layout Tom Select helpers | `window.initTomSelect` / `initDynamicTomSelects` owned by `admin.js` |
| TinyMCE static | **Unchanged** (self-hosted + `copy-tinymce`) |

### Login (`admin-login.blade.php`)

- Removed jQuery + BS4 entirely (Turnstile + Lucide via `vendor-admin.js` only).

### New / ported Vite modules

| Module | Role |
|--------|------|
| `admin-bootstrap.js` | npm Bootstrap 5; `showAdminModal` / `hideAdminModal`; jQuery `.modal()` shim; tooltip/popover; `data-dismiss` → `data-bs-dismiss` bridge |
| `admin-confirm.js` | Confirm dialog |
| `admin-csp-actions.js` | CSP delegated clicks |
| `admin-custom-validate.js` | **Single** `window.customValidate` (`data-valid` contract) |
| `admin-crud.js` | CRUD + **status toggles keep row** (fixes blogcategory/recent_case) |
| `admin-ui.js` | Loader, fullscreen, min-height (live `scripts.js` only) |

### Single owners

| Concern | Owner |
|---------|--------|
| Tom Select | `admin.js` → `modernSelect` / `initTomSelect` (tom-select **bundled**, no longer Vite `external`) |
| Flatpickr | `flatpickr-init.js` only (+ `.followup_date`) |
| customValidate | `admin-custom-validate.js` |
| Status toggles | `admin-crud.js` `updateStatus` (no `$('#id_').remove()`) |
| Sidebar | `initAdminSidebarToggle` in `admin.js` |

### Appointments

- Calendar / list modals use `showAdminModal` / `hideAdminModal` (BS5).
- Close button uses `data-bs-dismiss="modal"`.

---

## Intentionally kept (transition)

- **Sync `public/js/jquery-3.7.1.min.js`** on admin layout — many `@section('scripts')` call `$` at parse time; ES modules load too late. Same version as npm. Remove when page scripts are deferred/modules.
- Page-level blog/CMS **`window.updateStatus` overrides only** (no local `.change-status` bindings — those double-fired with `admin-crud` delegated handlers).
- Static TinyMCE under `public/assets/tinymce/`.
- Legacy `public/js/scripts.js` / `custom.js` files remain on disk but are **not loaded** by admin layout.

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| Admin layouts: `@vite` + TinyMCE (+ sync jQuery transition) | Done |
| No static **BS4** bundle on admin | Done |
| Status toggles consistent (keep row) | Done in `admin-crud.js` |
| customValidate one implementation | Done |
| Full removal of sync jQuery | Follow-up (page script migration) |

**Note:** Sync `jquery-3.7.1.min.js` remains on the admin layout because many `@section('scripts')` invoke `$` at parse time; Vite modules are deferred. BS4 is fully gone; BS5 ships in the admin Vite graph (`vendor-bootstrap-*.js`).

## QA checklist

- [ ] Admin login (no jQuery errors)
- [ ] Dashboard / sidebar toggle / fullscreen / loader
- [ ] Blog + CMS status toggles (row stays)
- [ ] Blog category + recent case status toggles (row stays — regression fix)
- [ ] Create/edit forms with `data-custom-validate` + TinyMCE
- [ ] Tom Select on forms / dynamic taskview HTML
- [ ] Flatpickr date fields
- [ ] Appointments list assign modal
- [ ] Appointments calendar event modal open/close / ESC

## Build

```bash
npm run build
```
