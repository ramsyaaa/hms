document.addEventListener('turbo:load', loadIpdPatientCreate)

function loadIpdPatientCreate() {
    if (!$('#ipdAdmissionDate').length && !$('#editIpdAdmissionDate').length) {
        return
    }

    $('#ipdPatientId, #ipdDoctorId, #ipdBedTypeId,#editIpdPatientId, #editIpdDoctorId, #editIpdBedTypeId').select2({
        width: '100%',
    });

    $('#ipdCaseId, #editIpdCaseId ').select2({
        width: '100%',
        placeholder: 'Choose Case',
    });

    $('#ipdBedId, #editIpdBedId').select2({
        width: '100%',
        placeholder: 'Choose Bed',
    });

    let admissionFlatPicker = $('#ipdAdmissionDate, #editIpdAdmissionDate').flatpickr({
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
        locale : $('.userCurrentLanguage').val(),
    });

    if ($('.isEdit').val()) {
        $('.ipdPatientId, .ipdBedTypeId').trigger('change');
        admissionFlatPicker.set('minDate', $('.ipdAdmissionDate').val());
    } else {
        admissionFlatPicker.setDate(new Date());
        admissionFlatPicker.set('minDate', new Date());
    }

}

listenKeyup('.ipdDepartmentFloatNumber', function () {
    if ($(this).val().indexOf('.') != -1) {
        if ($(this).val().split('.')[1].length > 2) {
            if (isNaN(parseFloat(this.value))) return;
            this.value = parseFloat(this.value).toFixed(2);
        }
    }
    return this;
});

listenSubmit('#createIpdPatientForm, #editIpdPatientDepartmentForm'
    , function () {
        $('#ipdSave, #btnIpdPatientEdit').attr('disabled', true);
    });


listenChange('.ipdPatientId', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('.patientCasesUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').empty()
                    $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').
                        removeAttr('disabled')
                    $.each(data.data, function (i, v) {
                        $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').
                            append($('<option></option>').
                                attr('value', i).
                                text(v))
                    })
                    $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').
                        val($('#editIpdPatientCaseId').val()).
                        trigger('change.select2')
                } else {
                    $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').
                        prop('disabled', true)
                }
            },
        });
    }
    $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').empty()
    $('#ipdDepartmentCaseId,#editIpdDepartmentCaseId').prop('disabled', true)
    
    $('#ipdDepartmentCaseId, #editIpdDepartmentCaseId ').select2({
        width: '100%',
        placeholder: 'Choose Case',
    });
});

listenChange('.ipdBedTypeId', function () {
    let bedId = null;
    let bedTypeId = null;
    if (typeof $('#editIpdPatientBedId').val() != 'undefined' && typeof $('#editIpdPatientBedTypeId').val() !=
        'undefined') {
        bedId = $('#editIpdPatientBedId').val();
        bedTypeId = $('#editIpdPatientBedTypeId').val();
    }

    if ($(this).val() !== '') {
        let bedType = $(this).val();
        $.ajax({
            url: $('.patientBedsUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {
                id: $(this).val(),
                isEdit: $('.isEdit').val(),
                bedId: bedId,
                ipdPatientBedTypeId: bedTypeId,
            },
            success: function (data) {
                if (data.data !== null) {
                    if (data.data.length !== 0) {
                        $('#ipdBedId,#editIpdBedId').empty()
                        $('#ipdBedId,#editIpdBedId').removeAttr('disabled')
                        $.each(data.data, function (i, v) {
                            $('#ipdBedId,#editIpdBedId').
                                append($('<option></option>').
                                    attr('value', i).
                                    text(v))
                        })
                        if (typeof $('#editIpdPatientBedId').val() != 'undefined'
                            && typeof $('#editIpdPatientBedTypeId').val() !=
                            'undefined') {
                            if (bedType ===
                                $('#editIpdPatientBedTypeId').val()) {
                                $('#ipdBedId,#editIpdBedId').
                                    val($('#editIpdPatientBedId').val()).
                                    trigger('change.select2')
                            }
                        }
                        $('#ipdBedId,#editIpdBedId').prop('required', true)
                    }
                } else {
                    $('#ipdBedId,#editIpdBedId').prop('disabled', true)
                }
            },
        });
    }
    $('#ipdBedId,#editIpdBedId').empty()
    $('#ipdBedId,#editIpdBedId').prop('disabled', true)
    
    $('#ipdBedId, #editIpdBedId').select2({
        width: '100%',
        placeholder: 'Choose Bed',
    });
});
