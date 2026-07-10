// Frontend vendor bundle
import './lucide-init.js';

import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import AOS from 'aos';

window.Swiper = Swiper;
window.AOS = AOS;

document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons();
    }
});

export default Swiper;
