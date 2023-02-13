document.addEventListener('turbo:load', loadDeathReportsCreateEdit)

function loadDeathReportsCreateEdit() {

    if (!$('#addDeathReportForm').length && !$('#editDeathReportForm').length) {
        return false;
    }

    const deathCaseIdElement = $('#deathCaseId')
    const deathDoctorIdElement = $('#deathDoctorId')
    const editDeathCaseIdElement = $('#editDeathCaseId')
    const editDeathDoctorIdElement = $('#editDeathDoctorId')
    const deathDateElement = $('#deathDate')
    const editDeathDateElement = $('#editDeathDate')
    
    if(deathCaseIdElement.length){
        $('#deathCaseId').select2({
            width: '100%',
            dropdownParent: $('#add_death_reports_modal')
        });
    }

    if(deathDoctorIdElement.length){
        $('#deathDoctorId').select2({
            width: '100%',
            dropdownParent: $('#add_death_reports_modal')
        });
    }

    if(editDeathCaseIdElement.length){
        $('#editDeathCaseId').select2({
            width: '100%',
            dropdownParent: $('#edit_death_reports_modal')
        });
    }

    if(editDeathDoctorIdElement.length){
        $('#editDeathDoctorId').select2({
            width: '100%',
            dropdownParent: $('#edit_death_reports_modal')
        });
    }

    if(deathDateElement.length){
        $('#deathDate').flatpickr({
            dateFormat: 'Y-m-d h:i K',
            useCurrent: true,
            enableTime: true,
            sideBySide: true,
            maxDate: new Date(),
            locale : $('.userCurrentLanguage').val(),
        });
    }

    if(editDeathDateElement.length){
        $('#editDeathDate').flatpickr({
            dateFormat: 'Y-m-d h:i K',
            useCurrent: true,
            enableTime: true,
            sideBySide: true,
            maxDate: new Date(),
            locale : $('.userCurrentLanguage').val(),
        });
    }
    
}

// listenShownBsModal('#add_death_reports_modal, #edit_death_reports_modal', function () {
//     $('#deathCaseId, #editDeathCaseId:first').focus();
// });

listenSubmit('#addDeathReportForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#deathReportSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#indexDeathReportCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_death_reports_modal').modal('hide');
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#deathReportErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenClick( '.death-report-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let deathReportId = $(event.currentTarget).attr('data-id');
    renderDeathReportData(deathReportId);
});

 function renderDeathReportData(id) {
    $.ajax({
        url: $('.deathReportUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#deathReportId').val(result.data.id);
                $('#editDeathCaseId').val(result.data.case_id).trigger('change.select2');
                $('#editDeathDoctorId').val(result.data.doctor_id).trigger('change.select2');
                $('#editDeathDescription').val(result.data.description);
                document.querySelector('#editDeathDate')._flatpickr.setDate(moment(result.data.date).format());
                $('#edit_death_reports_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editDeathReportForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editDeathReportSave');
    loadingButton.button('loading');
    let id = $('#deathReportId').val();
    $.ajax({
        url: $('.deathReportUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_death_reports_modal').modal('hide');
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

listenHiddenBsModal('#add_death_reports_modal', function () {
    resetModalForm('#addDeathReportForm', '#deathReportErrorsBox');
    $('#deathCaseId, #deathDoctorId').val('').trigger('change.select2');
}); 

listenHiddenBsModal('#edit_death_reports_modal', function () {
    resetModalForm('#editDeathReportForm', '#c');
});
