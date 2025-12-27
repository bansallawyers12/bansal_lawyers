# Next Steps - Alpine.js Migration Action Plan

**Status:** Alpine.js setup complete ✅  
**Next:** Start using Alpine.js in templates

---

## 🎯 Immediate Next Steps (Priority Order)

### **Step 1: Find Select2/Summernote Usage (30 minutes)**

**Goal:** Identify which pages actually use Select2 and Summernote

**Actions:**
1. Search for Select2 usage in templates
2. Search for Summernote usage in templates  
3. Document which pages need updating

**Command to run:**
```bash
# Search for Select2
grep -r "select2\|\.select2" resources/views/Admin

# Search for Summernote  
grep -r "summernote\|\.summernote" resources/views/Admin
```

**Expected Result:** List of files that need updating

---

### **Step 2: Start with Simple Pages (2-3 hours)**

**Priority files (easiest first):**

1. **`Admin/blog/create.blade.php`**
   - Likely uses Summernote for content editor
   - May use Select2 for category dropdown
   
2. **`Admin/blog/edit.blade.php`**
   - Same as create, but with existing data
   
3. **`Admin/cms_page/create.blade.php`**
   - Likely uses Summernote
   - May use Select2
   
4. **`Admin/cms_page/edit.blade.php`**
   - Same as create, but with existing data

**Migration Pattern:**

**Replace Summernote:**
```html
<!-- OLD -->
<textarea class="summernote" name="description">{{ old('description', $blog->description ?? '') }}</textarea>

<!-- NEW -->
<textarea x-data="tinyMCE({ height: 500 })" 
          name="description">{{ old('description', $blog->description ?? '') }}</textarea>
```

**Replace Select2:**
```html
<!-- OLD -->
<select class="select2" name="category_id">
    <option value="">Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
<script>$('.select2').select2();</script>

<!-- NEW -->
<select x-data="tomSelect({ placeholder: 'Select Category' })" 
        name="category_id">
    <option value="">Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
```

---

### **Step 3: Test Updated Pages (1 hour)**

**Testing Checklist:**
- [ ] Page loads without errors
- [ ] TinyMCE editor appears and works
- [ ] Tom Select dropdown works with search
- [ ] Form submission works correctly
- [ ] Data saves to database
- [ ] No console errors

**Test Steps:**
1. Open page in browser
2. Check browser console (F12) for errors
3. Test editor functionality
4. Test dropdown selection
5. Submit form
6. Verify data saved

---

### **Step 4: Remove Old Scripts (15 minutes)**

Once all pages are migrated:

**Remove from `layouts/admin.blade.php`:**
```html
<!-- REMOVE THIS -->
<script src="{{ asset('js/summernote-bs4.js')}}"></script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
```

**Remove CSS:**
```html
<!-- REMOVE THIS -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
```

---

### **Step 5: Replace Show/Hide Patterns (4-6 hours)**

**Find jQuery .show()/.hide() calls:**
```bash
grep -r "\.show()\|\.hide()\|\.toggle()" resources/views
```

**Replace with Alpine.js:**
```html
<!-- OLD -->
<div id="content" style="display:none">Content</div>
<script>$('#content').show();</script>

<!-- NEW -->
<div x-data="{ show: false }">
    <button @click="show = !show">Toggle</button>
    <div x-show="show">Content</div>
</div>
```

**Target files:**
- `Admin/appointments/index.blade.php` (~20 instances)
- `layouts/admin.blade.php` (~141 instances)
- Other admin pages

---

## 📋 Quick Reference

### Alpine.js Components Available

```html
<!-- Tom Select -->
<select x-data="tomSelect({ placeholder: 'Select...' })">
    <option>Options</option>
</select>

<!-- TinyMCE -->
<textarea x-data="tinyMCE({ height: 500 })"></textarea>

<!-- Show/Hide -->
<div x-data="{ show: false }">
    <button @click="show = !show">Toggle</button>
    <div x-show="show">Content</div>
</div>

<!-- AJAX -->
<div x-data="{ 
    async loadData() {
        const response = await ajaxUtils.get('/api/data');
        // handle response
    }
}">
    <button @click="loadData()">Load</button>
</div>
```

---

## 🎯 Recommended Order

**Day 1 (2-3 hours):**
1. ✅ Find Select2/Summernote usage
2. ✅ Update blog/create.blade.php
3. ✅ Update blog/edit.blade.php
4. ✅ Test both pages

**Day 2 (2-3 hours):**
5. ✅ Update cms_page/create.blade.php
6. ✅ Update cms_page/edit.blade.php
7. ✅ Test both pages
8. ✅ Remove Select2/Summernote scripts

**Day 3-4 (4-6 hours):**
9. ✅ Replace .show()/.hide() patterns
10. ✅ Test all updated pages
11. ✅ Document changes

---

## ✅ Success Criteria

- ✅ All blog/CMS pages use Alpine.js
- ✅ No jQuery Select2/Summernote in use
- ✅ All forms submit correctly
- ✅ No console errors
- ✅ Page load times improved

---

## 🚀 Ready to Start?

**First action:** Find which pages use Select2 and Summernote

Run this to see what needs updating:
```bash
# Windows PowerShell
Select-String -Path "resources\views\Admin\*.blade.php" -Pattern "select2|summernote" -Recurse
```

---

**Last Updated:** December 27, 2025  
**Next Action:** Find Select2/Summernote usage in templates

