// Admin vendor bundle

import './lucide-init.js';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

window.flatpickr = flatpickr;

document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons();
    }
});

export { flatpickr };
