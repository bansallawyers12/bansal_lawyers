# Phase 5 — Admin JS off jQuery

**Goal:** Admin works with no jQuery on the page.  
**Date:** 2026-07-11  
**Status:** Implemented (rebuild required after pull).

---

## What changed

### Core modules (Vite)

| Module | Change |
|--------|--------|
| `admin-http.js` | **New** — Axios POST as `application/x-www-form-urlencoded` + loader/DOM helpers (`window.adminHttp`) |
| `admin-crud.js` | Vanilla + `adminHttp` (status/delete/archive/approve/…) |
| `admin-custom-validate.js` | Vanilla `data-valid` walker (same API) |
| `admin-ui.js` | Vanilla loader / min-height / dismiss / fullscreen |
| `admin-bootstrap.js` | BS5 `showAdminModal` / `hideAdminModal` only — **jQuery `.modal` shim removed** |
| `admin.js` | **No** `import 'jquery'`; wires http + above modules |

### Layout

- Removed sync `public/js/jquery-3.7.1.min.js` from `admin.blade.php`
- Build no longer emits `vendor-jquery-*.js` for admin (Axios chunk instead)

### Blade scripts converted

| Page | Notes |
|------|--------|
| appointments/index + calender | Delegation + `adminHttp` + `showAdminModal` |
| blog/index + cms_page/index | Overrides `updateStatus` / `deleteAction` with flash UI |
| bookingblocks/index | `deleteSlotAction` → `adminHttp` |
| admin_users/index | `updateAction` / `archiveAction` → `adminHttp` |
| my_profile, blog/create, recent_case/create | `.if_image` vanilla |

Modals stay **Bootstrap 5** (not Tailwind `modal-utils`).

---

## Exit criteria

| Criterion | Status |
|-----------|--------|
| No sync jQuery script on admin layout | Done |
| No jQuery import in `admin.js` | Done |
| CRUD + customValidate without `$` | Done |
| Appointments / blog / CMS / bookingblocks without `$` | Done |
| Admin build without vendor-jquery chunk | Done |

---

## QA checklist

- [ ] Admin login (unchanged — already no jQuery)
- [ ] Dashboard / sidebar / fullscreen / page loader
- [ ] Blog + CMS status toggle + delete (flash messages)
- [ ] Blog category / recent case status (default CRUD)
- [ ] Forms with `data-custom-validate` + TinyMCE
- [ ] Appointments list: assignee modal, comment, status, priority
- [ ] Appointments calendar: event modal open/close, follow-up, status
- [ ] Booking blocks delete slot
- [ ] Admin users status / archive
- [ ] Network tab: no `jquery-*.js` on admin pages

## Build

```bash
npm run build
```
