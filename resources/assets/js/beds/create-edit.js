
'use strict';

document.addEventListener('turbo:load', loadBedsCreateEDit)

function loadBedsCreateEDit () {

    if (!$('#addNewBedsForm').length && !$('#EditBedsForm').length) {
        return false;
    }
    
    const editBedTypeElement = $('#editBedType')
    
    if(editBedTypeElement.length){
        $('#editBedType').select2({
            width: '100%',
            dropdownParent: $('#edit_beds_modal')
        });
    }

}

listenSubmit('#addNewBedsForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#BedSaveBtn');
    loadingButton.button('loading');
    $.ajax({
        url: $('#bedCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_beds_modal').modal('hide');
                livewire.emit('refresh');

            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});


listenClick('.bed-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let bedId = $(event.currentTarget).data('id');
    renderBedData(bedId);
});
function renderBedData(id) {
    $.ajax({
        url: $('.bedUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#bedId').val(result.data.id);
                $('#editBedName').val(result.data.name);
                $('#editBedType').val(result.data.bed_type).trigger('change.select2');
                $('#editBedDescription').val(result.data.description);
                $('#editBedCharge').val(result.data.charge);
                $('.price-input').trigger('input');
                $('#edit_beds_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#EditBedsForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    let id = $('#bedId').val();
    $.ajax({
        url: $('.bedUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#edit_beds_modal').modal('hide')
                if ($('#bedDetailShowUrl').length) {
                    window.location.href = $('#bedDetailShowUrl').val()
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

listenHiddenBsModal('#add_beds_modal', function () {
    resetModalForm('#addNewBedsForm', '#validationErrorsBox');
    $('#bedType').trigger('change.select2');
});

listenHiddenBsModal('#edit_beds_modal', function () {
    resetModalForm('#EditBedsForm', '#editValidationErrorsBox');
});

listenShownBsModal('#add_beds_modal', function () {
    $('#bedType').select2({
        width: '100%',
        dropdownParent: $('#add_beds_modal')
    })
});
