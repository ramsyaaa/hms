listenClick('.delete-prescription-btn', function (event) {
    let prescriptionId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexPrescriptionUrl').val() + '/' + prescriptionId,
        '',
        $('#Prescription').val());
});

listenChange('.prescriptionStatus', function (event) {
    let prescriptionId = $(event.currentTarget).attr('data-id');
    prescriptionUpdateStatus(prescriptionId);
});

function prescriptionUpdateStatus(id) {
    $.ajax({
        url: $('#indexPrescriptionUrl').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                hideDropdownManually($('#prescriptionFilterBtn'), $('#prescriptionFilter'));
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        }
        });
}

    listenClick('#prescriptionResetFilter', function () {
        $('#prescriptionHead').val('2').trigger('change');
        hideDropdownManually($('#prescriptionFilterBtn'), $('.dropdown-menu'));
    });

function prescriptionRenderData(id) {
    $.ajax({
        url: $('#prescriptionShowModal').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showPrescriptionPatientName').text(result.data.patient.user.full_name);
                $('#showPrescriptionDoctorName').text(result.data.doctor.user.full_name);
                $('#showPrescriptionFoodAllergies').text(result.data.food_allergies);
                $('#showPrescriptionTendencyBleed').text(result.data.tendency_bleed);
                $('#showPrescriptionHeartDisease').text(result.data.heart_disease);
                    $('#showPrescriptionHighBloodPressure').text(result.data.high_blood_pressure);
                    $('#showPrescriptionDiabetic').text(result.data.diabetic);
                    $('#showPrescriptionSurgery').text(result.data.surgery);
                    $('#showPrescriptionAccident').text(result.data.accident);
                    $('#showPrescriptionOthers').text(result.data.others);
                    $('#showPrescriptionMedicalHistory').text(result.data.medical_history);
                    $('#showPrescriptionCurrentMedication').text(result.data.current_medication);
                    $('#showPrescriptionFemalePregnancy').text(result.data.female_pregnancy);
                    $('#showPrescriptionBreastFeeding').text(result.data.breast_feeding);
                    $('#showPrescriptionHealthInsurance').text(result.data.health_insurance);
                    $('#showPrescriptionLowIncome').text(result.data.low_income);
                    $('#showPrescriptionReference').text(result.data.reference);
                    $('#showPrescriptionStatus').empty();
                    if (result.data.status == 1) {
                        $('#showPrescriptionStatus').append(
                            '<span class="badge bg-light-success">Active</span>');
                    } else {
                        $('#showPrescriptionStatus').append(
                            '<span class="badge bg-light-danger">Deactive</span>');
                    }
                    $('#showPrescriptionCreatedOn').text(moment(result.data.created_at).fromNow());
                    $('#showPrescriptionUpdatedOn').text(moment(result.data.updated_at).fromNow());

                    setValueOfEmptySpan();
                    $('#showPrescription').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
}

listenChange('#prescriptionHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

