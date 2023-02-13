'use strict';

document.addEventListener('turbo:load', loadAccountCreateEdit)

function loadAccountCreateEdit () {

    if (!$('#addAccountForm').length && !$('#editAccountForm').length) {
        return false;
    }

}

listenChange('.account-status', function (event) {
    let accountId = $(event.currentTarget).attr('data-id');
    updateAccountStatus(accountId);
});

function updateAccountStatus(id) {
    $.ajax({
        url: $('.indexAccountUrl').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                // $(tableName).DataTable().ajax.reload(null, false);
                livewire.emit('refresh')
            }
        },
    });
}

listenSubmit('#addAccountForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnAccountSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#indexAccountCreateUrl').val(),
        'type': 'POST',
        // 'tableSelector': tableName,
    };
    newRecord(data, loadingButton, '#add_accounts_modal');
});

listenSubmit('#editAccountForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editAccountSave')
    loadingButton.button('loading')
    let id = $('#accountId').val()
    let url = $('#indexAccountUrl').val() + '/' + +id
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
        // 'tableSelector': tableName,
    }
    if ($('#accountShowUrl').length) {
        editRecordWithForm(data, loadingButton, '#edit_accounts_modal')
        window.location.href = $('#accountShowUrl').val()
    } else {
        editRecordWithForm(data, loadingButton, '#edit_accounts_modal')
    }
});

listen('click', '.account-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let accountId = $(event.currentTarget).attr('data-id');
    renderAccountData(accountId);
});

listen('click', '.account-delete-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexAccountUrl').val() + '/' + +id, '', $('#Account').val());
});

function renderAccountData(id) {
    $.ajax({
        url: $('#indexAccountUrl').val() + '/' + +id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#accountId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editDescription').val(result.data.description);
                if (result.data.status) {
                    $('#editIsActive').val(1).prop('checked', true);
                }
                if (result.data.type == 1) {
                    $('#editDebit').prop('checked', true);
                } else {
                    $('#editCredit').prop('checked', true);
                }
                $('#edit_accounts_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenChange('#account_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

listenChange('#account_filter_type', function () {
    window.livewire.emit('changeTypeFilter', 'account_filter_type',
        $(this).val())
});

listen('click', '#accountResetFilter', function () {
    $('#account_filter_status, #account_filter_type').val(0).trigger('change');
    hideDropdownManually($('#accountantFilterBtn'), $('.dropdown-menu'));
});

listenHiddenBsModal('#add_accounts_modal', function () {
    resetModalForm('#addAccountForm', '#validationErrorsBox');
});

listenHiddenBsModal('#edit_accounts_modal', function () {
    resetModalForm('#editAccountForm', '#editValidationErrorsBox');
});
