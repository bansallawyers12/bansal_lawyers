/**
 * Admin CRUD helpers (ported from public/js/custom.js).
 * Status toggles keep the row (blog/CMS pattern) — never remove on status success.
 * Always use window.jQuery (layout sync script) — never import a second jQuery copy.
 */

function csrfHeaders() {
    return { 'X-CSRF-TOKEN': window.jQuery('meta[name="csrf-token"]').attr('content') };
}

function siteUrl() {
    return typeof window.site_url !== 'undefined' ? window.site_url : '';
}

export function successMessage(msg) {
    return (
        '<div class="alert alert-success alert-dismissible fade show" role="alert"><div class="alert-body">' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        '<strong>' + msg + '</strong></div></div>'
    );
}

export function errorMessage(msg) {
    return (
        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><div class="alert-body">' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        msg + '</div></div>'
    );
}

export function updateStatus(id, current_status, table, col) {
    const $ = window.jQuery;
    $('.server-error').html('');
    $('.custom-error-msg').html('');
    $.ajax({
        type: 'post',
        headers: csrfHeaders(),
        url: `${siteUrl()}/admin/update_action`,
        data: { id, current_status, table, colname: col },
        success(resp) {
            const obj = typeof resp === 'object' ? resp : $.parseJSON(resp);
            if (obj.status == 1) {
                $('.custom-error-msg').html(successMessage(obj.message));
                const updated_status = current_status == 1 ? 0 : 1;
                $(`.change-status[data-id=${id}]`).attr('data-status', updated_status);
                // Keep row — status toggle is not a delete
            } else {
                $('.custom-error-msg').html(errorMessage(obj.message));
                $(`.change-status[data-id=${id}]`).prop('checked', current_status == 1);
            }
            $('.popuploader').hide();
        },
        beforeSend() {
            $('.popuploader').show();
        },
    });
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}

export function deleteAction(id, table) {
    const $ = window.jQuery;
    window.adminConfirmForDelete(table).then((confirmed) => {
        if (!confirmed) return;
        if (id === '') {
            alert('Please select ID to delete the record.');
            return false;
        }

        $('.popuploader').show();
        $('.server-error').html('');
        $('.custom-error-msg').html('');
        $.ajax({
            type: 'post',
            headers: csrfHeaders(),
            url: `${siteUrl()}/admin/delete_action`,
            data: { id, table },
            success(resp) {
                $('.popuploader').hide();
                const obj = typeof resp === 'object' ? resp : $.parseJSON(resp);
                if (obj.status == 1) {
                    $(`#id_${id}`).remove();
                    $(`#quid_${id}`).remove();
                    $('.custom-error-msg').html(successMessage(obj.message));
                    const old_count = $('.count').text();
                    const new_count = old_count - 1;
                    $('.count').text(new_count);
                    if (new_count == 0) {
                        $('.tdata').html('<tr><td colspan="6">There are no data in this table.</td></tr>');
                    }
                    location.reload();
                } else {
                    $('.custom-error-msg').html(errorMessage(obj.message));
                }
                $('#loader').hide();
            },
            beforeSend() {
                $('#loader').show();
            },
        });
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
}

export function archiveAction(id, table) {
    const $ = window.jQuery;
    if (!confirm('Do you want to change status to Archive?')) {
        $('#loader').hide();
        return;
    }
    if (id === '') {
        alert('Please select ID to update the record.');
        return false;
    }
    $('.server-error').html('');
    $('.custom-error-msg').html('');
    $.ajax({
        type: 'post',
        headers: csrfHeaders(),
        url: `${siteUrl()}/admin/archive_action`,
        data: { id, table },
        success(resp) {
            const obj = typeof resp === 'object' ? resp : $.parseJSON(resp);
            if (obj.status == 1) {
                $(`#quid_${id} .statusupdate`).html(obj.astatus);
                $('.custom-error-msg').html(successMessage(obj.message));
            } else {
                $('.custom-error-msg').html(errorMessage(obj.message));
            }
            $('#loader').hide();
        },
        beforeSend() {
            $('#loader').show();
        },
    });
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}

function postStatusAction(url, id, table, confirmMsg) {
    const $ = window.jQuery;
    if (!confirm(confirmMsg)) {
        $('#loader').hide();
        return;
    }
    if (id === '') {
        alert('Please select ID to update the record.');
        return false;
    }
    $('.server-error').html('');
    $('.custom-error-msg').html('');
    $.ajax({
        type: 'post',
        headers: csrfHeaders(),
        url,
        data: { id, table },
        success(resp) {
            const obj = typeof resp === 'object' ? resp : $.parseJSON(resp);
            if (obj.status == 1) {
                $('.custom-error-msg').html(successMessage(obj.message));
                location.reload();
            } else {
                $('.custom-error-msg').html(errorMessage(obj.message));
            }
            $('#loader').hide();
        },
        beforeSend() {
            $('#loader').show();
        },
    });
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}

export function declineAction(id, table) {
    postStatusAction(`${siteUrl()}/admin/declined_action`, id, table, 'Do you want to change status to declined?');
}

export function approveAction(id, table) {
    postStatusAction(`${siteUrl()}/admin/approved_action`, id, table, 'Do you want to change status to Approve?');
}

export function processedAction(id, table) {
    postStatusAction(`${siteUrl()}/admin/process_action`, id, table, 'Do you want to change status to Process?');
}

export function movetoclientAction(id, table, col) {
    const $ = window.jQuery;
    if (!confirm('Are you sure, you would like to move this record.')) {
        $('#loader').hide();
        return;
    }
    if (id === '') {
        alert('Please select ID to delete the record.');
        return false;
    }
    $('.popuploader').show();
    $('.server-error').html('');
    $('.custom-error-msg').html('');
    $.ajax({
        type: 'post',
        headers: csrfHeaders(),
        url: `${siteUrl()}/admin/move_action`,
        data: { id, table, col },
        success(resp) {
            $('.popuploader').hide();
            const obj = typeof resp === 'object' ? resp : $.parseJSON(resp);
            if (obj.status == 1) {
                $(`#id_${id}`).remove();
                $('.custom-error-msg').html(successMessage(obj.message));
            } else {
                $('.custom-error-msg').html(errorMessage(obj.message));
            }
            $('#loader').hide();
        },
        beforeSend() {
            $('#loader').show();
        },
    });
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}

export function initAdminCrud() {
    const $ = window.jQuery;
    // Namespaced so pages can off('change.adminCrud') if needed.
    // Do not also bind .change-status on the page — that double-fires AJAX
    // (.off('change') does not remove this delegated handler).
    $(document).off('change.adminCrud', '.change-status').on('change.adminCrud', '.change-status', function () {
        const id = $.trim($(this).attr('data-id'));
        const current_status = $.trim($(this).attr('data-status'));
        const table = $.trim($(this).attr('data-table'));
        const col = $.trim($(this).attr('data-col'));
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
