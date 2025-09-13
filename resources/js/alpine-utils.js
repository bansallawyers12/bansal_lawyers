/**
 * Alpine.js Utility Functions
 * Modern replacements for common jQuery patterns
 */

// Form validation utilities
window.formUtils = {
    // Validate form with Alpine.js
    validateForm(formId) {
        const form = document.getElementById(formId);
        if (!form) return false;
        
        const requiredFields = form.querySelectorAll('[data-valid="required"]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'ring-red-500');
                field.classList.remove('border-gray-300', 'ring-blue-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500', 'ring-red-500');
                field.classList.add('border-gray-300', 'ring-blue-500');
            }
        });
        
        return isValid;
    },
    
    // Clear form validation errors
    clearValidationErrors(formId) {
        const form = document.getElementById(formId);
        if (!form) return;
        
        const fields = form.querySelectorAll('[data-valid]');
        fields.forEach(field => {
            field.classList.remove('border-red-500', 'ring-red-500');
            field.classList.add('border-gray-300', 'ring-blue-500');
        });
    }
};

// Modal utilities
window.modalUtils = {
    // Show modal
    show(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // Add backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'fixed inset-0 bg-black bg-opacity-50 z-40';
            backdrop.id = `${modalId}-backdrop`;
            backdrop.addEventListener('click', () => this.hide(modalId));
            document.body.appendChild(backdrop);
        }
    },
    
    // Hide modal
    hide(modalId) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById(`${modalId}-backdrop`);
        
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        
        if (backdrop) {
            backdrop.remove();
        }
    }
};

// AJAX utilities using fetch API
window.ajaxUtils = {
    // Generic AJAX function
    async request(url, options = {}) {
        const defaultOptions = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        };
        
        const config = { ...defaultOptions, ...options };
        
        try {
            const response = await fetch(url, config);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return await response.json();
            }
            
            return await response.text();
        } catch (error) {
            console.error('AJAX request failed:', error);
            throw error;
        }
    },
    
    // POST request
    async post(url, data) {
        return this.request(url, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    },
    
    // GET request
    async get(url, params = {}) {
        const urlParams = new URLSearchParams(params);
        const fullUrl = urlParams.toString() ? `${url}?${urlParams}` : url;
        return this.request(fullUrl);
    }
};

// DOM utilities
window.domUtils = {
    // Show element
    show(selector) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => {
            el.classList.remove('hidden');
            el.classList.add('block');
        });
    },
    
    // Hide element
    hide(selector) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });
    },
    
    // Toggle element visibility
    toggle(selector) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => {
            el.classList.toggle('hidden');
            el.classList.toggle('block');
        });
    },
    
    // Get element value
    getValue(selector) {
        const element = document.querySelector(selector);
        return element ? element.value : '';
    },
    
    // Set element value
    setValue(selector, value) {
        const element = document.querySelector(selector);
        if (element) {
            element.value = value;
        }
    },
    
    // Get element text
    getText(selector) {
        const element = document.querySelector(selector);
        return element ? element.textContent : '';
    },
    
    // Set element text
    setText(selector, text) {
        const element = document.querySelector(selector);
        if (element) {
            element.textContent = text;
        }
    },
    
    // Get element HTML
    getHTML(selector) {
        const element = document.querySelector(selector);
        return element ? element.innerHTML : '';
    },
    
    // Set element HTML
    setHTML(selector, html) {
        const element = document.querySelector(selector);
        if (element) {
            element.innerHTML = html;
        }
    },
    
    // Add class
    addClass(selector, className) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => el.classList.add(className));
    },
    
    // Remove class
    removeClass(selector, className) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => el.classList.remove(className));
    },
    
    // Toggle class
    toggleClass(selector, className) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => el.classList.toggle(className));
    },
    
    // Check if element has class
    hasClass(selector, className) {
        const element = document.querySelector(selector);
        return element ? element.classList.contains(className) : false;
    }
};

// Table utilities for dynamic table operations
window.tableUtils = {
    // Toggle table columns
    toggleColumns(tableSelector, columnIndex, show = true) {
        const table = document.querySelector(tableSelector);
        if (!table) return;
        
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            const cell = row.children[columnIndex - 1];
            if (cell) {
                cell.style.display = show ? '' : 'none';
            }
        });
    },
    
    // Show all columns
    showAllColumns(tableSelector) {
        const table = document.querySelector(tableSelector);
        if (!table) return;
        
        const cells = table.querySelectorAll('td, th');
        cells.forEach(cell => {
            cell.style.display = '';
        });
    },
    
    // Hide all columns except specified ones
    hideColumnsExcept(tableSelector, visibleColumns) {
        const table = document.querySelector(tableSelector);
        if (!table) return;
        
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            Array.from(row.children).forEach((cell, index) => {
                const columnIndex = index + 1;
                cell.style.display = visibleColumns.includes(columnIndex) ? '' : 'none';
            });
        });
    }
};

// Event utilities
window.eventUtils = {
    // Add event listener with delegation
    delegate(container, selector, event, handler) {
        const containerEl = document.querySelector(container);
        if (containerEl) {
            containerEl.addEventListener(event, (e) => {
                if (e.target.matches(selector)) {
                    handler(e);
                }
            });
        }
    },
    
    // Remove event listener
    remove(selector, event, handler) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => {
            el.removeEventListener(event, handler);
        });
    }
};

// Loading utilities
window.loadingUtils = {
    // Show loading indicator
    show(selector = '.popuploader') {
        domUtils.show(selector);
    },
    
    // Hide loading indicator
    hide(selector = '.popuploader') {
        domUtils.hide(selector);
    }
};

// Add formValidation alias for compatibility
window.formValidation = {
    init: function() {
        console.log('Form validation initialized');
        return true;
    },
    validateForm: function(formId) {
        return window.formUtils.validateForm(formId);
    },
    validateField: function(fieldId) {
        return window.formUtils.validateField(fieldId);
    }
};

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        formUtils: window.formUtils,
        formValidation: window.formValidation,
        modalUtils: window.modalUtils,
        ajaxUtils: window.ajaxUtils,
        domUtils: window.domUtils,
        tableUtils: window.tableUtils,
        eventUtils: window.eventUtils,
        loadingUtils: window.loadingUtils
    };
}
