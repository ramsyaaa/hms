'use strict';

document.addEventListener('turbo:load', loadChargeCreateEdit)

function loadChargeCreateEdit () {

    if (!$('#addChargesForm').length && !$('#editChargesForm').length) {
        return false;
    }
    //
    const chargeTypeIdElement = $('#chargeTypeId')
    const chargeCategoryIdElement = $('#chargeCategoryId')
    const editChargeTypeIdElement = $('#editChargeTypeId')
    const editChargeCategoryIdElement = $('#editChargeCategoryId')
    
    if(chargeTypeIdElement.length){
        $('#chargeTypeId').select2({
            width: '100%',
            dropdownParent: $('#add_charges_modal'),
            placeholder: 'Select Charge Category',
        });
    }

    if(chargeCategoryIdElement.length){
        $('#chargeCategoryId').select2({
            width: '100%',
            dropdownParent: $('#add_charges_modal'),
            placeholder: 'Select Charge Category',
        });
    }

    if(editChargeTypeIdElement.length){
        $('#editChargeTypeId').select2({
            width: '100%',
            dropdownParent: $('#edit_charges_modal'),
            placeholder: 'Select Charge Category',
        });
    }

    if(editChargeCategoryIdElement.length){
        $('#editChargeCategoryId').select2({
            width: '100%',
            dropdownParent: $('#edit_charges_modal'),
            placeholder: 'Select Charge Category',
        });
    }
    
}

// listenShownBsModal('#add_charges_modal, #edit_charges_modal', function () {
//         $('#chargeTypeId, #editChargeTypeId:first').focus();
// });

function changeChargeCategory(selector, id) {
        $.ajax({
            url: $('.changeChargeTypeURL').val(),
            type: 'get',
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                $(selector).empty();
                $.each(data.data, function (i, v) {
                    $(selector).append($('<option></option>').attr('value', i).text(v));
                });
            },
        });
}

listenChange('#chargeTypeId', function () {
        changeChargeCategory('#chargeCategoryId', $(this).val());
});
    
listenChange('#editChargeTypeId', function () {
        changeChargeCategory('#editChargeCategoryId', $(this).val());
});

listenSubmit('#addChargesForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#chargesSave');
        loadingButton.button('loading');
        $.ajax({
            url: $('#createChargesURL').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#add_charges_modal').modal('hide');
                    livewire.emit('refresh');
                }
            },
            error: function (result) {
                printErrorMessage('#chargesErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
});

listenClick('.charge-edit-btn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let chargeId = $(event.currentTarget).attr('data-id');
        renderChargeData(chargeId);
});

function renderChargeData(id) {
        $.ajax({
            url: $('.chargesURl').val() + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#chargeId').val(result.data.id);
                    $('#editChargeTypeId').val(result.data.charge_type).trigger('change.select2');
                    changeChargeCategory('#editChargeCategoryId', result.data.charge_type);
                    $('#editCode').val(result.data.code);
                    $('#editChargesDescription').val(result.data.description);
                    $('#editStdCharge').val(addCommas(result.data.standard_charge));
                    setTimeout(function () {
                        $('#editChargeCategoryId').val(result.data.charge_category_id).trigger('change.select2');
                    }, 2000);
                    $('#edit_charges_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
}

listenSubmit('#editChargesForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#editChargesSave');
        loadingButton.button('loading');
        let id = $('#chargeId').val();
        $.ajax({
            url: $('.chargesURl').val() + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#edit_charges_modal').modal('hide')
                    if ($('#chargeDetailShowUrl').length) {
                        window.location.href = $('#chargeDetailShowUrl').val()
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

listenHiddenBsModal('#add_charges_modal', function () {
        resetModalForm('#addChargesForm', '#chargesErrorsBox');
        $('#chargeTypeId,#chargeCategoryId').val('').trigger('change.select2');
});

listenHiddenBsModal('#edit_charges_modal', function () {
        resetModalForm('#editChargesForm', '#editChargesErrorsBox');
        $('#editChargeTypeId,#editChargeCategoryId').val('').trigger('change.select2');
});
 
