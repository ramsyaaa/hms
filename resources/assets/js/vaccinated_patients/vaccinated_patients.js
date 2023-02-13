document.addEventListener('turbo:load',
    loadVaccinatedPatientDate)

function loadVaccinatedPatientDate() {
    if (!$('#vPatientDoesGivenDate').length && !$('#editVPatientDoesGivenDate').length) {
        return
    }

    let doesDatePicker = $('#vPatientDoesGivenDate,#editVPatientDoesGivenDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: 'Y-m-d H:i',
        locale : $('.userCurrentLanguage').val(),
    });
    listenShownBsModal('#add_vaccinated_patient_modal', function () {
        $('#vPatientName,#vPatientVaccinationName').select2({
            width: '100%',
            dropdownParent: $('#add_vaccinated_patient_modal')
        });
    })
    
    listenShownBsModal('#edit_vaccinated_patient_modal', function () {
        $('#editVPatientName,#editVPatientVaccinationName').select2({
            width: '100%',
            dropdownParent: $('#edit_vaccinated_patient_modal')
        });
    })
}

    listenShownBsModal('#add_vaccinated_patient_modal', function () {
        // doesDatePicker.set('minDate', new Date());
        $('#vPatientDoesGivenDate').val(moment().format('YYYY-MM-DD HH:mm'));
    });

    listenSubmit('#add_vaccinated_patient_form', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#vPatientBtnSave');
        loadingButton.button('loading');
        $.ajax({
            url: $('#vaccinatedPatientsStore').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#add_vaccinated_patient_modal').modal('hide');
                    livewire.emit('refresh')
                    setTimeout(function () {
                        loadingButton.button('reset');
                    }, 2500);
                }
            },
            error: function (result) {
                printErrorMessage('#vPatientValidationErrorsBox', result);
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2000);
            },
        });
    });

    listenHiddenBsModal('#add_vaccinated_patient_modal', function () {
        $('#vPatientPatientName').val('').trigger('change');
        $('#vPatientVaccinationName').val('').trigger('change');
        resetModalForm('#add_vaccinated_patient_form', '#vPatientValidationErrorsBox');
    });

listenClick('.edit-vaccinatedPatient-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let vaccinatedPatientId = $(event.currentTarget).attr('data-id');
    renderVaccinatedPatientData(vaccinatedPatientId);
});

window.renderVaccinatedPatientData = function (id) {
    $.ajax({
        url: $('#vaccinatedPatientsIndex').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let vaccinatedPatient = result.data;
                $('#editVPatientId').val(vaccinatedPatient.id);
                $('#editVPatientName').val(vaccinatedPatient.patient_id).trigger('change.select2');
                $('#editVPatientVaccinationName').val(vaccinatedPatient.vaccination_id).trigger('change.select2');
                $('#editVPatientSerialNo').val(vaccinatedPatient.vaccination_serial_number);
                    $('#editVPatientDoseNumber').val(vaccinatedPatient.dose_number);
                    $('#editVPatientDoesGivenDate').val(moment(vaccinatedPatient.dose_given_date).utc().format('YYYY-MM-DD HH:mm:ss'));
                    $('#editVPatientDescription').val(vaccinatedPatient.description);
                    $('#edit_vaccinated_patient_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    listenSubmit('#edit_vaccinated_patient_form', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#editVPatientBtnSave');
        loadingButton.button('loading');
        let editTimeVaccinatedPatientId = $('#editVPatientId').val()
        $.ajax({
            url: $('#vaccinatedPatientsIndex').val() + '/' +
                editTimeVaccinatedPatientId + '/update',
            type: 'post',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#edit_vaccinated_patient_modal').modal('hide')
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

listenClick('.delete-vaccinatedPatient-btn', function (event) {
    let vaccinatedPatientId = $(event.currentTarget).attr('data-id');
    deleteItem($('#vaccinatedPatientsIndex').val() + '/' + vaccinatedPatientId,
        '', $('#vaccinatedPatient').val());
});

