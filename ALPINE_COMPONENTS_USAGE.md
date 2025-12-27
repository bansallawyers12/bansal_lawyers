# Alpine.js Components Usage Guide

**How to use Alpine.js components in Blade templates for faster, reactive UI.**

---

## Tom Select Component (Replaces Select2)

### Basic Usage

```html
<!-- OLD: jQuery Select2 -->
<select class="select2" name="category_id">
    <option value="">Select Category</option>
    <option value="1">Category 1</option>
</select>
<script>$('.select2').select2();</script>

<!-- NEW: Alpine.js + Tom Select -->
<select x-data="tomSelect({ placeholder: 'Select Category' })" 
        name="category_id"
        @tom-select:change="console.log($event.detail.value)">
    <option value="">Select Category</option>
    <option value="1">Category 1</option>
</select>
```

### Advanced Usage

```html
<select x-data="tomSelect({ 
    placeholder: 'Select an option',
    closeAfterSelect: true,
    allowEmptyOption: true 
})" 
        name="field"
        x-model="selectedValue"
        @tom-select:change="handleChange($event.detail.value)">
    <!-- options -->
</select>
```

---

## TinyMCE Component (Replaces Summernote)

### Basic Usage

```html
<!-- OLD: jQuery Summernote -->
<textarea class="summernote" name="description"></textarea>
<script>$('.summernote').summernote({ height: 300 });</script>

<!-- NEW: Alpine.js + TinyMCE -->
<textarea x-data="tinyMCE({ height: 500 })" 
          name="description"
          x-model="content"
          @tinymce:change="handleContentChange($event.detail.content)">
</textarea>
```

### Advanced Usage

```html
<textarea x-data="tinyMCE({ 
    height: 500,
    menubar: true,
    plugins: ['advlist', 'autolink', 'lists', 'link', 'image'],
    toolbar: 'undo redo | bold italic | link image'
})" 
          name="description"
          x-model="formData.content">
</textarea>
```

### With Initial Content

```html
<div x-data="{ 
    content: '{{ old('content', $model->content ?? '') }}',
    initTinyMCE() { return tinyMCE({ height: 500 }); }
}">
    <textarea x-data="initTinyMCE()" 
              name="content"
              x-model="content">
        @{{ content }}
    </textarea>
</div>
```

---

## Show/Hide with Alpine.js (Replaces jQuery .show()/.hide())

### Basic Toggle

```html
<!-- OLD: jQuery -->
<div id="content" style="display:none">Content</div>
<script>$('#content').show();</script>

<!-- NEW: Alpine.js -->
<div x-data="{ showContent: false }">
    <div x-show="showContent">Content</div>
    <button @click="showContent = !showContent">Toggle</button>
</div>
```

### Conditional Display

```html
<div x-data="{ isLoading: false, error: null, data: null }">
    <div x-show="isLoading">Loading...</div>
    <div x-show="error" x-text="error"></div>
    <div x-show="data" x-html="data"></div>
</div>
```

---

## Event Handling (Replaces jQuery .click(), .on())

### Click Events

```html
<!-- OLD: jQuery -->
<button id="btn">Click Me</button>
<script>$('#btn').click(function() { alert('Clicked!'); });</script>

<!-- NEW: Alpine.js -->
<button x-data @click="alert('Clicked!')">Click Me</button>
```

### Form Change Events

```html
<!-- OLD: jQuery -->
<input type="text" id="input">
<script>$('#input').on('change', function() { console.log($(this).val()); });</script>

<!-- NEW: Alpine.js -->
<input type="text" 
       x-data="{ value: '' }" 
       x-model="value" 
       @change="console.log(value)">
```

---

## Class Toggling (Replaces jQuery .addClass()/.removeClass())

```html
<!-- OLD: jQuery -->
<div class="menu">Menu</div>
<script>$('.menu').addClass('active');</script>

<!-- NEW: Alpine.js -->
<div x-data="{ isActive: false }" 
     :class="{ 'active': isActive }"
     @click="isActive = !isActive">
    Menu
</div>
```

---

## AJAX Calls (Replaces jQuery $.ajax())

```html
<!-- OLD: jQuery -->
<script>
$.ajax({
    url: '/api/data',
    type: 'POST',
    data: { id: 123 },
    success: function(response) {
        $('#result').html(response.message);
    }
});
</script>

<!-- NEW: Alpine.js + ajaxUtils -->
<div x-data="{ 
    result: '',
    async loadData() {
        const response = await ajaxUtils.post('/api/data', { id: 123 });
        if (response.success) {
            this.result = response.data.message;
        }
    }
}">
    <button @click="loadData()">Load Data</button>
    <div x-text="result"></div>
</div>
```

---

## Complete Example: Form with Select and Textarea

```html
<form x-data="{ 
    formData: {
        category_id: '',
        description: ''
    },
    async submitForm() {
        loadingUtils.show();
        try {
            const response = await ajaxUtils.post('/admin/blog/store', this.formData);
            if (response.success) {
                window.location.href = '/admin/blog';
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            loadingUtils.hide();
        }
    }
}">
    <!-- Tom Select -->
    <select x-data="tomSelect({ placeholder: 'Select Category' })" 
            name="category_id"
            x-model="formData.category_id">
        <option value="">Select Category</option>
        <option value="1">Category 1</option>
    </select>
    
    <!-- TinyMCE -->
    <textarea x-data="tinyMCE({ height: 500 })" 
              name="description"
              x-model="formData.description">
    </textarea>
    
    <button type="button" @click="submitForm()">Submit</button>
</form>
```

---

## Benefits

✅ **Faster** - No jQuery overhead, direct DOM manipulation  
✅ **Reactive** - Automatic UI updates when data changes  
✅ **Declarative** - Clear, readable code  
✅ **Smaller Bundle** - Alpine.js is only ~15KB  
✅ **Modern** - Uses modern JavaScript patterns  
✅ **Maintainable** - Easier to understand and debug  

---

**Next Steps:**
1. Replace Select2 with Tom Select + Alpine.js
2. Replace Summernote with TinyMCE + Alpine.js
3. Convert .show()/.hide() to x-show/x-if
4. Convert event handlers to @click, @change, etc.
5. Convert AJAX calls to Alpine.js + ajaxUtils

---

**Last Updated:** December 27, 2025

