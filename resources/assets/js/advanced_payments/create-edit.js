'use strict';

document.addEventListener('turbo:load', loadAdvancePaymentCreateEdit)

function loadAdvancePaymentCreateEdit () {

    if (!$('#addAdvancedPaymentForm').length && !$('#editAdvancedPaymentsForm').length) {
        return false;
    }

    const dateElement = $('#advancedPaymentDate')
    const editDateElement = $('#editAdvancedPaymentDate')
    const patientIdElement = $('#advancePaymentPatientId')
    const editPatientIdElement = $('#editPatientId')

    if (dateElement.length) {
        $('#advancedPaymentDate').flatpickr({
            defaultDate: new Date(),
            dateFormat: 'Y-m-d',
            locale : $('.userCurrentLanguage').val(),
        });
    }

    if(editDateElement.length){
        $('#editAdvancedPaymentDate').flatpickr({
            dateFormat: 'Y-m-d',
            locale : $('.userCurrentLanguage').val(),
        });
    }

    if(patientIdElement.length){
        $('#advancePaymentPatientId').select2({
            dropdownParent: $('#add_advanced_payments_modal')
        });
    }

    if(editPatientIdElement.length){
        $('#editPatientId').select2({
            dropdownParent: $('#edit_advanced_payments_modal')
        });
    }

}

listenShownBsModal('#add_advanced_payments_modal, #edit_advanced_payments_modal', function () {
    $('#patientId, #editPatientId:first').focus();

    $('#advancePaymentPatientId').select2({
        width: '100%',
        dropdownParent: $('#add_advanced_payments_modal')
    })

    $('#editPatientId').select2({
        dropdownParent: $('#edit_advanced_payments_modal')
    });
    
    let receiptNo =  Math.random().toString(36).substr(2, 8).toUpperCase();
    $('#receiptNoId').val(receiptNo);
});

listenSubmit('#addAdvancedPaymentForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#advancedPaymentSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#indexAdvancePaymentCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_advanced_payments_modal').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#advancedPaymentErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listen('click', '.advance-payment-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let advancedPaymentId = $(event.currentTarget).attr('data-id');
    renderAdvancePaymentData(advancedPaymentId);
});

function renderAdvancePaymentData(id) {
    $.ajax({
        url: route('advanced-payments.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#advancePaymentId').val(result.data.id);
                $('#editPatientId').val(result.data.patient_id).trigger('change.select2');
                $('#editReceiptNo').val(result.data.receipt_no);
                $('#editAmount').val(result.data.amount);
                $('.price-input').trigger('input');
                $('#editAdvancedPaymentDate').val(format(result.data.date, 'YYYY-MM-DD'));
                $('#edit_advanced_payments_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editAdvancedPaymentsForm', function (event) {
    event.preventDefault()
    var loadingButton = jQuery(this).find('#editAdvancedPaymentSave')
    loadingButton.button('loading')
    let id = $('#advancePaymentId').val()
    $.ajax({
        url: $('.advancedPaymentUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_advanced_payments_modal').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenHiddenBsModal('#add_advanced_payments_modal', function () {
    resetModalForm('#addAdvancedPaymentForm', '#advancedPaymentErrorsBox')
    $('#advancedPaymentDate').flatpickr({
        defaultDate: new Date(),
        dateFormat: 'Y-m-d',
        locale : $('.userCurrentLanguage').val(),
    });
    $('#advancePaymentPatientId').val('').trigger('change.select2')
});

listenHiddenBsModal('#edit_advanced_payments_modal', function () {
    resetModalForm('#editAdvancedPaymentsForm',
        '#editAdvancedPaymentErrorsBox')
});
