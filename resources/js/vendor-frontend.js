// Keep lucide icons; Swiper/AOS are dynamic-imported from frontend.js when needed
import './lucide-init.js';

document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons();
    }
});
