document.addEventListener('turbo:load', loadOperationCreateDetails)
function loadOperationCreateDetails(){
    if (!$('#editOperationReportForm').length) {
        return
    }

    $('#editOperationDoctorId, #editOperationCaseId').select2({
        width: '100%',
    });
    $('#editOperationDate').flatpickr({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: true,
        sideBySide: true,
        locale : $('.userCurrentLanguage').val(),
    });
};
// listenShownBsModal('#edit_operations_reports_modal', function () {
//     $('#editOperationCaseId:first').focus();
// });

listenClick('.editOperationReportBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let operationReportId = $(event.currentTarget).attr('data-id');
    renderOperationDetailData(operationReportId);
});

function renderOperationDetailData(id) {
    $.ajax({
        url: $('#indexOperationReportUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#operationReportId').val(result.data.id);
                $('#editOperationCaseId').val(result.data.case_id).trigger('change.select2');
                $('#editOperationDoctorId').val(result.data.doctor_id).trigger('change.select2');
                $('#editOperationDescription').val(result.data.description);
                $('#editOperationDate').val(format(result.data.date, 'YYYY-MM-DD HH:mm:ss'));
                $('#edit_operations_reports_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editOperationReportForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editOperationReportSave');
    loadingButton.button('loading');
    let id = $('#operationReportId').val();
    $.ajax({
        url: $('#indexOperationReportUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_operations_reports_modal').modal('hide');
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }
        },
        error: function (result) {
            UnprocessableInputError(result)
        },
        complete: function () {
            loadingButton.button('reset')
        },
    });
});
