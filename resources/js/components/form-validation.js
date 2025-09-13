// Modern Form Validation Component - Alpine.js
// Replaces custom-form-validation.js jQuery functionality

export const formValidation = {
    // Error messages
    errors: {
        required: 'This field is required.',
        email: 'Please enter a valid email address.',
        captcha: 'Captcha invalid.',
        max: 'Number should be less than or equal to',
        min: 'This field should be greater than or equal to',
        equal: 'This field should be equal to'
    },

    // Validation rules
    rules: {
        required: (value) => value && value.trim().length > 0,
        email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
        min: (value, min) => parseFloat(value) >= parseFloat(min),
        max: (value, max) => parseFloat(value) <= parseFloat(max),
        equal: (value, target) => value === target,
        phone: (value) => /^[\+]?[1-9][\d]{0,15}$/.test(value.replace(/\s/g, '')),
        url: (value) => /^https?:\/\/.+/.test(value)
    },

    // Validate a single field
    validateField(field) {
        const value = field.value;
        const validations = field.getAttribute('data-valid')?.split(' ') || [];
        const errors = [];

        for (const rule of validations) {
            const [ruleName, ruleValue] = rule.split(':');
            
            if (this.rules[ruleName] && !this.rules[ruleName](value, ruleValue)) {
                errors.push(this.getErrorMessage(ruleName, ruleValue));
            }
        }

        return {
            isValid: errors.length === 0,
            errors: errors
        };
    },

    // Get error message for a rule
    getErrorMessage(rule, value) {
        switch (rule) {
            case 'required':
                return this.errors.required;
            case 'email':
                return this.errors.email;
            case 'min':
                return `${this.errors.min} ${value}`;
            case 'max':
                return `${this.errors.max} ${value}`;
            case 'equal':
                return `${this.errors.equal} ${value}`;
            default:
                return 'Invalid input';
        }
    },

    // Display field error
    showFieldError(field, message) {
        this.clearFieldError(field);
        
        const errorElement = document.createElement('div');
        errorElement.className = 'custom-error text-red-500 text-sm mt-1';
        errorElement.textContent = message;
        
        field.parentNode.insertBefore(errorElement, field.nextSibling);
        field.classList.add('border-red-500', 'focus:ring-red-500');
    },

    // Clear field error
    clearFieldError(field) {
        const existingError = field.parentNode.querySelector('.custom-error');
        if (existingError) {
            existingError.remove();
        }
        field.classList.remove('border-red-500', 'focus:ring-red-500');
    },

    // Validate entire form
    validateForm(formName) {
        const form = document.querySelector(`form[name="${formName}"]`);
        if (!form) {
            console.error(`Form with name "${formName}" not found`);
            return false;
        }

        const fields = form.querySelectorAll('[data-valid]');
        let isValid = true;
        let firstErrorField = null;

        // Clear all existing errors
        form.querySelectorAll('.custom-error').forEach(error => error.remove());
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.classList.remove('border-red-500', 'focus:ring-red-500');
        });

        for (const field of fields) {
            const validation = this.validateField(field);
            
            if (!validation.isValid) {
                isValid = false;
                if (!firstErrorField) firstErrorField = field;
                
                validation.errors.forEach(error => {
                    this.showFieldError(field, error);
                });
            }
        }

        // Focus first error field
        if (firstErrorField) {
            firstErrorField.focus();
        }

        return isValid;
    },

    // Initialize form validation
    init(formName) {
        const form = document.querySelector(`form[name="${formName}"]`);
        if (!form) return;

        // Add real-time validation on blur
        form.querySelectorAll('[data-valid]').forEach(field => {
            field.addEventListener('blur', () => {
                const validation = this.validateField(field);
                if (!validation.isValid) {
                    this.showFieldError(field, validation.errors[0]);
                } else {
                    this.clearFieldError(field);
                }
            });

            // Clear errors on input
            field.addEventListener('input', () => {
                this.clearFieldError(field);
            });
        });
    }
};

// Alpine.js component for form validation
export const formValidationComponent = () => ({
    formName: '',
    isValid: false,
    errors: {},

    init() {
        this.formName = this.$el.getAttribute('data-form-name') || '';
        if (this.formName) {
            formValidation.init(this.formName);
        }
    },

    validate() {
        this.isValid = formValidation.validateForm(this.formName);
        return this.isValid;
    },

    validateField(field) {
        const validation = formValidation.validateField(field);
        if (!validation.isValid) {
            formValidation.showFieldError(field, validation.errors[0]);
        } else {
            formValidation.clearFieldError(field);
        }
        return validation.isValid;
    }
});

// Global form validation utilities
window.formValidation = formValidation;
window.formValidationComponent = formValidationComponent;
