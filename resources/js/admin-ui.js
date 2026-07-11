/**
 * Admin UI chrome — vanilla (Phase 5). No jQuery.
 */

export function initAdminUi() {
    const hidePageLoader = () => {
        document.querySelectorAll('.loader').forEach((el) => {
            el.style.opacity = '0';
            el.style.transition = 'opacity 0.4s ease';
            window.setTimeout(() => {
                el.style.display = 'none';
            }, 400);
        });
    };

    if (document.readyState === 'complete') {
        hidePageLoader();
    } else {
        window.addEventListener('load', hidePageLoader);
    }

    const mainContent = document.querySelector('.main-content');
    if (mainContent) {
        mainContent.style.minHeight = `${window.innerHeight - 108}px`;
    }

    document.querySelectorAll('[data-dismiss]').forEach((me) => {
        const target = me.getAttribute('data-dismiss');
        if (!target || target === 'modal') return;
        me.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll(target).forEach((el) => {
                el.style.transition = 'opacity 0.3s ease';
                el.style.opacity = '0';
                window.setTimeout(() => el.remove(), 300);
            });
        });
    });

    document.querySelectorAll('.fullscreen-btn').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen?.();
            } else {
                document.exitFullscreen?.();
            }
        });
    });

    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons();
    }
}
