// Frontend JS Bundle — marketing pages (Phase 4)
// Lucide is light (tree-shaken). Alpine / Swiper / AOS load on demand.

import './lucide-init.js';
import { loadTurnstile } from './shared/turnstile-loader.js';

window.loadTurnstile = loadTurnstile;

const loadAlpine = () => {
    if (window.Alpine || window.__alpineStarted) {
        return Promise.resolve();
    }
    if (!document.querySelector('[x-data], [x-cloak], [x-show], [x-bind], [x-on], [x-model], [x-text], [x-html]')) {
        return Promise.resolve();
    }
    return import('./alpine-utils.js');
};

const loadAos = async () => {
    if (!document.querySelector('[data-aos], .ftco-animate')) {
        return null;
    }
    const [{ default: AOS }] = await Promise.all([
        import('aos'),
        import('aos/dist/aos.css'),
    ]);
    window.AOS = AOS;
    return AOS;
};

const initAos = async () => {
    const aos = await loadAos();
    if (!aos) {
        return;
    }

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

const initTestimonialsCarousel = async () => {
    const el = document.querySelector('.carousel-testimony');
    if (!el || el.dataset.swiperReady === '1') {
        return;
    }

    const [{ default: Swiper }] = await Promise.all([
        import('swiper/bundle'),
        import('swiper/css/bundle'),
    ]);

    window.Swiper = Swiper;
    el.dataset.swiperReady = '1';

    new Swiper('.carousel-testimony', {
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
};

const lazyInitTestimonials = () => {
    const el = document.querySelector('.carousel-testimony');
    if (!el) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        initTestimonialsCarousel();
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            if (entries.some((entry) => entry.isIntersecting)) {
                observer.disconnect();
                initTestimonialsCarousel();
            }
        },
        { rootMargin: '200px' }
    );
    observer.observe(el);
};

const onReady = () => {
    loadAlpine();
    initAos();
    initHeroParallax();
    lazyInitTestimonials();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onReady);
} else {
    onReady();
}

window.FrontendBundle = {
    initialized: true,
    version: '4.0.0',
};
