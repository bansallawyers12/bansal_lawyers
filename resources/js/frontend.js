// Frontend JS Bundle - Optimized for Performance
// Core functionality with modern ES6+ features
// vendor-frontend (Swiper, AOS, Lucide) is imported here — layouts must NOT also @vite vendor-frontend.js

import './vendor-frontend.js';

// Import Alpine.js utilities
import './alpine-utils.js';

const scriptAlreadyLoaded = (filename) =>
    Boolean(document.querySelector(`script[src*="${filename}"]`));

/**
 * Dynamically inserted scripts ignore `defer`; use async=false to preserve order.
 */
const loadScript = (src) =>
    new Promise((resolve, reject) => {
        const filename = src.split('/').pop();
        if (scriptAlreadyLoaded(filename)) {
            resolve();
            return;
        }
        const script = document.createElement('script');
        script.src = src;
        script.async = false;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });

const loadExternalScripts = () => {
    const scripts = [];
    const needsParallaxPlugins = document.querySelector(
        '[data-stellar-background-ratio], [data-stellar-ratio], .ftco-animate'
    );

    if (needsParallaxPlugins) {
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

const initAos = () => {
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
};

// Module runs after document parse (end of body) — start plugin fallback immediately
// so main.js stellar/waypoint retries can succeed even when layout gates miss a page.
const externalScriptsReady = loadExternalScripts().catch((error) => {
    console.warn('Some external scripts failed to load:', error);
});

const onReady = async () => {
    initAos();
    await externalScriptsReady;
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onReady);
} else {
    onReady();
}

window.FrontendBundle = {
    initialized: true,
    version: '2.1.1'
};
