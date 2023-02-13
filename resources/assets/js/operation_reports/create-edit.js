document.addEventListener('turbo:load', loadOperationCreateEdit)

function loadOperationCreateEdit(){
    if (!$('#addOperationReportForm').length && !$('#editOperationReportForm').length) {
        return
    }
    $('#operationDoctorId, #operationCaseId').select2({
        width: '100%',
        dropdownParent: $('#add_operations_reports_modal')
    });
    $('#editOperationDoctorId, #editOperationCaseId').select2({
        width: '100%',
        dropdownParent: $('#edit_operations_reports_modal')
    });
    $('#operationDate, #editOperationDate').flatpickr({
        dateFormat: 'Y-m-d h:i K',
        useCurrent: true,
        sideBySide: true,
        enableTime: true,
        locale : $('.userCurrentLanguage').val(),
    });
    // listenShownBsModal('#add_operations_reports_modal, #edit_operations_reports_modal', function () {
    //     $('#operationCaseId, #editOperationCaseId:first').focus();
    // });
};

listenSubmit('#addOperationReportForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#operationReportSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#operationReportCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_operations_reports_modal').modal('hide');
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#operationErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenClick('.editOperationReportsBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let operationReportId = $(event.currentTarget).attr('data-id')
    renderOperationReportData(operationReportId)
})

function renderOperationReportData(id) {
    $.ajax({
        url: $('#operationReportUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#operationReportId').val(result.data.id);
                $('#editOperationCaseId').val(result.data.case_id).trigger('change.select2');
                $('#editOperationDoctorId').val(result.data.doctor_id).trigger('change.select2');
                $('#editOperationDescription').val(result.data.description);
                document.querySelector('#editOperationDate')._flatpickr.setDate(moment(result.data.date).format());
                $('#edit_operations_reports_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editOperationReportsForm', function (event) {
    event.preventDefault()
    var loadingButton = jQuery(this).find('#editOperationSave')
    loadingButton.button('loading')
    let id = $('#operationReportId').val()
    $.ajax({
        url: $('#operationReportUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_operations_reports_modal').modal('hide');
                Livewire.emit('refresh')
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

listenHiddenBsModal('#add_operations_reports_modal', function () {
    resetModalForm('#addOperationReportForm', '#OperationErrorsBox');
    $('#operationCaseId, #operationDoctorId').val('').trigger('change.select2');
});

listenHiddenBsModal('#edit_operations_reports_modal', function () {
    resetModalForm('#editOperationReportsForm', '#editOperationErrorsBox')
});
