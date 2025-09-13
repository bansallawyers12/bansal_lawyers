// Frontend Animation Scripts - Loaded on demand
// Animation and visual effects libraries

// Import animation libraries
import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

// Import Magnific Popup
import 'magnific-popup/dist/magnific-popup.css';
import 'magnific-popup';

// Import Stellar.js for parallax effects
// Note: Stellar.js needs to be loaded from CDN or local file as it's not available as npm package
const loadStellar = () => {
    return new Promise((resolve, reject) => {
        if (window.Stellar) {
            resolve();
            return;
        }
        
        const script = document.createElement('script');
        script.src = '/js/jquery.stellar.min.js';
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

// Import Waypoints for scroll triggers
// Note: Waypoints needs to be loaded from CDN or local file as it's not available as npm package
const loadWaypoints = () => {
    return new Promise((resolve, reject) => {
        if (window.Waypoint) {
            resolve();
            return;
        }
        
        const script = document.createElement('script');
        script.src = '/js/jquery.waypoints.min.js';
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

// Initialize animations when loaded
document.addEventListener('DOMContentLoaded', async function() {
    try {
        // Load external dependencies
        await Promise.all([
            loadStellar(),
            loadWaypoints()
        ]);
        
        // Initialize Owl Carousel
        if (window.$ && window.$.fn && window.$.fn.owlCarousel) {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: { items: 1 },
                    600: { items: 3 },
                    1000: { items: 5 }
                }
            });
        }
        
        // Initialize Magnific Popup
        if (window.$ && window.$.fn && window.$.fn.magnificPopup) {
            $('.popup-image').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
        
        // Initialize Stellar for parallax
        if (window.Stellar) {
            $(window).stellar({
                responsive: true,
                horizontalScrolling: false,
                verticalOffset: 0
            });
        }
        
    } catch (error) {
        console.warn('Some animation libraries failed to load:', error);
    }
});

// Export for global access
window.FrontendAnimations = {
    initialized: true,
    version: '2.0.0'
};
