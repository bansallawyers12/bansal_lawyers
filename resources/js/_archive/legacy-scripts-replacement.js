// Modern Replacement for Legacy Scripts
// Replaces functionality from scripts.js and custom.js

export const legacyScriptsReplacement = {
    // Initialize all legacy functionality
    init() {
        this.setupLoader();
        this.setupSidebar();
        this.setupStatusChanges();
        this.setupPhoneInputs();
        this.setupFormHandlers();
        this.setupUIComponents();
    },

    // Setup loader functionality
    setupLoader() {
        window.addEventListener('load', () => {
            const loader = document.querySelector('.loader');
            if (loader) {
                loader.style.display = 'none';
            }
        });
    },

    // Setup sidebar functionality
    setupSidebar() {
        // Sidebar dropdown functionality
        const sidebarDropdowns = document.querySelectorAll('.main-sidebar .sidebar-menu li a.has-dropdown');
        sidebarDropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', (e) => {
                e.preventDefault();
                const submenu = dropdown.parentNode.querySelector('.dropdown-menu');
                if (submenu) {
                    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                }
            });
        });

        // Sidebar sticky functionality
        if (document.body.classList.contains('layout-2')) {
            const sidebar = document.querySelector('#sidebar-wrapper');
            if (sidebar) {
                // Simple sticky implementation
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 100) {
                        sidebar.classList.add('sticky');
                    } else {
                        sidebar.classList.remove('sticky');
                    }
                });
            }
        }
    },

    // Setup status change functionality
    setupStatusChanges() {
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('change-status')) {
                const id = e.target.getAttribute('data-id');
                const currentStatus = e.target.getAttribute('data-status');
                const table = e.target.getAttribute('data-table');
                const col = e.target.getAttribute('data-col');

                if (id && currentStatus && table) {
                    this.updateStatus(id, currentStatus, table, col);
                }
            }
        });
    },

    // Update status via AJAX
    async updateStatus(id, currentStatus, table, col) {
        try {
            if (window.ajaxUtils) {
                const response = await window.ajaxUtils.post('/admin/update-status', {
                    id: id,
                    current_status: currentStatus,
                    table: table,
                    col: col
                });

                if (response.success) {
                    console.log('Status updated successfully');
                } else {
                    console.error('Status update failed:', response.error);
                }
            }
        } catch (error) {
            console.error('Error updating status:', error);
        }
    },

    // Setup phone input functionality
    setupPhoneInputs() {
        const phoneInputs = document.querySelectorAll('.tel_input');
        phoneInputs.forEach(input => {
            input.addEventListener('blur', () => {
                // Format phone number
                let value = input.value.replace(/\D/g, '');
                if (value.length === 10) {
                    value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                }
                input.value = value;
            });

            input.addEventListener('input', () => {
                // Allow only numbers
                input.value = input.value.replace(/\D/g, '');
            });
        });
    },

    // Setup form handlers
    setupFormHandlers() {
        // Form submission with validation
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (form.hasAttribute('data-validate')) {
                e.preventDefault();
                this.handleFormSubmission(form);
            }
        });

        // Real-time validation
        document.addEventListener('input', (e) => {
            if (e.target.hasAttribute('data-valid')) {
                this.validateField(e.target);
            }
        });
    },

    // Handle form submission
    async handleFormSubmission(form) {
        if (window.formValidation) {
            const isValid = window.formValidation.validateForm(form.name);
            if (!isValid) {
                return;
            }
        }

        // Show loading
        if (window.loadingUtils) {
            window.loadingUtils.show();
        }

        try {
            const formData = new FormData(form);
            const response = await window.ajaxUtils.post(form.action, formData);

            if (response.success) {
                // Handle success
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    // Show success message
                    this.showMessage('Form submitted successfully', 'success');
                }
            } else {
                this.showMessage(response.error || 'Form submission failed', 'error');
            }
        } catch (error) {
            this.showMessage('An error occurred while submitting the form', 'error');
        } finally {
            if (window.loadingUtils) {
                window.loadingUtils.hide();
            }
        }
    },

    // Validate individual field
    validateField(field) {
        if (window.formValidation) {
            return window.formValidation.validateField(field);
        }
        return true;
    },

    // Setup UI components
    setupUIComponents() {
        // Tooltips
        this.setupTooltips();
        
        // Dropdowns
        this.setupDropdowns();
        
        // Modals
        this.setupModals();
        
        // Alerts
        this.setupAlerts();
    },

    // Setup tooltips
    setupTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                this.showTooltip(element);
            });
            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    },

    // Show tooltip
    showTooltip(element) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip absolute bg-gray-800 text-white px-2 py-1 rounded text-sm z-50';
        tooltip.textContent = element.getAttribute('data-tooltip');
        
        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + 'px';
        tooltip.style.top = (rect.top - 30) + 'px';
        
        document.body.appendChild(tooltip);
        element.tooltip = tooltip;
    },

    // Hide tooltip
    hideTooltip() {
        const tooltip = document.querySelector('.tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    },

    // Setup dropdowns
    setupDropdowns() {
        document.addEventListener('click', (e) => {
            // Close all dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.contains(e.target)) {
                    menu.style.display = 'none';
                }
            });

            // Toggle clicked dropdown
            const dropdownToggle = e.target.closest('.dropdown-toggle');
            if (dropdownToggle) {
                e.preventDefault();
                const menu = dropdownToggle.nextElementSibling;
                if (menu && menu.classList.contains('dropdown-menu')) {
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                }
            }
        });
    },

    // Setup modals
    setupModals() {
        // Modal triggers
        document.addEventListener('click', (e) => {
            const modalTrigger = e.target.closest('[data-modal-target]');
            if (modalTrigger) {
                e.preventDefault();
                const modalId = modalTrigger.getAttribute('data-modal-target');
                if (window.modalUtils) {
                    window.modalUtils.show(modalId);
                }
            }

            // Modal close buttons
            const modalClose = e.target.closest('[data-modal-close]');
            if (modalClose) {
                e.preventDefault();
                const modalId = modalClose.getAttribute('data-modal-close');
                if (window.modalUtils) {
                    window.modalUtils.hide(modalId);
                }
            }
        });
    },

    // Setup alerts
    setupAlerts() {
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
    },

    // Show message
    showMessage(message, type = 'info') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} fixed top-4 right-4 p-4 rounded shadow-lg z-50`;
        alert.textContent = message;
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 3000);
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    legacyScriptsReplacement.init();
});

// Global access
window.legacyScriptsReplacement = legacyScriptsReplacement;
