'use strict'

listenClick('.doctor-department-delete-btn', function (event) {
    let doctorDepartmentId = event.currentTarget.dataset.id
    deleteItem(
        $('#indexDoctorDepartmentUrl').val() + '/' + doctorDepartmentId,
        '',
        $('#doctorDepartment').val(),
    );
});

listenSubmit('#addDoctorDepartmentForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#doctorDepartmentSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#indexDoctorDepartmentCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_doctor_departments_modal').modal('hide');
                livewire.emit('refresh');
            }
        },
        error: function (result) {
            printErrorMessage('#doctorDepartmentErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenClick('.doctor-department-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let doctorDepartmentId = event.currentTarget.dataset.id
    renderDoctorDepartmentData(doctorDepartmentId)
})

function renderDoctorDepartmentData (id) {
    $.ajax({
        url: $('#indexDoctorDepartmentUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#doctorDepartmentId').val(result.data.id);
                $('#editDoctorDepartmentTitle').val(result.data.title);
                $('#editDoctorDepartmentDescription').val(result.data.description);
                $('#edit_doctor_departments_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editDoctorDepartmentForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editDoctorDepartmentSave');
    loadingButton.button('loading');
    let id = $('#doctorDepartmentId').val();
    $.ajax({
        url: $('#indexDoctorDepartmentUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#edit_doctor_departments_modal').modal('hide')
                if ($('#showDoctorDepartmentUrl').length) {
                    window.location.href = $('#showDoctorDepartmentUrl').val()
                } else {
                    livewire.emit('refresh')
                }
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

listenHiddenBsModal('#add_doctor_departments_modal', function () {
    resetModalForm('#addDoctorDepartmentForm', '#doctorDepartmentErrorsBox');
});

listenHiddenBsModal('#edit_doctor_departments_modal', function () {
    resetModalForm('#editDoctorDepartmentForm', '#editDoctorDepartmentErrorsBox');
});
 
