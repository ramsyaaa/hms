'use strict';

listenSubmit('#addPathologyCategoryForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#pathologyCategorySave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#createPathologyCategoryURL').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_pathology_categories_modal').modal('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            printErrorMessage('#pCategoryErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenSubmit('#editPathologyCategoryForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editPathologyCategorySave');
    loadingButton.button('loading');
    var id = $('#pathologyCategoryId').val();
    $.ajax({
        url: $('#pathologyCategoryURL').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_pathology_categories_modal').modal('hide');
                window.livewire.emit('refresh');
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

listenHiddenBsModal('#add_pathology_categories_modal', function () {
    resetModalForm('#addPathologyCategoryForm', '#pCategoryErrorsBox');
});

listenHiddenBsModal('#edit_pathology_categories_modal', function () {
    resetModalForm('#editPathologyCategoryForm', '#editPCategoryErrorsBox');
});

window.renderPathologyCategoriesData = function (id) {
    $.ajax({
        url: $('#pathologyCategoryURL').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let pathologyCategory = result.data;
                $('#pathologyCategoryId').val(pathologyCategory.id);
                $('#editPathologyCategoryName').val(pathologyCategory.name);
                $('#edit_pathology_categories_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};
listenClick('.editPathologyCategoryBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let pathologyCategoryId = $(event.currentTarget).attr('data-id');
    renderPathologyCategoriesData(pathologyCategoryId);
});

listenClick('.deletePathologyCategoryBtn', function (event) {
    let pathologyCategoryId = $(event.currentTarget).attr('data-id');
    deleteItem($('#pathologyCategoryURL').val() + '/' + pathologyCategoryId,
        '', $('#pathologyCategory').val());
});
