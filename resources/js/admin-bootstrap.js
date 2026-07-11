/**
 * Admin Bootstrap 5 helpers + thin jQuery .modal() shim.
 * Replaces static BS4 bootstrap.bundle.min.js.
 */
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

function resolveElement(target) {
    if (!target) return null;
    if (typeof target === 'string') return document.querySelector(target);
    if (target.jquery) return target[0] || null;
    if (target.nodeType) return target;
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

/**
 * jQuery plugin shim so legacy `$('#x').modal('show'|'hide'|{})` uses BS5.
 */
export function installJqueryModalShim($) {
    if (!$ || $.fn.modal?.__adminBs5Shim) {
        return;
    }

    $.fn.modal = function (actionOrOptions) {
        return this.each(function () {
            if (actionOrOptions === 'hide') {
                hideAdminModal(this);
                return;
            }
            if (actionOrOptions === 'show' || actionOrOptions === undefined) {
                showAdminModal(this);
                return;
            }
            if (actionOrOptions && typeof actionOrOptions === 'object') {
                showAdminModal(this, actionOrOptions);
            }
        });
    };
    $.fn.modal.__adminBs5Shim = true;
}

export function initBootstrapUi() {
    if (!window.bootstrap) return;

    document.querySelectorAll('[data-bs-toggle="tooltip"], [data-toggle="tooltip"]').forEach((el) => {
        bootstrap.Tooltip.getOrCreateInstance(el);
    });

    document.querySelectorAll('[data-bs-toggle="popover"], [data-toggle="popover"]').forEach((el) => {
        bootstrap.Popover.getOrCreateInstance(el, { container: 'body' });
    });

    // Bridge legacy data-dismiss="modal" to BS5 dismiss
    document.querySelectorAll('[data-dismiss="modal"]').forEach((el) => {
        if (!el.hasAttribute('data-bs-dismiss')) {
            el.setAttribute('data-bs-dismiss', 'modal');
        }
    });
}
