// Frontend JS Bundle - Optimized for Performance
// Core functionality with modern ES6+ features

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
const loadNonCriticalLibraries = async () => {
    // Owl Carousel removed - now using Swiper.js (loaded via CDN in layout)
    
    // Load Magnific Popup
    const { default: MagnificPopup } = await import('magnific-popup');
    import('magnific-popup/dist/magnific-popup.css');
    
    return { MagnificPopup };
};

// Load external scripts that aren't available as npm packages
const loadExternalScripts = () => {
    const scripts = [
        '/js/jquery.easing.1.3.min.js',
        '/js/jquery.waypoints.min.js',
        '/js/jquery.stellar.min.js',
        '/js/jquery.animateNumber.min.js',
        '/js/scrollax.min.js'
    ];
    
    return Promise.all(scripts.map(src => {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = src;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }));
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
        
        // Initialize Stellar for parallax effects
        if (window.Stellar) {
            $(window).stellar({
                responsive: true,
                horizontalScrolling: false,
                verticalOffset: 0
            });
        }
        
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
    
    // Preload critical resources only if they exist and are needed
    const criticalImages = [
        '/images/logo/Bansal_Lawyers.png',
        '/images/logo/Bansal_Lawyers_scroll.png'
    ];
    
    // Only preload if we're not in development mode to avoid warnings
    if (import.meta.env.MODE !== 'development') {
        criticalImages.forEach(src => {
            // Check if image exists before preloading
            const img = new Image();
            img.onload = () => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = src;
                document.head.appendChild(link);
            };
            img.onerror = () => {
                // Image doesn't exist, skip preloading
            };
            img.src = src;
        });
    }
});

// Export for global access if needed
window.FrontendBundle = {
    initialized: true,
    version: '2.0.0'
};
