'use strict';

window.newRecord = function (data, loadingButton, modalSelector = '#AddModal') {
    let formData = (data.formSelector === '') ? data.formData : new FormData(
        $(data.formSelector)[0]);
    loadingButton.attr('disabled', true);

    $.ajax({
        url: data.url,
        type: data.type,
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(modalSelector).modal('hide');
                loadingButton.attr('disabled', false);
                // $(data.tableSelector).DataTable().ajax.reload(null, false);
                livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            loadingButton.attr('disabled', false);
            // loadingButton.attr('disabled', false);
            // printErrorMessage('#validationErrorsBox', result);
            // displayErrorMessage($('#validationErrorsBox').text())
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
};
window.editRecord = function (
    data, loadingButton, modalSelector = '#EditModal',
    btnToDisabledSelector = '') {
    loadingButton.attr('disabled', true);
    let formData = (data.formSelector === '') ? data.formData : new FormData(
        $(data.formSelector)[0]);
    $.ajax({
        url: data.url,
        type: data.type,
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(modalSelector).modal('hide');
                loadingButton.attr('disabled', false);
                livewire.emit('refresh');
            }
        },
        error: function (result) {
            loadingButton.attr('disabled', false);
            UnprocessableInputError(result);
        },
        complete: function () {
            loadingButton.button('reset');
            $(btnToDisabledSelector).attr('disabled', true);
        },
    });
};
window.editRecordWithForm = function (data, loadingButton, modalSelector = '#EditModal') {
    let formData = (data.formSelector === '') ? data.formData : $(
        data.formSelector).serialize();
    loadingButton.attr('disabled', true);
    $.ajax({
        url: data.url,
        type: data.type,
        data: formData,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(modalSelector).modal('hide');
                loadingButton.attr('disabled', false);
                livewire.emit('refresh');
                // $(data.tableSelector).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            loadingButton.attr('disabled', false);
            UnprocessableInputError(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
};
