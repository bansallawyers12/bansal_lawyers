# Phase 7 — Booking off jQuery

**Goal:** Appointment booking works without jQuery / Bootstrap JS.  
**Date:** 2026-07-11  
**Status:** Done (documented after the fact; code landed with Phase 4–8 work).

---

## What changed

### Layout (`frontend_appointment.blade.php`)

- No `jquery` / `bootstrap.bundle` / `bootstrap_lawyers`
- Vite: `frontend.css` + `vendor-frontend.css` (grid/utilities)
- Keeps `style_lawyer` for header/footer theme (loaded **before** Vite so brand utilities win)
- Page scripts via `@stack('scripts')` / `@yield('scripts')`

### Booking module

| Entry | Role |
|-------|------|
| `resources/js/appointment-form/index.js` | Alpine + Axios; `bookingForm` component |
| `resources/css/pages/appointment-form.css` | Booking UI |
| `bookappointment.blade.php` | `@push('head')` → `@vite` both |

### Exit criteria

| Criterion | Status |
|-----------|--------|
| No sync jQuery on appointment layout | Done |
| Booking form Alpine + Axios | Done |
| No Bootstrap CSS on appointment layout | Done (Phase 8) |

## QA

- [ ] Multi-step booking form
- [ ] Turnstile / CSRF
- [ ] Footer columns on booking page
- [ ] Network: no jquery / bootstrap
