'use strict';

document.addEventListener('turbo:load', loadChargeCategoryCreateEdit)

function loadChargeCategoryCreateEdit () {

    if (!$('#addChargeCategoryForm').length && !$('#editChargeCategoryForm').length) {
        return false;
    }
    
    const chargeCategoryTypeIdElement = $('#chargeCategoryTypeId')
    const editChargeCategoryTypeIdElement = $('#editChargeCategoryTypeId')
    
    if(chargeCategoryTypeIdElement.length){
        $('#chargeCategoryTypeId').select2({
            width: '100%',
            dropdownParent: $('#add_charge_categories_modal')
        });
    }

    if(editChargeCategoryTypeIdElement.length){
        $('#editChargeCategoryTypeId').select2({
            width: '100%',
            dropdownParent: $('#edit_charge_categories_modal')
        });
    }

}

listenSubmit('#addChargeCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#chargeCategorySave');
        loadingButton.button('loading');
        $.ajax({
            url: $('.chargeCategoryCreateURLID').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#add_charge_categories_modal').modal('hide');
                    livewire.emit('refresh');
                }
            },
            error: function (result) {
                printErrorMessage('#chargeCategoryErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
});

listenClick('.charge-category-edit-btn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let chargeTypeId = $(event.currentTarget).attr('data-id');
        renderChargeCategoryData(chargeTypeId);
});

function renderChargeCategoryData(id) {
    $.ajax({
            url: $('#chargeCategoryURLID').val() + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#chargeCatId').val(result.data.id);
                    $('#editChargeCategoryName').val(result.data.name);
                    $('#editChargeCategoryTypeId').val(result.data.charge_type).trigger('change.select2');
                    $('#editChargeCategoryDescription').val(result.data.description);
                    $('#edit_charge_categories_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
}

listenSubmit('#editChargeCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#editChargeCategorySave');
        loadingButton.button('loading');
        let id = $('#chargeCatId').val();
        $.ajax({
            url: $('#chargeCategoryURLID').val() + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#edit_charge_categories_modal').modal('hide');
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

listenHiddenBsModal('#add_charge_categories_modal', function () {
        resetModalForm('#addChargeCategoryForm', '#chargeCategoryErrorsBox');
        $('#chargeCategoryTypeId').val('').trigger('change.select2');
});

listenHiddenBsModal('#edit_charge_categories_modal', function () {
            resetModalForm('#editChargeCategoryForm', '#editChargeCategoryErrorsBox');
        $('#editChargeCategoryTypeId').val('').trigger('change.select2');
});
 
