/**
 * Admin modal helpers — vanilla (Phase 6). Keeps showAdminModal / hideAdminModal API.
 * No Bootstrap JS.
 */

function resolveElement(target) {
    if (!target) return null;
    if (typeof target === 'string') return document.querySelector(target);
    if (target.nodeType) return target;
    if (target[0]?.nodeType) return target[0];
    return null;
}

const modalState = new WeakMap();

function ensureBackdrop() {
    let backdrop = document.querySelector('.modal-backdrop');
    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        document.body.appendChild(backdrop);
    } else {
        backdrop.classList.add('show');
    }
    return backdrop;
}

function removeBackdropIfIdle() {
    if (document.querySelector('.modal.show')) return;
    document.querySelectorAll('.modal-backdrop').forEach((el) => el.remove());
    document.body.classList.remove('modal-open');
    document.body.style.removeProperty('overflow');
    document.body.style.removeProperty('padding-right');
}

export function showAdminModal(target, options = {}) {
    const el = resolveElement(target);
    if (!el) return null;

    const opts = {
        backdrop: options.backdrop !== undefined ? options.backdrop : true,
        keyboard: options.keyboard !== undefined ? options.keyboard : true,
        focus: options.focus !== undefined ? options.focus : true,
    };

    modalState.set(el, opts);

    if (opts.backdrop !== false) {
        ensureBackdrop();
    }

    el.style.display = 'block';
    el.classList.add('show');
    el.setAttribute('aria-modal', 'true');
    el.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
    document.body.style.overflow = 'hidden';

    if (opts.focus !== false) {
        const focusable = el.querySelector(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        window.setTimeout(() => focusable?.focus?.(), 10);
    }

    el.dispatchEvent(new CustomEvent('admin-modal:shown', { bubbles: true }));
    return { element: el, hide: () => hideAdminModal(el) };
}

export function hideAdminModal(target) {
    const el = resolveElement(target);
    if (!el) return;

    el.classList.remove('show');
    el.style.display = 'none';
    el.setAttribute('aria-hidden', 'true');
    el.removeAttribute('aria-modal');
    modalState.delete(el);
    removeBackdropIfIdle();
    el.dispatchEvent(new CustomEvent('admin-modal:hidden', { bubbles: true }));
}

window.showAdminModal = showAdminModal;
window.hideAdminModal = hideAdminModal;

/** @deprecated name kept for admin.js import — no Bootstrap */
export function initBootstrapUi() {
    initAdminChromeUi();
}

export function initAdminChromeUi() {
    document.addEventListener('click', (event) => {
        const dismissModal = event.target.closest?.(
            '[data-bs-dismiss="modal"], [data-dismiss="modal"], [data-admin-dismiss="modal"]'
        );
        if (dismissModal) {
            const modal = dismissModal.closest('.modal');
            if (modal) {
                event.preventDefault();
                hideAdminModal(modal);
            }
            return;
        }

        const dismissAlert = event.target.closest?.(
            '[data-bs-dismiss="alert"], [data-admin-dismiss="alert"]'
        );
        if (dismissAlert) {
            const alert = dismissAlert.closest('.alert');
            if (alert) {
                event.preventDefault();
                alert.remove();
            }
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        const open = document.querySelector('.modal.show');
        if (!open) return;
        const opts = modalState.get(open);
        if (opts && opts.keyboard === false) return;
        hideAdminModal(open);
    });

    // Outside click closes (unless static). Clicks hit .modal (above backdrop), not .modal-backdrop.
    document.addEventListener('mousedown', (event) => {
        const open = document.querySelector('.modal.show');
        if (!open) return;
        const opts = modalState.get(open);
        if (opts?.backdrop === 'static' || opts?.backdrop === false) return;

        const hitBackdrop = event.target.classList?.contains('modal-backdrop');
        const hitModalChrome = event.target === open;
        if (!hitBackdrop && !hitModalChrome) return;
        hideAdminModal(open);
    });

    // Assign-modal status/priority menus (BS4 data-toggle="dropdown" markup)
    document.addEventListener('click', (event) => {
        const toggle = event.target.closest?.('[data-toggle="dropdown"], [data-bs-toggle="dropdown"]');
        if (toggle) {
            event.preventDefault();
            const dropdown = toggle.closest('.dropdown');
            const menu = dropdown?.querySelector('.dropdown-menu');
            if (!menu) return;

            const wasOpen = menu.classList.contains('show');
            document.querySelectorAll('.dropdown-menu.show').forEach((el) => {
                el.classList.remove('show');
                el.closest('.dropdown')?.classList.remove('show');
            });
            if (!wasOpen) {
                menu.classList.add('show');
                dropdown?.classList.add('show');
            }
            return;
        }

        if (
            !event.target.closest?.('.dropdown') ||
            event.target.closest?.('.dropdown-item')
        ) {
            document.querySelectorAll('.dropdown-menu.show').forEach((el) => {
                el.classList.remove('show');
                el.closest('.dropdown')?.classList.remove('show');
            });
        }
    });
}
