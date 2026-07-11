// Frontend JS Bundle - Optimized for Performance
// vendor-frontend (Swiper, AOS, Lucide) is imported here — layouts must NOT also @vite vendor-frontend.js

import './vendor-frontend.js';
import './alpine-utils.js';

const scriptAlreadyLoaded = (filename) =>
    Boolean(document.querySelector(`script[src*="${filename}"]`));

/** Dynamically inserted scripts ignore `defer`; use async=false to preserve order. */
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
    }

    return Promise.all(scripts.map(loadScript));
};

const initAos = () => {
    const aos = window.AOS;
    if (!aos || !document.querySelector('[data-aos]')) {
        return;
    }

    aos.init({
        duration: 800,
        easing: 'slide',
        once: true,
        mirror: false,
        anchorPlacement: 'top-bottom',
        disable: function () {
            return window.innerWidth < 768;
        }
    });

    if (typeof aos.refreshHard === 'function') {
        aos.refreshHard();
    }
};

const initTestimonialsCarousel = () => {
    const SwiperCtor = window.Swiper;
    if (!document.querySelector('.carousel-testimony') || typeof SwiperCtor !== 'function') {
        return false;
    }

    new SwiperCtor('.carousel-testimony', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 8000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        speed: 800,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
    });
    return true;
};

const initTestimonialsWhenReady = (attempts = 0) => {
    if (initTestimonialsCarousel()) {
        return;
    }
    if (attempts < 40) {
        setTimeout(() => initTestimonialsWhenReady(attempts + 1), 100);
    }
};

const externalScriptsReady = loadExternalScripts().catch((error) => {
    console.warn('Some external scripts failed to load:', error);
});

const onReady = async () => {
    initAos();
    initTestimonialsWhenReady();
    await externalScriptsReady;
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onReady);
} else {
    onReady();
}

window.FrontendBundle = {
    initialized: true,
    version: '2.2.1'
};
