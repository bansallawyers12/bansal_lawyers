# Unused JavaScript Files - Review Report

This document lists JavaScript files that are not needed and can be safely removed from the project.

## Summary
- **Total unused files in `public/js/`**: 15 files
- **Total unused files in `resources/js/`**: 2 files
- **Total size savings**: Estimated (files need to be checked for actual sizes)

---

## Files in `public/js/` - NOT NEEDED

### Old Bundle Files (Replaced by Vite)
These files are old bundled versions that have been replaced by the modern Vite build system:

1. **`admin-bundle.min.js`**
   - Status: ❌ Not used
   - Reason: Replaced by Vite build (`resources/js/admin.js`)
   - Safe to delete: ✅ Yes

2. **`admintheme.min.js`**
   - Status: ❌ Not used
   - Reason: Replaced by Vite build (`resources/js/admin.js`)
   - Safe to delete: ✅ Yes

3. **`frontend-bundle.min.js`**
   - Status: ❌ Not used
   - Reason: Replaced by Vite build (`resources/js/frontend.js`)
   - Safe to delete: ✅ Yes

4. **`app.js`**
   - Status: ❌ Not used
   - Reason: Replaced by Vite build (`resources/js/app.js`)
   - Safe to delete: ✅ Yes

5. **`app.min.js`**
   - Status: ⚠️ Referenced but likely not needed
   - Reason: Referenced in `resources/js/admin.js` line 85, but this appears to be legacy code. The function that loads it may not be called, or it may be redundant.
   - Safe to delete: ⚠️ Check first - verify if `loadExternalAdminScripts()` is actually being called with needed libraries

6. **`main.min.js`**
   - Status: ❌ Not used
   - Reason: Duplicate of `main.js` (which is actively used in layouts)
   - Safe to delete: ✅ Yes

7. **`fullcalendar.min.js`**
   - Status: ❌ Not used
   - Reason: Replaced by Vite build using `@fullcalendar/core` npm package (`resources/js/admin-calendar-v6.js`)
   - Safe to delete: ✅ Yes

### Unused Utility Files
These files are not referenced anywhere in the codebase:

8. **`dashboard.js`**
   - Status: ❌ Not used
   - Reason: No references found in views or other JS files
   - Safe to delete: ✅ Yes

9. **`dashboard2.js`**
   - Status: ❌ Not used
   - Reason: No references found in views or other JS files
   - Safe to delete: ✅ Yes

10. **`common.js`**
    - Status: ❌ Not used
    - Reason: No references found in views or other JS files
    - Safe to delete: ✅ Yes

11. **`custom-popover.js`**
    - Status: ❌ Not used
    - Reason: No references found in views or other JS files
    - Safe to delete: ✅ Yes

12. **`fileupload.js`**
    - Status: ❌ Not used
    - Reason: No references found in views or other JS files
    - Safe to delete: ✅ Yes

13. **`agent-custom-form-validation.js`**
    - Status: ❌ Not used
    - Reason: No references found in views or other JS files. Only `custom-form-validation.js` is used.
    - Safe to delete: ✅ Yes

14. **`user-preference.js`**
    - Status: ❌ Not used
    - Reason: No references found in views or other JS files
    - Safe to delete: ✅ Yes

15. **`user-sessions.js`**
    - Status: ❌ Not used
    - Reason: No references found in views or other JS files
    - Safe to delete: ✅ Yes

---

## Files in `resources/js/` - NOT NEEDED

1. **`admin-calendar.js`**
   - Status: ❌ Not used
   - Reason: Duplicate of `admin-calendar-v6.js` which is the one registered in `vite.config.js` (line 19). This file is not imported or referenced anywhere.
   - Safe to delete: ✅ Yes

2. **`app-simple.js`**
   - Status: ❌ Not used
   - Reason: Not registered in `vite.config.js` and not referenced in any views. Appears to be a fallback/test file.
   - Safe to delete: ✅ Yes

---

## Files in `public/js/vendor/` - POTENTIALLY UNUSED

These files are mentioned in comments but may not be actively loaded:

1. **`vendor/jquery.nicescroll.min.js`**
   - Status: ⚠️ Mentioned but not loaded
   - Reason: Comment in `resources/js/vendor-admin.js` says it's loaded from `public/js/vendor/`, but no actual `<script>` tag found in layouts. Comment in `admin.blade.php` says "NiceScroll removed - causing CORS/integrity errors".
   - Safe to delete: ⚠️ Verify first - check if any legacy code still references it

2. **`vendor/sticky-kit.min.js`**
   - Status: ⚠️ Mentioned but not loaded
   - Reason: Comment in `resources/js/vendor-admin.js` says it's loaded from `public/js/vendor/`, but no actual `<script>` tag found in layouts. Comment in `admin.blade.php` says "Sticky Kit removed - not used".
   - Safe to delete: ⚠️ Verify first - check if any legacy code still references it

---

## Files in `resources/js/` - ACTIVE (DO NOT DELETE)

These files are actively used and should NOT be deleted:

- ✅ `app.js` - Used in Vite config
- ✅ `frontend.js` - Used in Vite config
- ✅ `admin.js` - Used in Vite config
- ✅ `admin-calendar-v6.js` - Used in Vite config
- ✅ `bootstrap.js` - Imported by app.js
- ✅ `alpine-utils.js` - Imported by frontend.js and admin.js
- ✅ `vendor-frontend.js` - Used in Vite config (implicitly via frontend.js)
- ✅ `vendor-admin.js` - Used in Vite config (implicitly via admin.js)
- ✅ All files in `resources/js/components/` - Imported by admin.js

---

## Files in `public/js/` - ACTIVE (DO NOT DELETE)

These files are actively used in layouts and should NOT be deleted:

- ✅ `jquery-3.7.1.min.js` - Used in layouts
- ✅ `moment.min.js` - Used in admin layout
- ✅ `bootstrap.bundle.min.js` - Used in layouts
- ✅ `jquery.easing.1.3.min.js` - Used in frontend.js and layouts
- ✅ `jquery.waypoints.min.js` - Used in frontend.js and layouts
- ✅ `jquery.stellar.min.js` - Used in frontend.js and layouts
- ✅ `jquery.animateNumber.min.js` - Used in frontend.js and layouts
- ✅ `scrollax.min.js` - Used in frontend.js and layouts
- ✅ `jquery.magnific-popup.min.js` - Used in layouts
- ✅ `aos.min.js` - Used in layouts
- ✅ `google-map.min.js` - Used in layouts
- ✅ `daterangepicker.js` - Used in admin.js and admin layout
- ✅ `bootstrap-timepicker.min.js` - Used in admin.js and admin layout
- ✅ `bootstrap-formhelpers.min.js` - Used in admin.js and admin layout
- ✅ `intlTelInput.js` - Used in admin.js and admin layout
- ✅ `bootstrap-datepicker.js` - Used in appointments/calender.blade.php
- ✅ `custom-form-validation.js` - Used in admin layout
- ✅ `scripts.js` - Used in admin layout and admin-login layout
- ✅ `custom.js` - Used in admin layout and admin-login layout
- ✅ `main.js` - Used in frontend layouts

---

## Recommended Action Plan

### Phase 1: Safe Deletions (High Confidence)
Delete these files immediately:
- `public/js/admin-bundle.min.js`
- `public/js/admintheme.min.js`
- `public/js/frontend-bundle.min.js`
- `public/js/app.js`
- `public/js/main.min.js`
- `public/js/fullcalendar.min.js`
- `public/js/dashboard.js`
- `public/js/dashboard2.js`
- `public/js/common.js`
- `public/js/custom-popover.js`
- `public/js/fileupload.js`
- `public/js/agent-custom-form-validation.js`
- `public/js/user-preference.js`
- `public/js/user-sessions.js`
- `resources/js/admin-calendar.js`
- `resources/js/app-simple.js`

### Phase 2: Verify Before Deletion (Medium Confidence)
Check these files before deleting:
- `public/js/app.min.js` - Verify if `loadExternalAdminScripts()` in `admin.js` is actually being called
- `public/js/vendor/jquery.nicescroll.min.js` - Search codebase for any references
- `public/js/vendor/sticky-kit.min.js` - Search codebase for any references

---

## Notes

1. **Backup First**: Always backup files before deletion, especially if unsure.
2. **Test After Deletion**: After deleting files, test the application thoroughly:
   - Frontend pages
   - Admin panel
   - Calendar functionality
   - Form submissions
   - Any custom features
3. **Version Control**: These deletions should be committed to version control so they can be reverted if needed.
4. **Build Process**: After deletion, run `npm run build` to ensure Vite build still works correctly.

---

## Generated Date
Report generated: Review completed

