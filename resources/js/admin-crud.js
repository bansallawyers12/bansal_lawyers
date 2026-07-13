/**
 * Admin CRUD helpers — vanilla + Axios (Phase 5).
 * Status toggles keep the row — never remove on status success.
 */
import { adminPost, siteUrl, showLoader, hideLoader, setHtml, scrollToTop } from './admin-http.js';

export function successMessage(msg) {
    return (
        '<div class="alert alert-success alert-dismissible fade show" role="alert"><div class="alert-body">' +
        '<button type="button" class="btn-close" data-admin-dismiss="alert" aria-label="Close"></button>' +
        '<strong>' +
        msg +
        '</strong></div></div>'
    );
}

export function errorMessage(msg) {
    return (
        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><div class="alert-body">' +
        '<button type="button" class="btn-close" data-admin-dismiss="alert" aria-label="Close"></button>' +
        msg +
        '</div></div>'
    );
}

function clearFlash() {
    setHtml('.server-error', '');
    setHtml('.custom-error-msg', '');
}

function setToggleChecked(id, checked) {
    document.querySelectorAll(`.change-status[data-id="${id}"]`).forEach((el) => {
        el.checked = checked;
    });
}

function setToggleStatus(id, status) {
    document.querySelectorAll(`.change-status[data-id="${id}"]`).forEach((el) => {
        el.setAttribute('data-status', String(status));
    });
}

export async function updateStatus(id, current_status, table, col) {
    clearFlash();
    showLoader();
    scrollToTop();
    try {
        const obj = await adminPost(`${siteUrl()}/admin/update_action`, {
            id,
            current_status,
            table,
            colname: col,
        });
        if (obj.status == 1) {
            setHtml('.custom-error-msg', successMessage(obj.message));
            setToggleStatus(id, current_status == 1 ? 0 : 1);
        } else {
            setHtml('.custom-error-msg', errorMessage(obj.message));
            setToggleChecked(id, current_status == 1);
        }
    } catch (err) {
        console.error(err);
        setHtml('.custom-error-msg', errorMessage('Something went wrong. Please try again.'));
        setToggleChecked(id, current_status == 1);
    } finally {
        hideLoader();
    }
}

export function deleteAction(id, table) {
    window.adminConfirmForDelete(table).then(async (confirmed) => {
        if (!confirmed) return;
        if (id === '') {
            alert('Please select ID to delete the record.');
            return;
        }

        clearFlash();
        showLoader();
        scrollToTop();
        try {
            const obj = await adminPost(`${siteUrl()}/admin/delete_action`, { id, table });
            if (obj.status == 1) {
                document.getElementById(`id_${id}`)?.remove();
                document.getElementById(`quid_${id}`)?.remove();
                setHtml('.custom-error-msg', successMessage(obj.message));
                const countEl = document.querySelector('.count');
                if (countEl) {
                    const newCount = Number(countEl.textContent || 0) - 1;
                    countEl.textContent = String(newCount);
                    if (newCount === 0) {
                        setHtml('.tdata', '<tr><td colspan="6">There are no data in this table.</td></tr>');
                    }
                }
                location.reload();
            } else {
                setHtml('.custom-error-msg', errorMessage(obj.message));
            }
        } catch (err) {
            console.error(err);
            setHtml('.custom-error-msg', errorMessage('Something went wrong. Please try again.'));
        } finally {
            hideLoader();
        }
    });
}

export async function archiveAction(id, table) {
    if (!confirm('Do you want to change status to Archive?')) {
        hideLoader();
        return;
    }
    if (id === '') {
        alert('Please select ID to update the record.');
        return;
    }
    clearFlash();
    showLoader();
    scrollToTop();
    try {
        const obj = await adminPost(`${siteUrl()}/admin/archive_action`, { id, table });
        if (obj.status == 1) {
            const statusCell = document.querySelector(`#quid_${id} .statusupdate`);
            if (statusCell && obj.astatus != null) {
                statusCell.innerHTML = obj.astatus;
            }
            setHtml('.custom-error-msg', successMessage(obj.message));
        } else {
            setHtml('.custom-error-msg', errorMessage(obj.message));
        }
    } catch (err) {
        console.error(err);
        setHtml('.custom-error-msg', errorMessage('Something went wrong. Please try again.'));
    } finally {
        hideLoader();
    }
}

async function postStatusAction(url, id, table, confirmMsg) {
    if (!confirm(confirmMsg)) {
        hideLoader();
        return;
    }
    if (id === '') {
        alert('Please select ID to update the record.');
        return;
    }
    clearFlash();
    showLoader();
    scrollToTop();
    try {
        const obj = await adminPost(url, { id, table });
        if (obj.status == 1) {
            setHtml('.custom-error-msg', successMessage(obj.message));
            location.reload();
        } else {
            setHtml('.custom-error-msg', errorMessage(obj.message));
        }
    } catch (err) {
        console.error(err);
        setHtml('.custom-error-msg', errorMessage('Something went wrong. Please try again.'));
    } finally {
        hideLoader();
    }
}

export function declineAction(id, table) {
    return postStatusAction(
        `${siteUrl()}/admin/declined_action`,
        id,
        table,
        'Do you want to change status to declined?'
    );
}

export function approveAction(id, table) {
    return postStatusAction(
        `${siteUrl()}/admin/approved_action`,
        id,
        table,
        'Do you want to change status to Approve?'
    );
}

export function processedAction(id, table) {
    return postStatusAction(
        `${siteUrl()}/admin/process_action`,
        id,
        table,
        'Do you want to change status to Process?'
    );
}

export async function movetoclientAction(id, table, col) {
    if (!confirm('Are you sure, you would like to move this record.')) {
        hideLoader();
        return;
    }
    if (id === '') {
        alert('Please select ID to delete the record.');
        return;
    }
    clearFlash();
    showLoader();
    scrollToTop();
    try {
        const obj = await adminPost(`${siteUrl()}/admin/move_action`, { id, table, col });
        if (obj.status == 1) {
            document.getElementById(`id_${id}`)?.remove();
            setHtml('.custom-error-msg', successMessage(obj.message));
        } else {
            setHtml('.custom-error-msg', errorMessage(obj.message));
        }
    } catch (err) {
        console.error(err);
        setHtml('.custom-error-msg', errorMessage('Something went wrong. Please try again.'));
    } finally {
        hideLoader();
    }
}

export function initAdminCrud() {
    document.addEventListener('change', (event) => {
        const el = event.target.closest?.('.change-status');
        if (!el) return;
        const id = (el.getAttribute('data-id') || '').trim();
        const current_status = (el.getAttribute('data-status') || '').trim();
        const table = (el.getAttribute('data-table') || '').trim();
        const col = (el.getAttribute('data-col') || '').trim();
        if (id !== '' && current_status !== '' && table !== '' && typeof window.updateStatus === 'function') {
            window.updateStatus(id, current_status, table, col);
        }
    });
}

window.updateStatus = updateStatus;
window.deleteAction = deleteAction;
window.archiveAction = archiveAction;
window.declineAction = declineAction;
window.approveAction = approveAction;
window.processedAction = processedAction;
window.movetoclientAction = movetoclientAction;
window.successMessage = successMessage;
window.errorMessage = errorMessage;
