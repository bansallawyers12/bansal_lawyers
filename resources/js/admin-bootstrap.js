/**
 * Admin Bootstrap 5 helpers (Phase 5 — no jQuery shim).
 */
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

function resolveElement(target) {
    if (!target) return null;
    if (typeof target === 'string') return document.querySelector(target);
    if (target.nodeType) return target;
    // Legacy jQuery-like objects (defensive)
    if (target[0]?.nodeType) return target[0];
    return null;
}

export function showAdminModal(target, options = {}) {
    const el = resolveElement(target);
    if (!el || !window.bootstrap?.Modal) return null;
    const instance = bootstrap.Modal.getOrCreateInstance(el, {
        backdrop: options.backdrop !== undefined ? options.backdrop : true,
        keyboard: options.keyboard !== undefined ? options.keyboard : true,
        focus: options.focus !== undefined ? options.focus : true,
    });
    if (options.show !== false) {
        instance.show();
    }
    return instance;
}

export function hideAdminModal(target) {
    const el = resolveElement(target);
    if (!el || !window.bootstrap?.Modal) return;
    const instance = bootstrap.Modal.getInstance(el) || bootstrap.Modal.getOrCreateInstance(el);
    instance.hide();
}

window.showAdminModal = showAdminModal;
window.hideAdminModal = hideAdminModal;

export function initBootstrapUi() {
    if (!window.bootstrap) return;

    document.querySelectorAll('[data-bs-toggle="tooltip"], [data-toggle="tooltip"]').forEach((el) => {
        bootstrap.Tooltip.getOrCreateInstance(el);
    });

    document.querySelectorAll('[data-bs-toggle="popover"], [data-toggle="popover"]').forEach((el) => {
        bootstrap.Popover.getOrCreateInstance(el, { container: 'body' });
    });

    document.querySelectorAll('[data-dismiss="modal"]').forEach((el) => {
        if (!el.hasAttribute('data-bs-dismiss')) {
            el.setAttribute('data-bs-dismiss', 'modal');
        }
    });
}
