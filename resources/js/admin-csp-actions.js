/**
 * CSP-safe delegated handlers for admin UI actions.
 * Ported from public/js/admin-csp-actions.js
 */

function callIfFn(name, args) {
    const fn = window[name];
    if (typeof fn === 'function') {
        fn.apply(window, args || []);
    }
}

export function initAdminCspActions() {
    document.addEventListener('click', (event) => {
        const target = event.target;

        const deleteEl = target.closest('[data-delete-action]');
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

        const updateEl = target.closest('[data-update-action]');
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

        const archiveEl = target.closest('[data-archive-action]');
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

        const slotEl = target.closest('[data-delete-slot-action]');
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

        const validateEl = target.closest('[data-custom-validate]');
        if (validateEl) {
            event.preventDefault();
            if (typeof window.customValidate === 'function') {
                window.customValidate(validateEl.getAttribute('data-custom-validate'));
            }
            return;
        }

        const submitEl = target.closest('[data-form-submit]');
        if (submitEl) {
            event.preventDefault();
            callIfFn(submitEl.getAttribute('data-form-submit'), []);
            return;
        }

        const sendEmailEl = target.closest('[data-send-bansal-email]');
        if (sendEmailEl) {
            event.preventDefault();
            const contactId = sendEmailEl.getAttribute('data-contact-id');
            if (typeof window.sendToBansalEmail === 'function') {
                window.sendToBansalEmail(contactId ? parseInt(contactId, 10) : undefined);
            }
            return;
        }

        const deleteContactEl = target.closest('[data-delete-contact]');
        if (deleteContactEl) {
            event.preventDefault();
            const delId = deleteContactEl.getAttribute('data-contact-id');
            if (typeof window.deleteContact === 'function') {
                window.deleteContact(delId ? parseInt(delId, 10) : undefined);
            }
            return;
        }

        const contactStatusEl = target.closest('[data-contact-status-action]');
        if (contactStatusEl) {
            event.preventDefault();
            const statusContactId = contactStatusEl.getAttribute('data-contact-id');
            const statusValue = contactStatusEl.getAttribute('data-status');
            if (typeof window.updateContactStatus === 'function') {
                window.updateContactStatus(
                    statusContactId ? parseInt(statusContactId, 10) : undefined,
                    statusValue
                );
            }
            return;
        }

        const toggleDropEl = target.closest('[data-toggle-dropdown]');
        if (toggleDropEl) {
            event.preventDefault();
            const dropContactId = toggleDropEl.getAttribute('data-contact-id');
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

        const copyClipboardEl = target.closest('[data-copy-clipboard]');
        if (copyClipboardEl) {
            event.preventDefault();
            if (typeof window.copyToClipboard === 'function') {
                window.copyToClipboard(
                    copyClipboardEl.getAttribute('data-copy-text'),
                    copyClipboardEl
                );
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

        const flashClose = target.closest('.modern-flash-close');
        if (flashClose && typeof window.dismissAlert === 'function') {
            event.preventDefault();
            window.dismissAlert(flashClose);
        }
    });

    document.addEventListener('submit', (event) => {
        const submitter = event.submitter;
        if (!submitter || !submitter.hasAttribute('data-confirm-submit')) {
            return;
        }
        event.preventDefault();

        window.adminConfirm({
            title: submitter.getAttribute('data-confirm-title') || 'Confirm action',
            message: submitter.getAttribute('data-confirm-submit'),
            confirmText: submitter.getAttribute('data-confirm-ok') || 'Confirm',
            variant: 'danger',
            icon: 'trash-2',
        }).then((confirmed) => {
            if (confirmed) {
                submitter.closest('form').submit();
            }
        });
    });
}
