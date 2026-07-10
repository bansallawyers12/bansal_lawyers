// Admin vendor bundle

import './lucide-init.js';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { initAdminFlatpickr } from './components/flatpickr-init.js';

window.flatpickr = flatpickr;

document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons();
    }

    initAdminFlatpickr();
});

export { flatpickr };
