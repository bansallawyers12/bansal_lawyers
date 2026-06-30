// Frontend vendor bundle
import './lucide-init.js';

import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

window.Swiper = Swiper;

document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons();
    }
});

export default Swiper;
