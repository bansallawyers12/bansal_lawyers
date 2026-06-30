// Frontend JS Bundle - Optimized for Performance
// Core functionality with modern ES6+ features

import './lucide-init.js';
import './vendor-frontend.js';

// Import Alpine.js utilities
import './alpine-utils.js';

// Note: CSS files should be imported in CSS entry points (resources/css/frontend.css)
// or loaded via Vite's CSS handling. These public CSS files are loaded via
// asset() helper in Blade templates, so we don't import them here.

// Import AOS (Animate On Scroll) - critical for animations
// Note: AOS is loaded via CDN in layout files (resources/views/layouts/frontend.blade.php)
// If you want to use npm version, install: npm install aos
// Then uncomment and use:
// import 'aos/dist/aos.css';
// import AOS from 'aos';
// window.AOS = AOS;

// Lazy load non-critical libraries
// Note: These libraries are loaded via CDN/asset() in Blade templates and marked as external in vite.config.js
const loadNonCriticalLibraries = async () => {
    // Owl Carousel removed - now using Swiper.js (loaded via CDN in layout)
    
    // Magnific Popup is loaded via asset() in frontend.blade.php
    // Check if it's already loaded
    const MagnificPopup = window.$ && window.$.fn && window.$.fn.magnificPopup 
        ? window.$.fn.magnificPopup 
        : null;
    
    return { MagnificPopup };
};

// Load external scripts only when the page needs them and they are not already in the layout
const scriptAlreadyLoaded = (filename) =>
    Boolean(document.querySelector(`script[src*="${filename}"]`));

const loadScript = (src) =>
    new Promise((resolve, reject) => {
        const filename = src.split('/').pop();
        if (scriptAlreadyLoaded(filename)) {
            resolve();
            return;
        }
        const script = document.createElement('script');
        script.src = src;
        script.defer = true;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });

const loadExternalScripts = () => {
    const scripts = [];
    const hasStellarElements = document.querySelector('[data-stellar-background-ratio], [data-stellar-ratio]');

    if (hasStellarElements) {
        if (!scriptAlreadyLoaded('jquery.waypoints.min.js')) {
            scripts.push('/js/jquery.waypoints.min.js');
        }
        if (!scriptAlreadyLoaded('jquery.stellar.min.js')) {
            scripts.push('/js/jquery.stellar.min.js');
        }
        if (!scriptAlreadyLoaded('scrollax.min.js')) {
            scripts.push('/js/scrollax.min.js');
        }
    }

    return Promise.all(scripts.map(loadScript));
};

// Performance optimizations
document.addEventListener('DOMContentLoaded', async function() {
    // Initialize AOS immediately (already imported)
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
    
    // Load non-critical libraries asynchronously
    try {
        const { MagnificPopup } = await loadNonCriticalLibraries();
        
        // Owl Carousel removed - carousels now use Swiper.js (initialized in layout files)
        
        // Initialize Magnific Popup
        if (window.$ && window.$.fn && window.$.fn.magnificPopup) {
            $('.popup-image').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
        
    } catch (error) {
        console.warn('Some frontend libraries failed to load:', error);
    }
    
    // Load external scripts asynchronously
    try {
        await loadExternalScripts();
        
        // Stellar.js initialization is handled by main.js which includes the particles fix
        // Skip initialization here to avoid conflicts - main.js loads last and patches the instance
        
    } catch (error) {
        console.warn('Some external scripts failed to load:', error);
    }
    
    // Optimize scroll events with throttling
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(function() {
            // Scroll handling logic here
        }, 16); // ~60fps
    });
});

// Export for global access if needed
window.FrontendBundle = {
    initialized: true,
    version: '2.0.0'
};
