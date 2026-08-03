// Frontend JS Bundle — marketing pages (Phase 4)
// Lucide / Alpine / Swiper / AOS load after paint so LCP stays clean.

import { loadTurnstile } from './shared/turnstile-loader.js';

window.loadTurnstile = loadTurnstile;

const afterPaint = (fn, timeout = 2000) => {
    if ('requestIdleCallback' in window) {
        requestIdleCallback(fn, { timeout });
        return;
    }
    requestAnimationFrame(() => setTimeout(fn, 0));
};

const loadAlpine = () => {
    if (window.Alpine || window.__alpineStarted) {
        return Promise.resolve();
    }
    if (!document.querySelector('[x-data], [x-cloak], [x-show], [x-bind], [x-on], [x-model], [x-text], [x-html]')) {
        return Promise.resolve();
    }
    return import('./alpine-utils.js');
};

const bootIcons = () => {
    import('./lucide-init.js').catch(() => {});
};

const loadAos = async () => {
    if (!document.querySelector('[data-aos], .ftco-animate')) {
        return null;
    }
    // Skip AOS on mobile / reduced-motion — same visual (AOS already disabled under 768px)
    if (window.innerWidth < 768 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
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

const showDecorHero = () => {
    document
        .querySelectorAll(
            '.page-case .experimental-case-hero, .page-blog .experimental-blog-hero, .page-contact .photo-background'
        )
        .forEach((el) => {
            if (!el.classList.contains('hero-has-photo')) {
                el.classList.add('hero-has-photo');
            }
        });
};

const initLazyMaps = () => {
    const containers = document.querySelectorAll('[data-map-src]');
    if (!containers.length) {
        return;
    }

    const loadMap = (container) => {
        if (container.dataset.mapReady === '1') {
            return;
        }
        const src = container.getAttribute('data-map-src');
        if (!src) {
            return;
        }
        container.dataset.mapReady = '1';
        const iframe = document.createElement('iframe');
        iframe.src = src;
        iframe.title = container.getAttribute('data-map-title') || 'Map';
        iframe.loading = 'lazy';
        iframe.referrerPolicy = 'no-referrer-when-downgrade';
        iframe.allow = 'fullscreen';
        iframe.setAttribute('allowfullscreen', '');
        container.appendChild(iframe);
    };

    if (!('IntersectionObserver' in window)) {
        containers.forEach((c) => afterPaint(() => loadMap(c), 2500));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    observer.unobserve(entry.target);
                    afterPaint(() => loadMap(entry.target), 800);
                }
            });
        },
        { rootMargin: '180px' }
    );

    containers.forEach((c) => observer.observe(c));
};

const onReady = () => {
    // Icons soon after paint so other Lucide marks appear; critical icons use inline SVG
    afterPaint(bootIcons, 400);
    afterPaint(() => {
        loadAlpine();
        initAos();
        initHeroParallax();
        initLazyMaps();
    }, 2000);
    lazyInitTestimonials();

    // Decorative hero/background photos — after LCP so they never delay paint
    window.addEventListener('scroll', showDecorHero, { once: true, passive: true });
    window.addEventListener('pointerdown', showDecorHero, { once: true });
    setTimeout(showDecorHero, 4000);
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onReady);
} else {
    onReady();
}

window.FrontendBundle = {
    initialized: true,
    version: '4.1.0',
};
