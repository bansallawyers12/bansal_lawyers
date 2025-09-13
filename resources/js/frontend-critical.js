// Frontend Critical Scripts - Loaded immediately
// Essential scripts that need to be available right away

// Import critical libraries
import 'aos/dist/aos.css';
import 'aos/dist/aos.js';

// Initialize AOS immediately
document.addEventListener('DOMContentLoaded', function() {
    if (window.AOS) {
        AOS.init({
            duration: 800,
            easing: 'slide',
            once: true,
            mirror: false,
            anchorPlacement: 'top-bottom',
            disable: function() {
                return window.innerWidth < 768;
            }
        });
        
        // Suppress deprecated DOM event warnings
        if (window.MutationObserver) {
            AOS.refreshHard();
        }
    }
});

// Export for global access
window.FrontendCritical = {
    initialized: true,
    version: '2.0.0'
};
