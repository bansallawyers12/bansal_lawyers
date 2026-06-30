/**
 * Modern confirm dialog for admin destructive actions (replaces window.confirm).
 */
(function () {
    'use strict';

    var deletePresets = {
        cms_pages: {
            title: 'Delete CMS Page?',
            message: 'This action cannot be undone. The following will be permanently removed:',
            details: ['Page content and metadata', 'Associated images and PDF files', 'All related data'],
            confirmText: 'Delete Page',
            icon: 'trash-2',
            variant: 'danger'
        },
        blogs: {
            title: 'Delete Blog Post?',
            message: 'This action cannot be undone. The following will be permanently removed:',
            details: ['Blog post content', 'Featured image and attachments', 'All related data'],
            confirmText: 'Delete Post',
            icon: 'trash-2',
            variant: 'danger'
        },
        blog_categories: {
            title: 'Delete Category?',
            message: 'This category will be permanently removed. Posts linked to it may be affected.',
            confirmText: 'Delete Category',
            icon: 'trash-2',
            variant: 'danger'
        },
        recent_cases: {
            title: 'Delete Case Study?',
            message: 'This case study will be permanently removed from the website.',
            confirmText: 'Delete Case',
            icon: 'trash-2',
            variant: 'danger'
        },
        book_service_disable_slots: {
            title: 'Delete Blocked Slot?',
            message: 'This blocked booking slot will be removed and may become available again.',
            confirmText: 'Delete Slot',
            icon: 'trash-2',
            variant: 'danger'
        },
        default: {
            title: 'Delete this item?',
            message: 'This action cannot be undone. All related data may be permanently removed.',
            confirmText: 'Delete',
            icon: 'trash-2',
            variant: 'danger'
        }
    };

    var dialog = null;
    var titleEl = null;
    var messageEl = null;
    var detailsEl = null;
    var iconWrap = null;
    var okBtn = null;
    var cancelBtns = null;
    var activeResolve = null;
    var previousFocus = null;

    function getDialog() {
        if (dialog) {
            return dialog;
        }
        dialog = document.getElementById('admin-confirm-dialog');
        if (!dialog) {
            return null;
        }
        titleEl = document.getElementById('admin-confirm-title');
        messageEl = document.getElementById('admin-confirm-message');
        detailsEl = document.getElementById('admin-confirm-details');
        iconWrap = document.getElementById('admin-confirm-icon');
        okBtn = document.getElementById('admin-confirm-ok');
        cancelBtns = dialog.querySelectorAll('[data-confirm-cancel]');

        okBtn.addEventListener('click', function () {
            closeDialog(true);
        });

        cancelBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                closeDialog(false);
            });
        });

        document.addEventListener('keydown', function (event) {
            if (!dialog || dialog.hidden || !dialog.classList.contains('is-open')) {
                return;
            }
            if (event.key === 'Escape') {
                event.preventDefault();
                closeDialog(false);
            }
        });

        return dialog;
    }

    function setIcon(variant, iconName) {
        if (!iconWrap) {
            return;
        }
        iconWrap.className = 'admin-confirm-icon admin-confirm-icon--' + (variant || 'danger');
        var icon = iconWrap.querySelector('i');
        if (icon) {
            icon.setAttribute('data-lucide', iconName || 'triangle-alert');
            if (typeof window.refreshLucideIcons === 'function') {
                window.refreshLucideIcons(iconWrap);
            }
        }
    }

    function closeDialog(result) {
        if (!dialog || !activeResolve) {
            return;
        }
        dialog.classList.remove('is-open');
        dialog.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';

        var resolve = activeResolve;
        activeResolve = null;

        window.setTimeout(function () {
            dialog.hidden = true;
            if (previousFocus && typeof previousFocus.focus === 'function') {
                previousFocus.focus();
            }
            resolve(result);
        }, 200);
    }

    function normalizeOptions(options) {
        if (typeof options === 'string') {
            return { message: options };
        }
        return options || {};
    }

    window.adminConfirm = function (options) {
        return new Promise(function (resolve) {
            var el = getDialog();
            if (!el) {
                resolve(window.confirm(normalizeOptions(options).message || 'Are you sure?'));
                return;
            }

            var opts = normalizeOptions(options);

            titleEl.textContent = opts.title || 'Are you sure?';
            messageEl.textContent = opts.message || '';
            okBtn.textContent = opts.confirmText || 'Confirm';

            detailsEl.innerHTML = '';
            if (Array.isArray(opts.details) && opts.details.length) {
                opts.details.forEach(function (item) {
                    var li = document.createElement('li');
                    li.textContent = item;
                    detailsEl.appendChild(li);
                });
            }

            setIcon(opts.variant || 'danger', opts.icon || 'triangle-alert');

            previousFocus = document.activeElement;
            activeResolve = resolve;

            el.hidden = false;
            el.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            window.requestAnimationFrame(function () {
                el.classList.add('is-open');
                okBtn.focus();
            });
        });
    };

    window.adminConfirmForDelete = function (table, overrides) {
        var preset = deletePresets[table] || deletePresets.default;
        var options = Object.assign({}, preset, overrides || {});
        return window.adminConfirm(options);
    };
})();
