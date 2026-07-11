// Frontend JS Bundle — marketing pages (Phase 4)
// No jQuery / Bootstrap JS / Stellar / Waypoints.
// vendor-frontend (Swiper, AOS, Lucide) is imported here — layouts must NOT also @vite vendor-frontend.js

import './vendor-frontend.js';
import './alpine-utils.js';

const initAos = () => {
    const aos = window.AOS;
    if (!aos) {
        return;
    }

    // Theme CSS still hides .ftco-animate until waypoints fire — migrate leftovers (CMS HTML).
    document.querySelectorAll('.ftco-animate').forEach((el) => {
        if (!el.hasAttribute('data-aos')) {
            const effect = el.getAttribute('data-animate-effect');
            const map = {
                fadeIn: 'fade',
                fadeInLeft: 'fade-left',
                fadeInRight: 'fade-right',
            };
            el.setAttribute('data-aos', map[effect] || 'fade-up');
        }
        el.classList.remove('ftco-animate', 'item-animate', 'ftco-animated');
    });

    if (!document.querySelector('[data-aos]')) {
        return;
    }

    aos.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        mirror: false,
        anchorPlacement: 'top-bottom',
        disable: () => window.innerWidth < 768,
    });

    if (typeof aos.refreshHard === 'function') {
        aos.refreshHard();
    }
};

/** Light background-position parallax for heroes (replaces jQuery Stellar). */
const initHeroParallax = () => {
    const heroes = document.querySelectorAll('[data-parallax-bg]');
    if (!heroes.length || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }
    if (window.innerWidth < 768) {
        return;
    }

    let ticking = false;
    const update = () => {
        const y = window.scrollY || window.pageYOffset;
        heroes.forEach((el) => {
            const ratio = parseFloat(el.getAttribute('data-parallax-bg') || '0.5') || 0.5;
            el.style.backgroundPosition = `center ${Math.round(y * ratio * -1)}px`;
        });
        ticking = false;
    };

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                window.requestAnimationFrame(update);
                ticking = true;
            }
        },
        { passive: true }
    );
    update();
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

const onReady = () => {
    initAos();
    initHeroParallax();
    initTestimonialsWhenReady();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onReady);
} else {
    onReady();
}

window.FrontendBundle = {
    initialized: true,
    version: '3.0.0',
};
