listenClick('.bed-type-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let bedTypeId = $(event.currentTarget).attr('data-id');
    renderBedTypesData(bedTypeId);
});

listenClick('.bed-type-delete-btn', function (event) {
    let bedTypeId = $(event.currentTarget).attr('data-id');
    deleteItem($('#bedTypesUrl').val() + '/' + bedTypeId, '', $('#bedType').val());
});

function renderBedTypesData(id) {
    $.ajax({
        url: $('#bedTypesUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bedType = result.data;
                $('#bedTypeId').val(bedType.id);
                $('#BedTypeEditTitle').val(bedType.title);
                $('#BedTypeEditDescription').val(bedType.description);
                $('#edit_bed_types_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#addNewBedTypeForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#BedBtnSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#bedTypesCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_bed_types_modal').modal('hide');
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

listenSubmit('#BedTypeEditForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#BedTyeBtnEditSave');
    loadingButton.button('loading');
    var id = $('#bedTypeId').val();
    $.ajax({
        url: $('#bedTypesUrl').val() + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#edit_bed_types_modal').modal('hide')
                    livewire.emit('refresh')
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

listenHiddenBsModal('#add_bed_types_modal', function () {
    resetModalForm('#addNewBedTypeForm', '#validationErrorsBox');
});

listenHiddenBsModal('#edit_bed_types_modal', function () {
    resetModalForm('#BedTypeEditForm', '#editValidationErrorsBox');
});
