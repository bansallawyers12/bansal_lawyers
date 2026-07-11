// Admin JS Bundle — no jQuery (Phase 5)
// Bootstrap 5 + Axios + Alpine via Vite

import './lucide-init.js';
import './vendor-admin.js';
import './alpine-utils.js';
import './admin-http.js';

import { initBootstrapUi, showAdminModal, hideAdminModal } from './admin-bootstrap.js';
import { modernSelect } from './components/modern-select.js';
import { tomSelect } from './components/alpine-select.js';
import { tinyMCE } from './components/alpine-tinymce.js';
import { initAdminFlatpickr } from './components/flatpickr-init.js';

import './admin-confirm.js';
import { initAdminCspActions } from './admin-csp-actions.js';
import './admin-custom-validate.js';
import { initAdminCrud } from './admin-crud.js';
import { initAdminUi } from './admin-ui.js';

if (window.Alpine) {
    window.Alpine.data('tomSelect', tomSelect);
    window.Alpine.data('tinyMCE', tinyMCE);
}

/** Single Tom Select owner — layout helpers and pages call this. */
async function ensureTomSelect() {
    if (window.TomSelect) return window.TomSelect;
    const mod = await import('tom-select');
    window.TomSelect = mod.default;
    return window.TomSelect;
}

window.initTomSelect = function initTomSelect(selector, options = {}) {
    const element = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!element) {
        console.warn('Element not found for selector:', selector);
        return null;
    }

    return ensureTomSelect().then((TomSelect) => {
        if (element.tomselect) {
            element.tomselect.destroy();
        }
        const config = {
            plugins: ['clear_button'],
            placeholder: options.placeholder || 'Select an option',
            allowEmptyOption: true,
            ...options,
        };
        if (config.width) {
            element.style.width = config.width;
            delete config.width;
        }
        try {
            const instance = new TomSelect(element, config);
            element.tomselect = instance;
            return instance;
        } catch (error) {
            console.error('Failed to initialize Tom Select:', error);
            return null;
        }
    });
};

window.initDynamicTomSelects = function initDynamicTomSelects(scope) {
    const root = scope || document;
    root.querySelectorAll('.js-tom-select, select[data-modern-select], .modern-select').forEach((select) => {
        if (select.closest('[x-data*="tomSelect"]')) return;
        if (!select.tomselect) {
            window.initTomSelect(select);
        }
    });
    if (typeof window.initAdminFlatpickr === 'function') {
        window.initAdminFlatpickr();
    }
};

function initAdminSidebarToggle() {
    const sidebar = document.querySelector('.modern-sidebar');
    const toggleButtons = document.querySelectorAll('[data-toggle="sidebar"]');
    if (!sidebar || !toggleButtons.length) return;

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

document.addEventListener('DOMContentLoaded', async () => {
    initAdminSidebarToggle();
    initAdminUi();
    initAdminCspActions();
    initAdminCrud();
    initBootstrapUi();

    const needsTom = document.querySelector(
        '.modern-select, select[data-modern-select], select[x-data*="tomSelect"], .js-tom-select'
    );
    const needsDate = document.querySelector(
        '.datepicker, input[data-datepicker], .dobdatepicker, .dobdatepickers, .filterdatepicker, .contract_expiry, .datetimepicker, .daterange, .timepicker, input[data-timepicker], .followup_date'
    );

    try {
        if (needsTom) {
            await ensureTomSelect();
            await modernSelect.init(
                '.modern-select:not([x-data]), select[data-modern-select]:not([x-data]), .js-tom-select:not([x-data])',
                {
                    placeholder: 'Select an option',
                    allowEmptyOption: true,
                    closeAfterSelect: true,
                    hideSelected: true,
                }
            );
        }

        if (needsDate || window.flatpickr) {
            initAdminFlatpickr();
        }
    } catch (error) {
        console.warn('Some admin libraries failed to load:', error);
    }
});

window.AdminBundle = {
    initialized: true,
    version: '4.0.0',
    showModal: showAdminModal,
    hideModal: hideAdminModal,
};
