// Frontend JS Bundle - Optimized for Performance
// Core functionality with modern ES6+ features

// Import Alpine.js utilities
import './alpine-utils.js';

// Import critical frontend styles
import '../../public/css/animate.min.css';
import '../../public/css/flaticon.min.css';
import '../../public/css/icomoon.min.css';

// Import AOS (Animate On Scroll) - critical for animations
import 'aos/dist/aos.css';
import 'aos/dist/aos.js';

// Lazy load non-critical libraries
const loadNonCriticalLibraries = async () => {
    // Load Owl Carousel
    const { default: OwlCarousel } = await import('owl.carousel');
    import('owl.carousel/dist/assets/owl.carousel.css');
    import('owl.carousel/dist/assets/owl.theme.default.css');
    
    // Load Magnific Popup
    const { default: MagnificPopup } = await import('magnific-popup');
    import('magnific-popup/dist/magnific-popup.css');
    
    return { OwlCarousel, MagnificPopup };
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
        const { OwlCarousel, MagnificPopup } = await loadNonCriticalLibraries();
        
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
    if (typeof process === 'undefined' || process.env.NODE_ENV !== 'development') {
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
