document.addEventListener('turbo:load', loadBirthCreateEdit)

function loadBirthCreateEdit() {

    if (!$('#addBirthReportForm').length && !$('#editBirthReportForm').length) {
        return false;
    }

    const birthCaseIdElement = $('#birthCaseId')
    const birthDoctorIdElement = $('#birthDoctorId')
    const editBirthCaseIdElement = $('#editBirthCaseId')
    const editBirthDoctorIdElement = $('#editBirthDoctorId')
    const birthDateElement = $('#birthDate')
    const editBirthDateElement = $('#editBirthDate')

    if (birthCaseIdElement.length) {
        $('#birthCaseId').select2({
            width: '100%',
            dropdownParent: $('#add_birth_reports_modal')
        });
    }

    if (birthDoctorIdElement.length) {
        $('#birthDoctorId').select2({
            width: '100%',
            dropdownParent: $('#add_birth_reports_modal')
        });
    }

    if (editBirthCaseIdElement.length) {
        $('#editBirthCaseId').select2({
            width: '100%',
            dropdownParent: $('#edit_birth_reports_modal')
        });
    }

    if (editBirthDoctorIdElement.length) {
        $('#editBirthDoctorId').select2({
            width: '100%',
            dropdownParent: $('#edit_birth_reports_modal')
        });
    }

    if (birthDateElement.length) {
        $('#birthDate').flatpickr({
            dateFormat: 'Y-m-d h:i K',
            useCurrent: true,
            sideBySide: true,
            enableTime: true,
            maxDate: new Date(),
            locale : $('.userCurrentLanguage').val(),
        });
    }

    if (editBirthDateElement.length) {
        $('#editBirthDate').flatpickr({
            dateFormat: 'Y-m-d h:i K',
            useCurrent: true,
            sideBySide: true,
            enableTime: true,
            maxDate: new Date(),
            locale : $('.userCurrentLanguage').val(),
        });
    }

}
    
// listenShownBsModal('#add_birth_reports_modal, #edit_birth_reports_modal', function () {
//     $('#birthCaseId, #editBirthCaseId:first').focus();
// });
    
listenSubmit('#addBirthReportForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnBirthSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#indexBirthReportCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_birth_reports_modal').modal('hide');
                Livewire.emit('refresh')

            }
        },
        error: function (result) {
            printErrorMessage('#birthValidationErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenClick('.birth-report-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let birthReportId = $(event.currentTarget).attr('data-id');
    renderBirthReportData(birthReportId);
});

function renderBirthReportData(id) {
    $.ajax({
        url: $('.birthReportUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#birthReportId').val(result.data.id);
                $('#editBirthCaseId').val(result.data.case_id).trigger('change.select2');
                $('#editBirthDoctorId').val(result.data.doctor_id).trigger('change.select2');
                $('#editBirthDescription').val(result.data.description);
                document.querySelector('#editBirthDate')._flatpickr.setDate(moment(result.data.date).format());
                $('#edit_birth_reports_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editBirthReportForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnBirthEditSave');
    loadingButton.button('loading');
    let editTimeBirthReportId = $('#birthReportId').val()
    $.ajax({
        url: $('.birthReportUrl').val() + '/' + editTimeBirthReportId,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#edit_birth_reports_modal').modal('hide')
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

listenHiddenBsModal('#add_birth_reports_modal', function () {
    resetModalForm('#addBirthReportForm', '#birthValidationErrorsBox');
    $('#birthCaseId, #birthDoctorId').val('').trigger('change.select2');
});

listenHiddenBsModal('#edit_birth_reports_modal', function () {
    resetModalForm('#editBirthReportForm', '#editBirthValidationErrorsBox');
});
