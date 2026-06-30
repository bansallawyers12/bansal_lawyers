/**
 * CSP-safe delegated handlers for admin UI actions.
 * Replaces href="javascript:;" and inline onclick handlers blocked by strict CSP.
 */
(function () {
    'use strict';

    function callIfFn(name, args) {
        var fn = window[name];
        if (typeof fn === 'function') {
            fn.apply(window, args || []);
        }
    }

    document.addEventListener('click', function (event) {
        var target = event.target;

        var deleteEl = target.closest('[data-delete-action]');
        if (deleteEl) {
            event.preventDefault();
            if (typeof window.deleteAction === 'function') {
                window.deleteAction(
                    deleteEl.getAttribute('data-id'),
                    deleteEl.getAttribute('data-table')
                );
            }
            return;
        }

        var updateEl = target.closest('[data-update-action]');
        if (updateEl) {
            event.preventDefault();
            if (typeof window.updateAction === 'function') {
                window.updateAction(
                    parseInt(updateEl.getAttribute('data-id'), 10),
                    parseInt(updateEl.getAttribute('data-status'), 10),
                    updateEl.getAttribute('data-table'),
                    updateEl.getAttribute('data-col') || 'status'
                );
            }
            return;
        }

        var archiveEl = target.closest('[data-archive-action]');
        if (archiveEl) {
            event.preventDefault();
            if (typeof window.archiveAction === 'function') {
                window.archiveAction(
                    archiveEl.getAttribute('data-id'),
                    archiveEl.getAttribute('data-table')
                );
            }
            return;
        }

        var slotEl = target.closest('[data-delete-slot-action]');
        if (slotEl) {
            event.preventDefault();
            if (typeof window.deleteSlotAction === 'function') {
                window.deleteSlotAction(
                    slotEl.getAttribute('data-id'),
                    slotEl.getAttribute('data-table')
                );
            }
            return;
        }

        var validateEl = target.closest('[data-custom-validate]');
        if (validateEl) {
            event.preventDefault();
            if (typeof window.customValidate === 'function') {
                window.customValidate(validateEl.getAttribute('data-custom-validate'));
            }
            return;
        }

        var submitEl = target.closest('[data-form-submit]');
        if (submitEl) {
            event.preventDefault();
            callIfFn(submitEl.getAttribute('data-form-submit'), []);
            return;
        }

        var sendEmailEl = target.closest('[data-send-bansal-email]');
        if (sendEmailEl) {
            event.preventDefault();
            var contactId = sendEmailEl.getAttribute('data-contact-id');
            if (typeof window.sendToBansalEmail === 'function') {
                window.sendToBansalEmail(contactId ? parseInt(contactId, 10) : undefined);
            }
            return;
        }

        var deleteContactEl = target.closest('[data-delete-contact]');
        if (deleteContactEl) {
            event.preventDefault();
            var delId = deleteContactEl.getAttribute('data-contact-id');
            if (typeof window.deleteContact === 'function') {
                window.deleteContact(delId ? parseInt(delId, 10) : undefined);
            }
            return;
        }

        var contactStatusEl = target.closest('[data-contact-status-action]');
        if (contactStatusEl) {
            event.preventDefault();
            var statusContactId = contactStatusEl.getAttribute('data-contact-id');
            var statusValue = contactStatusEl.getAttribute('data-status');
            if (typeof window.updateStatus === 'function') {
                window.updateStatus(
                    statusContactId ? parseInt(statusContactId, 10) : undefined,
                    statusValue
                );
            }
            return;
        }

        var toggleDropEl = target.closest('[data-toggle-dropdown]');
        if (toggleDropEl) {
            event.preventDefault();
            var dropContactId = toggleDropEl.getAttribute('data-contact-id');
            if (typeof window.toggleDropdown === 'function') {
                window.toggleDropdown(dropContactId ? parseInt(dropContactId, 10) : undefined);
            }
            return;
        }

        if (target.closest('[data-bulk-send-bansal]')) {
            event.preventDefault();
            callIfFn('bulkSendToBansalEmail');
            return;
        }

        if (target.closest('[data-bulk-delete-contacts]')) {
            event.preventDefault();
            callIfFn('bulkDelete');
            return;
        }

        if (target.closest('[data-export-contacts]')) {
            event.preventDefault();
            callIfFn('exportContacts');
            return;
        }

        if (target.closest('[data-copy-appointment]')) {
            event.preventDefault();
            callIfFn('copyAppointmentDetails');
            return;
        }

        var copyClipboardEl = target.closest('[data-copy-clipboard]');
        if (copyClipboardEl) {
            event.preventDefault();
            if (typeof window.copyToClipboard === 'function') {
                window.copyToClipboard(copyClipboardEl.getAttribute('data-copy-text'));
            }
            return;
        }

        if (target.closest('[data-copy-contact-details]')) {
            event.preventDefault();
            callIfFn('copyContactDetails');
            return;
        }

        if (target.closest('[data-toggle-status-dropdown]')) {
            event.preventDefault();
            callIfFn('toggleStatusDropdown');
            return;
        }

        var flashClose = target.closest('.modern-flash-close');
        if (flashClose && typeof window.dismissAlert === 'function') {
            event.preventDefault();
            window.dismissAlert(flashClose);
        }
    });

    document.addEventListener('submit', function (event) {
        var submitter = event.submitter;
        if (!submitter || !submitter.hasAttribute('data-confirm-submit')) {
            return;
        }
        event.preventDefault();

        var message = submitter.getAttribute('data-confirm-submit');
        var title = submitter.getAttribute('data-confirm-title') || 'Confirm action';
        var confirmText = submitter.getAttribute('data-confirm-ok') || 'Confirm';

        window.adminConfirm({
            title: title,
            message: message,
            confirmText: confirmText,
            variant: 'danger',
            icon: 'trash-2'
        }).then(function (confirmed) {
            if (confirmed) {
                submitter.closest('form').submit();
            }
        });
    });
})();
