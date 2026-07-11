// Admin JS Bundle - Optimized for Performance
// Admin functionality with modern ES6+ features

import './lucide-init.js';
import './vendor-admin.js';

// Import Alpine.js utilities
import './alpine-utils.js';

// Import modern components
import { modernSelect } from './components/modern-select.js';
import { ajaxUtils } from './components/ajax-utils.js';
import { formValidation } from './components/form-validation.js';
import { tomSelect } from './components/alpine-select.js';
import { tinyMCE } from './components/alpine-tinymce.js';
import { initAdminFlatpickr } from './components/flatpickr-init.js';

// Register Alpine.js data components globally
if (window.Alpine) {
    window.Alpine.data('tomSelect', tomSelect);
    window.Alpine.data('tinyMCE', tinyMCE);
}

const loadAdminLibraries = async (libraries = []) => {
    const loadedLibraries = {};

    for (const lib of libraries) {
        try {
            switch (lib) {
                case 'tom-select':
                    try {
                        const TomSelectModule = await import('tom-select');
                        window.TomSelect = TomSelectModule.default;
                        loadedLibraries.tomSelect = true;
                    } catch (error) {
                        console.warn('Tom Select not available:', error);
                    }
                    break;

                case 'tinymce':
                    if (typeof tinymce !== 'undefined') {
                        loadedLibraries.tinymce = tinymce;
                    }
                    break;

                case 'datepicker':
                    if (window.flatpickr) {
                        loadedLibraries.datepicker = window.flatpickr;
                    }
                    break;
            }
        } catch (error) {
            console.warn(`Failed to initialize ${lib}:`, error);
        }
    }

    return loadedLibraries;
};

function initAdminSidebarToggle() {
    const sidebar = document.querySelector('.modern-sidebar');
    const toggleButtons = document.querySelectorAll('[data-toggle="sidebar"]');

    if (!sidebar || !toggleButtons.length) {
        return;
    }

    toggleButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('open');
            } else {
                document.body.classList.toggle('admin-sidebar-collapsed');
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', async function() {
    initAdminSidebarToggle();

    const neededLibraries = [];

    if (document.querySelector('.modern-select, select[data-modern-select], select[x-data*="tomSelect"], .js-tom-select')) {
        neededLibraries.push('tom-select');
    }

    if (document.querySelector('textarea[data-tinymce], textarea[x-data*="tinyMCE"]')) {
        neededLibraries.push('tinymce');
    }

    if (document.querySelector('.datepicker, input[data-datepicker], .dobdatepicker, .dobdatepickers, .filterdatepicker, .contract_expiry, .datetimepicker, .daterange, .timepicker, input[data-timepicker]')) {
        neededLibraries.push('datepicker');
    }

    try {
        const loadedLibraries = await loadAdminLibraries(neededLibraries);

        if (loadedLibraries.tomSelect) {
            modernSelect.init('.modern-select:not([x-data]), select[data-modern-select]:not([x-data]), .js-tom-select:not([x-data])', {
                placeholder: 'Select an option',
                allowEmptyOption: true,
                closeAfterSelect: true,
                hideSelected: true
            }).catch(error => {
                console.warn('Modern select initialization failed:', error);
            });
        }

        if (loadedLibraries.datepicker) {
            initAdminFlatpickr();
        }

        if (window.performance && window.performance.mark) {
            window.performance.mark('admin-bundle-loaded');
        }

    } catch (error) {
        console.warn('Some admin libraries failed to load:', error);
    }
});

window.AdminBundle = {
    initialized: true,
    version: '2.1.0'
};
