# Phase 1.5 Quick Wins - Next Steps

**Status:** FullCalendar v6 ✅ Complete  
**Next:** Phase 1.5 Quick Wins (1 week)

---

## ✅ What's Already Done

1. **FullCalendar v6 Upgrade** - COMPLETE
   - No longer requires jQuery
   - Calendar working perfectly
   - Blocker removed!

---

## 🎯 Next: Quick Wins (Priority Order)

### **Task 1: Replace $(document).ready() - EASIEST** ⭐ START HERE

**Files to update:** 7 files
- `resources/views/layouts/frontend.blade.php` (line 1060)
- `resources/views/layouts/admin.blade.php` (lines 280, 683)
- `resources/views/bookappointment.blade.php` (line 2763)
- `resources/views/Admin/cms_page/edit.blade.php` (line 863)
- `resources/views/Admin/cms_page/create.blade.php` (line 793)
- `resources/views/Admin/appointments/edit.blade.php` (line 535)

**Time:** 30 minutes  
**Risk:** Very Low  
**Impact:** 7 jQuery calls removed

**Replacement:**
```javascript
// OLD:
$(document).ready(function() {
    // code
});

// NEW:
document.addEventListener('DOMContentLoaded', function() {
    // code
});

// OR if script is at end of <body>:
// Just remove wrapper - code runs directly
```

---

### **Task 2: Remove Sticky Kit Plugin - EASY**

**Finding:** `layout-2` class is NOT used anywhere in views  
**Conclusion:** Sticky Kit can be safely removed!

**Files to update:**
- `resources/views/layouts/admin.blade.php` - Remove script tag (line 240)
- `public/js/scripts.js` - Remove/comment out `sidebar_sticky()` function (lines 17-25)

**Time:** 15 minutes  
**Risk:** Very Low (not used)  
**Impact:** 1 jQuery plugin removed

---

### **Task 3: Replace Select2 with Tom Select - MEDIUM**

**Status:** Select2 is loaded but need to verify usage  
**Replacement:** Tom Select (already installed!)

**Files to check:**
- Search for `.select2()` initialization
- Check which pages use Select2

**Time:** 2-3 hours  
**Risk:** Low-Medium  
**Impact:** 1 major jQuery plugin removed

---

### **Task 4: Replace Summernote with TinyMCE - MEDIUM**

**Status:** Summernote is loaded but need to verify usage  
**Replacement:** TinyMCE (already installed!)

**Files to check:**
- Search for `.summernote()` initialization
- Check blog/CMS edit pages

**Time:** 3-4 hours  
**Risk:** Low-Medium  
**Impact:** 1 major jQuery plugin removed

---

### **Task 5: NiceScroll - DEFER (Complex)**

**Finding:** Used extensively (13 instances in scripts.js)  
**Issue:** Custom scrollbar functionality - CSS alone may not be enough  
**Recommendation:** Keep for now, migrate later

**Time:** 4-6 hours (if done)  
**Risk:** Medium (affects UX)  
**Impact:** 1 jQuery plugin removed

---

### **Task 6: jQuery Easing - DEFER**

**Finding:** Loaded but usage unclear  
**Recommendation:** Check if actually used, then remove if not

**Time:** 1 hour (if not used)  
**Risk:** Low  
**Impact:** 1 jQuery plugin removed

---

## 📋 Recommended Execution Order

### **Week 1, Day 1 (2-3 hours):**

1. ✅ **Replace $(document).ready()** (30 mins) - 7 instances
2. ✅ **Remove Sticky Kit** (15 mins) - Not used
3. ✅ **Check Select2 usage** (30 mins) - Identify where used
4. ✅ **Check Summernote usage** (30 mins) - Identify where used
5. ✅ **Test everything** (1 hour) - Make sure nothing broke

**Result:** 1 plugin removed, 7 jQuery calls removed

---

### **Week 1, Day 2-3 (6-8 hours):**

1. ✅ **Replace Select2 with Tom Select** (3 hours)
2. ✅ **Replace Summernote with TinyMCE** (3 hours)
3. ✅ **Test thoroughly** (2 hours)

**Result:** 2 major plugins replaced

---

### **Week 1, Day 4-5 (8-10 hours):**

1. ✅ **Replace simple .show()/.hide()** (4 hours) - 50-100 instances
2. ✅ **Replace simple .addClass()/.removeClass()** (2 hours) - 20-30 instances
3. ✅ **Test everything** (2 hours)

**Result:** 70-130 jQuery calls removed

---

## 🎯 **START HERE: Task 1 - $(document).ready()**

**This is the easiest and safest first step!**

**Files to update:**
1. `resources/views/layouts/frontend.blade.php`
2. `resources/views/layouts/admin.blade.php` (2 instances)
3. `resources/views/bookappointment.blade.php`
4. `resources/views/Admin/cms_page/edit.blade.php`
5. `resources/views/Admin/cms_page/create.blade.php`
6. `resources/views/Admin/appointments/edit.blade.php`

**Total:** 7 replacements  
**Time:** 30 minutes  
**Risk:** Very Low

---

## ✅ **Ready to Start?**

**Option 1:** Start with Task 1 (easiest) - Replace $(document).ready()  
**Option 2:** Start with Task 2 (safest) - Remove unused Sticky Kit  
**Option 3:** Review usage first - Check Select2/Summernote before replacing

**My Recommendation:** Start with **Task 1** - it's the easiest and builds confidence!

---

**What would you like to do next?**

