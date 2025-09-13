// Simple app.js - Minimal version to ensure page loads
import './bootstrap';

import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Basic fallback utilities
window.formValidation = {
    validateForm: (formName) => {
        console.log('Form validation called for:', formName);
        return true;
    },
    validateField: (field) => {
        console.log('Field validation called for:', field);
        return true;
    }
};

window.modernSelect = {
    init: (selector, options = {}) => {
        console.log('Modern select init called for:', selector, options);
        return Promise.resolve([]);
    }
};

window.ajaxUtils = {
    get: (url, config = {}) => {
        console.log('AJAX GET called:', url, config);
        return Promise.resolve({ success: true, data: {} });
    },
    post: (url, data = {}, config = {}) => {
        console.log('AJAX POST called:', url, data, config);
        return Promise.resolve({ success: true, data: {} });
    }
};

window.modalUtils = {
    show: (modalId) => {
        console.log('Modal show called:', modalId);
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'block';
        }
        return true;
    },
    hide: (modalId) => {
        console.log('Modal hide called:', modalId);
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
        }
        return true;
    }
};

window.loadingUtils = {
    show: () => {
        console.log('Loading show called');
        const loader = document.querySelector('.popuploader');
        if (loader) loader.style.display = 'block';
    },
    hide: () => {
        console.log('Loading hide called');
        const loader = document.querySelector('.popuploader');
        if (loader) loader.style.display = 'none';
    }
};

// Start Alpine
Alpine.start();

console.log('App initialized successfully');

// Export for potential use in other modules
export { Alpine };
