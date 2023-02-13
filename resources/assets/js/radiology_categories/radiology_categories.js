listenSubmit('#addRadiologyCategoryForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnRadiologyCategorySave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#createRadiologyCategoryURL').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_radiology_categories_modal').modal('hide');
                $('#radiologyCategoryTable').DataTable().ajax.reload(null, true);
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#rcvalidationErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenSubmit('#editRadiologyCategoryForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnRadiologyCategoryEditSave');
    loadingButton.button('loading');
    var id = $('#radiologyCategoryId').val();
    $.ajax({
        url: $('#radiologyCategoryURL').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_radiology_categories_modal').modal('hide');
                $('#radiologyCategoryTable').DataTable().ajax.reload(null, true);
                Livewire.emit('refresh')
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
listenHiddenBsModal('#add_radiology_categories_modal', function () {
    resetModalForm('#addRadiologyCategoryForm', '#rcvalidationErrorsBox');
});

listenHiddenBsModal('#edit_radiology_categories_modal', function () {
    resetModalForm('#editRadiologyCategoryForm', '#editRCValidationErrorsBox');
});

function radiologyCategoryRenderData(id) {
    $.ajax({
        url: $('#radiologyCategoryURL').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let radiologyCategory = result.data;
                $('#radiologyCategoryId').val(radiologyCategory.id);
                $('#editRadiologyCategoryName').val(radiologyCategory.name);
                $('#edit_radiology_categories_modal').modal('show');
                ajaxCallCompleted();
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenClick('.edit-radiology-category-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let radiologyCategoryId = $(event.currentTarget).attr('data-id');
    radiologyCategoryRenderData(radiologyCategoryId);
});

listenClick('.delete-radiology-category-btn', function (event) {
    let radiologyCategoryId = $(event.currentTarget).attr('data-id');
    deleteItem($('#radiologyCategoryURL').val() + '/' + radiologyCategoryId,
        '', $('#radiologyCategory').val());
});
