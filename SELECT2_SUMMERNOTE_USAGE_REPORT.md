# Select2 & Summernote Usage Report

**Date:** December 27, 2025  
**Status:** Search Complete ✅

---

## 📊 Summary

### Select2 Usage
- **Found in:** 3 locations
- **Status:** Still in use (needs migration to Tom Select)

### Summernote Usage
- **Found in:** 3 locations  
- **Status:** Still in use (needs migration to TinyMCE via Alpine.js)

---

## 🔍 Detailed Findings

### Select2 Usage

#### 1. **Layout File** (`resources/views/layouts/admin.blade.php`)
- **Line 30:** CSS loaded: `<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">`
- **Line 84:** CSS class reference: `.select2resultrepositorystatistics`
- **Line 231:** JS loaded: `<script src="{{ asset('js/select2.full.min.js')}}"></script>`
- **Action:** Remove these lines after migration

#### 2. **Global Initialization** (`public/js/scripts.js`)
- **Lines 324-327:** Auto-initializes all `.select2` elements
```javascript
if (jQuery().select2) {
  $(".select2").select2();
}
```
- **Action:** Remove after all Select2 usage is migrated

#### 3. **Direct Usage** (`public/js/user-preference.js`)
- **Line 133:** `$('#pop_action #format').select2({...})`
- **Line 138:** `$('#pop_action #hours_type').select2({...})`
- **Line 1217:** `$("#delete_acc_reason").select2({...})`
- **Action:** Migrate to Tom Select with Alpine.js

#### 4. **Form Validation** (`public/js/custom-form-validation.js`)
- **Line 1722:** References summernote-simple (not select2, but related)
- **Action:** Check if any select2 usage exists here

---

### Summernote Usage

#### 1. **Layout File** (`resources/views/layouts/admin.blade.php`)
- **Line 27:** CSS loaded: `<link rel="stylesheet" href="{{ asset('css/summernote-bs4.css')}}">`
- **Line 228:** JS loaded: `<script src="{{ asset('js/summernote-bs4.js')}}"></script>`
- **Action:** Remove these lines after migration

#### 2. **Global Initialization** (`public/js/scripts.js`)
- **Lines 360-369:** Auto-initializes `.summernote` and `.summernote-simple` classes
```javascript
if (jQuery().summernote) {
  $(".summernote").summernote({
    dialogsInBody: true,
    minHeight: 250
  });
  $(".summernote-simple").summernote({
    dialogsInBody: true,
    minHeight: 150,
    toolbar: [...]
  });
}
```
- **Action:** Remove after all Summernote usage is migrated

#### 3. **Dashboard** (`public/js/dashboard.js`)
- **Line 31:** `$('.textarea').summernote()`
- **Action:** Migrate to TinyMCE via Alpine.js

#### 4. **Form Validation** (`public/js/custom-form-validation.js`)
- **Line 1722:** `$("#create_note_d .summernote-simple").val('');`
- **Line 1724:** `$("#create_note_d .summernote-simple").summernote('code','');`
- **Action:** Migrate to TinyMCE

---

## ✅ Good News!

### Already Migrated Pages

These pages **DO NOT** use Select2 or Summernote - they're already using modern alternatives:

1. ✅ **`resources/views/Admin/blog/create.blade.php`**
   - Uses: TinyMCE via Alpine.js component (`x-data="tinyMCE()"`)
   - Status: ✅ Fully migrated

2. ✅ **`resources/views/Admin/blog/edit.blade.php`**
   - Uses: TinyMCE (direct initialization)
   - Status: ✅ Migrated (but not using Alpine.js component yet)

3. ✅ **`resources/views/Admin/cms_page/create.blade.php`**
   - Uses: TinyMCE (direct initialization)
   - Status: ✅ Migrated (but not using Alpine.js component yet)

4. ✅ **`resources/views/Admin/cms_page/edit.blade.php`**
   - Uses: TinyMCE (direct initialization)
   - Status: ✅ Migrated (but not using Alpine.js component yet)

---

## 🎯 Migration Priority

### High Priority (Pages that need updating)

1. **Find pages using `.select2` class**
   - Search blade files for `class="select2"` or `class='select2'`
   - Currently: None found in blade files (may be added dynamically)

2. **Find pages using `.summernote` class**
   - Search blade files for `class="summernote"` or `class='summernote'`
   - Currently: None found in blade files (may be added dynamically)

3. **JavaScript files that need updating:**
   - `public/js/user-preference.js` - 3 Select2 instances
   - `public/js/dashboard.js` - 1 Summernote instance
   - `public/js/custom-form-validation.js` - Summernote references

### Medium Priority (Cleanup)

1. Remove Select2/Summernote from `layouts/admin.blade.php`
2. Remove initialization code from `public/js/scripts.js`
3. Update blog/cms edit pages to use Alpine.js TinyMCE component (for consistency)

---

## 📝 Next Steps

### Step 1: Find Actual Usage in Templates ✅ COMPLETE
**Result:** No blade templates are using `class="select2"` or `class="summernote"` directly.

This means:
- Select2/Summernote are initialized dynamically via JavaScript
- Or they're not currently being used in templates
- Main usage is in JavaScript files (see below)

### Step 2: Migrate JavaScript Files
1. Update `public/js/user-preference.js` - Replace Select2 with Tom Select
2. Update `public/js/dashboard.js` - Replace Summernote with TinyMCE
3. Update `public/js/custom-form-validation.js` - Replace Summernote references

### Step 3: Remove Global Initialization
1. Remove Select2/Summernote initialization from `public/js/scripts.js`
2. Remove CSS/JS includes from `layouts/admin.blade.php`

### Step 4: Standardize TinyMCE Usage
1. Update blog/edit.blade.php to use Alpine.js TinyMCE component
2. Update cms_page/create.blade.php to use Alpine.js TinyMCE component
3. Update cms_page/edit.blade.php to use Alpine.js TinyMCE component

---

## 📋 Files to Update

### Must Update:
- [ ] `public/js/user-preference.js` (Select2 → Tom Select)
- [ ] `public/js/dashboard.js` (Summernote → TinyMCE)
- [ ] `public/js/custom-form-validation.js` (Summernote → TinyMCE)

### Cleanup After Migration:
- [ ] `resources/views/layouts/admin.blade.php` (Remove Select2/Summernote includes)
- [ ] `public/js/scripts.js` (Remove Select2/Summernote initialization)

### Optional (For Consistency):
- [ ] `resources/views/Admin/blog/edit.blade.php` (Use Alpine.js TinyMCE component)
- [ ] `resources/views/Admin/cms_page/create.blade.php` (Use Alpine.js TinyMCE component)
- [ ] `resources/views/Admin/cms_page/edit.blade.php` (Use Alpine.js TinyMCE component)

---

**Last Updated:** December 27, 2025  
**Next Action:** Search for actual `.select2` and `.summernote` class usage in blade templates

