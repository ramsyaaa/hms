'use strict'

listenSubmit('#addBloodBankForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#bloodBankSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#bloodBankCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_blood_banks_modal').modal('hide');
                livewire.emit('refresh');
            }
        },
        error: function (result) {
            printErrorMessage('#bloodBankErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenSubmit('#editBloodBankForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editBloodBankSave');
    loadingButton.button('loading');
    var id = $('#bloodBankId').val();
    $.ajax({
        url: $('#bloodBankUrl').val() + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_blood_banks_modal').modal('hide');
                livewire.emit('refresh');
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenHiddenBsModal('#add_blood_banks_modal', function () {
    resetModalForm('#addBloodBankForm', '#bloodBankErrorsBox');
});

listenHiddenBsModal('#edit_blood_banks_modal', function () {
    resetModalForm('#editBloodBankForm', '#editBloodBankErrorsBox');
});

function renderBloodBankData(id) {
    $.ajax({
        url: $('#bloodBankUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodGroup = result.data;
                $('#bloodBankId').val(bloodGroup.id);
                $('#editBloodGroup').val(bloodGroup.blood_group);
                $('#editBloodBankRemainedBags').val(bloodGroup.remained_bags);
                $('#edit_blood_banks_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listen('click', '.blood-bank-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let bloodGroupId = $(event.currentTarget).attr('data-id');
    renderBloodBankData(bloodGroupId);
});

listen('click', '.blood-bank-delete-btn', function (event) {
    let bloodGroupId = $(event.currentTarget).attr('data-id');
    deleteItem($('#bloodBankUrl').val() + '/' + bloodGroupId, '',
        $('#bloodBank').val());
});
