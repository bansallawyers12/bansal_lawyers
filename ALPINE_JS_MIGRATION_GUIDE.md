# Alpine.js Migration Guide - Quick Reference

**Strategy:** Use Alpine.js for ALL reactive UI patterns to speed up and fix issues.

---

## Quick Reference: jQuery → Alpine.js Patterns

### 1. Show/Hide Elements

**OLD (jQuery):**
```javascript
$('.loader').show();
$('.error').hide();
$('.modal').toggle();
```

**NEW (Alpine.js):**
```html
<div x-data="{ showLoader: false, showError: false, showModal: false }">
    <div x-show="showLoader">Loading...</div>
    <div x-show="showError">Error!</div>
    <div x-show="showModal" class="modal">Modal Content</div>
    <button @click="showModal = !showModal">Toggle</button>
</div>
```

**Benefits:** ⚡ Faster | 🔄 Reactive | 🎯 Declarative

---

### 2. Event Handling

**OLD (jQuery):**
```javascript
$('#button').click(function() {
    alert('Clicked!');
});
```

**NEW (Alpine.js):**
```html
<button x-data @click="alert('Clicked!')">Click Me</button>

<!-- Or with method: -->
<button x-data="{ handleClick() { alert('Clicked!'); } }" @click="handleClick()">
    Click Me
</button>
```

---

### 3. Form Interactions

**OLD (jQuery):**
```javascript
$('#input').on('change', function() {
    console.log($(this).val());
});
```

**NEW (Alpine.js):**
```html
<input x-data="{ value: '' }" 
       x-model="value" 
       @change="console.log(value)">
```

---

### 4. Class Toggling

**OLD (jQuery):**
```javascript
$('.button').addClass('active');
$('.menu').removeClass('open');
$('.dropdown').toggleClass('show');
```

**NEW (Alpine.js):**
```html
<div x-data="{ isActive: false, isOpen: false, show: false }">
    <button :class="{ 'active': isActive }" @click="isActive = true">Button</button>
    <div :class="{ 'open': isOpen }">Menu</div>
    <div @click="show = !show" :class="{ 'show': show }">Dropdown</div>
</div>
```

---

### 5. DOM Manipulation (HTML/Text)

**OLD (jQuery):**
```javascript
$('.content').html('<div>New HTML</div>');
$('.title').text('New Title');
```

**NEW (Alpine.js):**
```html
<div x-data="{ content: '<div>New HTML</div>', title: 'New Title' }">
    <div x-html="content"></div>
    <h1 x-text="title"></h1>
</div>
```

---

### 6. AJAX Calls

**OLD (jQuery):**
```javascript
$.ajax({
    url: '/api/data',
    type: 'POST',
    data: { id: 123 },
    success: function(response) {
        $('.result').html(response.message);
    }
});
```

**NEW (Alpine.js + ajaxUtils):**
```html
<div x-data="{ 
    result: '',
    async loadData() {
        const response = await ajaxUtils.post('/api/data', { id: 123 });
        if (response.success) {
            this.result = response.data.message;
        }
    }
}">
    <button @click="loadData()">Load</button>
    <div x-text="result"></div>
</div>
```

---

### 7. Select2 → Tom Select with Alpine.js

**OLD (jQuery Select2):**
```javascript
$('.select2').select2({
    placeholder: 'Select option',
    allowClear: true
});
```

**NEW (Alpine.js + Tom Select):**
```html
<select x-data="{ 
    selected: null,
    init() {
        this.$nextTick(() => {
            new TomSelect(this.$el, {
                plugins: ['clear_button'],
                placeholder: 'Select option',
                onChange: (value) => { this.selected = value; }
            });
        });
    }
}">
    <option value="">Select option</option>
    <option value="1">Option 1</option>
</select>
```

---

### 8. Summernote → TinyMCE with Alpine.js

**OLD (jQuery Summernote):**
```javascript
$('.summernote').summernote({
    height: 300,
    toolbar: [...]
});
```

**NEW (Alpine.js + TinyMCE):**
```html
<textarea x-data="{ 
    content: '',
    init() {
        this.$nextTick(() => {
            tinymce.init({
                target: this.$el,
                height: 300,
                plugins: 'lists link image',
                setup: (editor) => {
                    editor.on('change', () => {
                        this.content = editor.getContent();
                    });
                }
            });
        });
    }
}"></textarea>
```

---

### 9. Modals

**OLD (jQuery):**
```javascript
$('#modal').modal('show');
$('#modal').modal('hide');
```

**NEW (Alpine.js):**
```html
<!-- Using Alpine.js x-show -->
<div x-data="{ showModal: false }">
    <button @click="showModal = true">Open Modal</button>
    <div x-show="showModal" class="modal" @click.away="showModal = false">
        <div class="modal-content">
            <button @click="showModal = false">Close</button>
        </div>
    </div>
</div>
```

---

### 10. Iteration (.each())

**OLD (jQuery):**
```javascript
$('.items').each(function() {
    $(this).addClass('active');
});
```

**NEW (Alpine.js):**
```html
<div x-data="{ items: [1, 2, 3] }">
    <template x-for="item in items" :key="item">
        <div :class="{ 'active': true }" x-text="item"></div>
    </template>
</div>
```

---

## Migration Checklist

### Phase 1.5: Quick Wins (Alpine.js First)

- [x] Alpine.js installed and initialized
- [x] Replace $(document).ready() with DOMContentLoaded
- [ ] Replace Select2 with Tom Select + Alpine.js
- [ ] Replace Summernote with TinyMCE + Alpine.js
- [ ] Replace .show()/.hide() with x-show/x-if
- [ ] Replace .addClass()/.removeClass() with :class
- [ ] Replace event handlers with @click, @change, etc.
- [ ] Replace $.ajax() with Alpine.js + ajaxUtils

---

## Performance Benefits

1. **Faster Initial Load:** Alpine.js is only ~15KB (vs jQuery ~30KB)
2. **Reactive Updates:** No manual DOM queries needed
3. **Better Performance:** Direct DOM manipulation, no jQuery overhead
4. **Smaller Bundle:** Removing jQuery saves significant size
5. **Modern Patterns:** Declarative, easier to maintain

---

## Getting Started

1. **Identify jQuery patterns** in your code
2. **Convert to Alpine.js** using patterns above
3. **Test thoroughly** in browser
4. **Remove jQuery dependency** once migration complete

---

**Last Updated:** December 27, 2025
**Status:** Active Migration - Alpine.js First Strategy

