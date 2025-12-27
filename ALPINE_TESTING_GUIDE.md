# Alpine.js Testing Guide

**Goal:** Test Alpine.js setup before migrating templates

---

## Test 1: Build Assets (Required First)

```bash
# Navigate to project directory
cd c:\xampp\htdocs\bansal_lawyers

# Build assets with Vite
npm run build
```

**Expected Output:**
```
✓ built in [time]
✓ [number] modules transformed
```

**Status:** ⬜ Not tested yet

---

## Test 2: Verify Alpine.js Loads in Browser

### Step 1: Open Admin Panel
1. Navigate to: `http://localhost/bansal_lawyers/admin/login`
2. Login to admin panel

### Step 2: Check Browser Console
**Press F12** to open Developer Tools, then check Console tab

**Expected Output:**
```
✓ Alpine.js initialized and available globally
```

**To verify manually, type in console:**
```javascript
window.Alpine
```

**Expected Result:** Should return Alpine object (not undefined)

**Status:** ⬜ Not tested yet

---

## Test 3: Create Simple Test Page

Create a simple test page to verify Alpine.js components work.

### Create Test Blade File

**File:** `resources/views/Admin/test-alpine.blade.php`

```php
@extends('layouts.admin')

@section('title', 'Alpine.js Test')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Alpine.js Test Page</h1>
        </div>

        <div class="section-body">
            <!-- Test 1: Basic Alpine.js -->
            <div class="card">
                <div class="card-header">
                    <h4>Test 1: Basic Alpine.js (Show/Hide)</h4>
                </div>
                <div class="card-body">
                    <div x-data="{ show: false }">
                        <button @click="show = !show" class="btn btn-primary">
                            Toggle Content
                        </button>
                        <div x-show="show" class="alert alert-success mt-3">
                            ✅ Alpine.js is working! This content toggles.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Test 2: Tom Select Component -->
            <div class="card">
                <div class="card-header">
                    <h4>Test 2: Tom Select Component</h4>
                </div>
                <div class="card-body">
                    <div x-data="{ selected: '' }">
                        <label>Select a Category:</label>
                        <select x-data="tomSelect({ placeholder: 'Choose an option' })" 
                                name="category"
                                x-model="selected"
                                class="form-control">
                            <option value="">Select...</option>
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <option value="3">Category 3</option>
                        </select>
                        <p class="mt-2">Selected value: <strong x-text="selected || 'None'"></strong></p>
                    </div>
                </div>
            </div>

            <!-- Test 3: TinyMCE Component -->
            <div class="card">
                <div class="card-header">
                    <h4>Test 3: TinyMCE Component</h4>
                </div>
                <div class="card-body">
                    <div x-data="{ content: '<p>Test content</p>' }">
                        <label>Rich Text Editor:</label>
                        <textarea x-data="tinyMCE({ height: 300 })" 
                                  name="description"
                                  x-model="content"
                                  class="form-control">
                        </textarea>
                        <p class="mt-2">Content length: <strong x-text="content.length"></strong> characters</p>
                    </div>
                </div>
            </div>

            <!-- Test 4: AJAX with Alpine.js -->
            <div class="card">
                <div class="card-header">
                    <h4>Test 4: AJAX Utilities</h4>
                </div>
                <div class="card-body">
                    <div x-data="{ 
                        loading: false, 
                        result: null,
                        async testAjax() {
                            this.loading = true;
                            try {
                                const response = await ajaxUtils.get('/admin/dashboard');
                                this.result = 'AJAX works! Response received.';
                            } catch (error) {
                                this.result = 'AJAX error: ' + error.message;
                            } finally {
                                this.loading = false;
                            }
                        }
                    }">
                        <button @click="testAjax()" class="btn btn-info" :disabled="loading">
                            <span x-show="!loading">Test AJAX Call</span>
                            <span x-show="loading">Loading...</span>
                        </button>
                        <div x-show="result" class="alert alert-info mt-3" x-text="result"></div>
                    </div>
                </div>
            </div>

            <!-- Test 5: Form Validation -->
            <div class="card">
                <div class="card-header">
                    <h4>Test 5: Form Validation</h4>
                </div>
                <div class="card-body">
                    <div x-data="{ 
                        email: '', 
                        isValid: false,
                        validateEmail() {
                            this.isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
                        }
                    }">
                        <label>Email Address:</label>
                        <input type="email" 
                               x-model="email" 
                               @input="validateEmail()"
                               class="form-control"
                               placeholder="test@example.com">
                        <div class="mt-2">
                            <span x-show="email && isValid" class="text-success">✓ Valid email</span>
                            <span x-show="email && !isValid" class="text-danger">✗ Invalid email</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
```

### Add Test Route

**File:** `routes/web.php`

Add this route inside the admin middleware group:

```php
// Alpine.js Test Page (remove after testing)
Route::get('/admin/test-alpine', function () {
    return view('Admin.test-alpine');
})->name('admin.test.alpine');
```

### Access Test Page

Navigate to: `http://localhost/bansal_lawyers/admin/test-alpine`

---

## Test Checklist

### ✅ Test 1: Basic Alpine.js
- [ ] Click "Toggle Content" button
- [ ] Content should show/hide smoothly
- [ ] No console errors

### ✅ Test 2: Tom Select
- [ ] Dropdown opens with search
- [ ] Can select options
- [ ] Selected value displays below
- [ ] No console errors

### ✅ Test 3: TinyMCE
- [ ] Editor loads with toolbar
- [ ] Can type and format text
- [ ] Character count updates
- [ ] No console errors

### ✅ Test 4: AJAX
- [ ] Click "Test AJAX Call" button
- [ ] Button shows "Loading..."
- [ ] Result message appears
- [ ] No console errors

### ✅ Test 5: Form Validation
- [ ] Type an email address
- [ ] Validation feedback appears
- [ ] Valid/invalid states work correctly
- [ ] No console errors

---

## Quick Console Tests

Open browser console (F12) and run these commands:

### 1. Check Alpine.js
```javascript
window.Alpine
// Should return: Object with Alpine methods
```

### 2. Check Tom Select
```javascript
window.Alpine.data
// Should return: Object with registered data components
```

### 3. Check ajaxUtils
```javascript
window.ajaxUtils
// Should return: Object with get, post, put, delete methods
```

### 4. Check domUtils
```javascript
window.domUtils
// Should return: Object with show, hide, toggle methods
```

---

## Common Issues & Fixes

### Issue 1: "Alpine is not defined"
**Fix:** Run `npm run build` to compile assets

### Issue 2: Tom Select doesn't load
**Fix:** Check console for import errors. TomSelect is dynamically imported.

### Issue 3: TinyMCE doesn't appear
**Fix:** Ensure TinyMCE script is loaded in layout (public/assets/tinymce/)

### Issue 4: "Cannot find module"
**Fix:** Clear cache and rebuild:
```bash
php artisan cache:clear
npm run build
```

---

## Expected Console Output

When page loads successfully:

```
✓ Alpine.js initialized and available globally
[Vite] connected
```

When Tom Select initializes:
```
(no errors = success)
```

When TinyMCE initializes:
```
(no errors = success)
```

---

## Next Steps After Testing

Once all tests pass:

1. ✅ Alpine.js is confirmed working
2. ✅ Components are registered correctly
3. ✅ Ready to migrate real templates
4. 🔄 Start with simple pages first (blog/CMS list pages)
5. 🔄 Then move to complex pages (forms, appointments)

---

**Last Updated:** December 27, 2025  
**Status:** Ready for testing

