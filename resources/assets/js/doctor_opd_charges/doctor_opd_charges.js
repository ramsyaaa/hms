document.addEventListener('turbo:load', loadDoctorOpdChargeCreateEdit)

function loadDoctorOpdChargeCreateEdit() {

    if (!$('#addDoctorChargesForm').length && !$('#editDoctorChargesForm').length) {
        return false;
    }

    const chargesDoctorIdElement = $('#chargesDoctorId')
    const editChargesDoctorIdElement = $('#editChargesDoctorId')
    
    if (chargesDoctorIdElement.length){
        $('#chargesDoctorId').select2({
            width: '100%',
            dropdownParent: $('#add_doctor_opd_charges_modal'),
        });
    }

    if (editChargesDoctorIdElement.length){
        $('#editChargesDoctorId').select2({
            width: '100%',
            dropdownParent: $('#edit_doctor_opd_charges_modal'),
        });
    }

}

listenSubmit('#addDoctorChargesForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#doctorChargesSave');
        loadingButton.button('loading');
        $.ajax({
            url: $('#doctorOPDCreateChargeURLID').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#add_doctor_opd_charges_modal').modal('hide');
                    livewire.emit('refresh');
                }
            },
            error: function (result) {
                printErrorMessage('#doctorChargesErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
});

listenClick('.doctor-opd-charge-delete-btn', function (event) {
        let id = $(event.currentTarget).attr('data-id');
        deleteItem($('#doctorOPDChargeURLID').val() + '/' + id,  null,
            $('#doctorOPDCharges').val());
});

listenClick('.doctor-opd-charge-edit-btn', function (event) {
        let doctorOPDChargeId = $(event.currentTarget).attr('data-id');
        renderDoctorOpdChargeData(doctorOPDChargeId);
});

function renderDoctorOpdChargeData(id) {
        $.ajax({
            url: $('#doctorOPDChargeURLID').val() + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#doctorOPDChargeId').val(result.data.id);
                    $('#editChargesDoctorId').val(result.data.doctor_id).trigger('change.select2');
                    $('#editDoctorStandardCharge').val(result.data.standard_charge);
                    $('.price-input').trigger('input');
                    $('#edit_doctor_opd_charges_modal').modal('show');
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
}
    
listenSubmit('#editDoctorChargesForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#editDoctorChargesSave');
        loadingButton.button('loading');
        let id = $('#doctorOPDChargeId').val();
        $.ajax({
            url: $('#doctorOPDChargeURLID').val() + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#edit_doctor_opd_charges_modal').modal('hide');
                    livewire.emit('refresh');
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

listenHiddenBsModal('#add_doctor_opd_charges_modal', function () {
        resetModalForm('#addDoctorChargesForm', '#doctorChargesErrorsBox');
        $('#chargesDoctorId').val('').trigger('change.select2');
});
    
listenHiddenBsModal('#edit_doctor_opd_charges_modal', function () {
        resetModalForm('#editDoctorChargesForm', '#editDoctorChargesErrorsBox');
});

// listenShownBsModal('#add_doctor_opd_charges_modal, #edit_doctor_opd_charges_modal', function () {
//     $('#chargesdoctorId, #editChargesDoctorId:first').focus();
// });
 
