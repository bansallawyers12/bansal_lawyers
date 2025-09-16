## Project Naming Guide (Views, Layouts, Partials)

This guide defines naming conventions for Blade views and related folders. It is documentation-only and does not change code by itself. Use this as the reference for future files and for refactors.

### Directories and Files
- Use lowercase and kebab-case for directories and files.
  - Examples: `admin/`, `frontend/`, `blog-categories/`, `recent-cases/`, `booking-blocks/`.
- Group pages by resource/domain.
  - Examples:
    - `blog/index.blade.php`, `blog/show.blade.php`
    - `services/index.blade.php`, `services/show.blade.php`
    - `cases/index.blade.php`, `cases/show.blade.php` (or `case-studies/...` if business language prefers)
    - `practice-areas/index.blade.php`, `practice-areas/show.blade.php`
    - `search/results.blade.php`
    - `contact/index.blade.php`

### Layouts
- Preferred primary layouts:
  - `layouts.frontend`
  - `layouts.admin`
- Authentication layouts:
  - Prefer a unified `layouts.auth` when possible.
  - If materially different, use `layouts.auth-admin` and `layouts.auth-agent`.
- Avoid proliferating specialized layouts; use sections/stacks for page-specific needs instead of creating new base layouts (e.g., avoid `layouts.frontend_appointment` by using stacks).

### Partials vs Components
- Partials are reusable includes without their own state/props.
  - Place under `resources/views/partials/...` and include with `@include('partials.path')`.
  - Examples: `partials/flash-message.blade.php`, `partials/admin/header.blade.php`, `partials/frontend/footer.blade.php`.
- Components are reusable UI with attributes/slots.
  - Place Blade components under `resources/views/components/...` and consume with `<x-...>`.
  - Example: `<x-unified-contact-form ... />` from `components/unified-contact-form.blade.php`.

### Includes Path Style
- Always use absolute dot-notation in includes.
  - ✅ `@include('partials.flash-message')`
  - ❌ `@include('../Elements/flash-message')`
  - ❌ `@include('/Admin/blogcategory/subCategoryList-option')`
- Avoid relative paths (`../`) and leading slashes in view includes.

### Sections and Stacks
- Standardize on the following:
  - Title: `@section('title', 'Page Title')`
  - Main content: `@section('content') ... @endsection`
  - Meta/SEO tags: `@push('meta') ... @endpush`
  - Page scripts: `@push('scripts') ... @endpush`
- Layouts should render:
  - In `<head>`: `@stack('meta')`
  - Before `</body>`: `@stack('scripts')`
- Avoid using multiple ad-hoc section names for the same purpose (e.g., prefer `@push('meta')` over custom sections like `seoinfo`, `head`, or discrete `meta_title`/`meta_keyword`/`meta_description`).

### Pluralization and Hyphenation
- Use correct plural nouns and hyphenate multi-word names.
  - ✅ `blog-categories/`, `recent-cases/`, `booking-blocks/`, `disabled-dates/`
  - ❌ `blogcategory/`, `recent_case/`, `bookingblocks/`, `appointmentdisabledate/`

### Experimental/Backup Files
- Do not keep experimental or backup variants alongside canonical views.
- If needed temporarily, place them in `resources/views/archive/YYYY-MM/` (or `archive/legacy/`) with a short README.

### Migration Strategy (When Refactoring)
1. Update includes to absolute dot-notation; remove relative includes.
2. Standardize sections/stacks; support both `@section('scripts')` and `@push('scripts')` during transition in layouts.
3. Archive experimental/backup files.
4. Rename directories/files to kebab-case, resourceful structure, and update all references (`view(...)`, `@include(...)`, components, tests).
5. Consider temporary view namespace aliases if a staged rollout is necessary.

---
Adhering to this guide will improve discoverability, reduce merge conflicts, and make incremental refactors safer.


