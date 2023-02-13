document.addEventListener('turbo:load', loadOpdPatientData)

function loadOpdPatientData() {
    if (!$('#createOpdPatientForm').length && !$('#editOpdPatientDepartmentForm').length) {
        return
    }

    $('#opdPatientId, #opdDoctorId,#opdPaymentMode,#editOpdPatientId, #editOpdDoctorId,#editOpdPaymentMode').select2({
        width: '100%',
    });

    $('#opdCaseId ,#editOpdCaseId').select2({
        width: '100%',
        placeholder: 'Choose Case',
    });

    let appointmentDateFlatPicker = $("#opdAppointmentDate,#editOpdAppointmentDate ").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale : $('.userCurrentLanguage').val(),
    });

    if ($('.lastVisit').val()) {
        $('#opdPatientId,#editOpdPatientId').val($('.lastVisit').val()).trigger('change');
        $('#opdPatientId,#editOpdPatientId').attr('disabled', true);
    }

    if ($('.isEdit').val()) {
        $('#opdPatientId,#editOpdPatientId').attr('disabled', true);
        $('#opdPatientId,#editOpdPatientId').trigger('change');
        appointmentDateFlatPicker.set('minDate', $('#opdAppointmentDate,#editOpdAppointmentDate').val());
    } else {
        appointmentDateFlatPicker.setDate(new Date());
        appointmentDateFlatPicker.set('minDate', new Date());
    }

}

listenSubmit('#createOpdPatientForm, #editOpdPatientDepartmentForm', function () {
    $('#opdPatientId,#editOpdPatientId').attr('disabled', false);
    $('#btnOpdSave,#btnEditOpdSave').attr('disabled', true);
});

listenChange('#opdPatientId,#editOpdPatientId', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('.opdPatientCasesUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#opdCaseId,#editOpdCaseId').empty();
                    $('#opdCaseId,#editOpdCaseId').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        if($('.patientCaseId').val() == v) {
                            $('#editOpdCaseId').append($('<option></option>').attr('value', i).attr('selected', true).text(v));
                        }
                        else {
                            $('#opdCaseId,#editOpdCaseId').append($('<option></option>').attr('value', i).text(v));   
                        }
                    });
                } else {
                    $('#opdCaseId,#editOpdCaseId').prop('disabled', true);
                }
            },
        });
    }
    $('#opdCaseId,#editOpdCaseId').empty();
    $('#opdCaseId,#editOpdCaseId').prop('disabled', true);

    $('#opdCaseId ,#editOpdCaseId').select2({
        width: '100%',
        placeholder: 'Choose Case',
    });
});

listenChange('#opdDoctorId,#editOpdDoctorId', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('.doctorOpdChargeUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#opdStandardCharge,#editOpdStandardCharge').val(data.data[0].standard_charge);
                } else {
                    $('#opdStandardCharge,#editOpdStandardCharge').val(0);
                }
            },
        });
    }
});
