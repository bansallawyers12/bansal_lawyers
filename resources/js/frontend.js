// Frontend JS Bundle - Optimized for Performance
// Core functionality with modern ES6+ features

import './lucide-init.js';
import './vendor-frontend.js';

// Import Alpine.js utilities
import './alpine-utils.js';

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

document.addEventListener('DOMContentLoaded', async function() {
    if (window.AOS && document.querySelector('[data-aos]')) {
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

        if (window.MutationObserver) {
            AOS.refreshHard();
        }
    }

    try {
        await loadExternalScripts();
    } catch (error) {
        console.warn('Some external scripts failed to load:', error);
    }

    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(function() {
            // Scroll handling logic here
        }, 16);
    });
});

window.FrontendBundle = {
    initialized: true,
    version: '2.1.0'
};
