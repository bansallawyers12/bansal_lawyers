/**
 * Live admin UI chrome formerly in scripts.js (loader, fullscreen, content min-height).
 * Dead theme / .main-sidebar / duplicate Tom Select & Flatpickr inits are not ported.
 */

export function initAdminUi() {
    const $ = window.jQuery;
    if (!$) return;

    $(window).on('load', () => {
        $('.loader').fadeOut('slow');
    });

    if (document.readyState === 'complete') {
        $('.loader').fadeOut('slow');
    }

    const mainContent = document.querySelector('.main-content');
    if (mainContent) {
        $(mainContent).css({
            minHeight: `${$(window).height() - 108}px`,
        });
    }

    $('[data-dismiss]').each(function () {
        const me = $(this);
        const target = me.data('dismiss');
        if (target === 'modal') return;
        me.on('click', () => {
            $(target).fadeOut(function () {
                $(this).remove();
            });
            return false;
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
