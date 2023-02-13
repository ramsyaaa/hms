document.addEventListener('turbo:load', loadCategoryDetailEdit)

function loadCategoryDetailEdit() {

    if (!$('.editCategoryBtn').length) {
        return
    }

    listenSubmit('#editMedicineCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#editCategorySave');
        loadingButton.button('loading');
        var id = $('#editMedicineCategoryId').val();
        $.ajax({
            url: $('#showCategoriesUrl').val() + '/' + id,
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#edit_categories_modal').modal('hide');
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

    listenHiddenBsModal('#edit_categories_modal', function () {
        resetModalForm('#editMedicineCategoryForm', '#editMedicineCategoryErrorsBox');
    });

    window.renderCategoryDetailData = function (id) {
        $.ajax({
            url: $('#showCategoriesUrl').val() + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let category = result.data;
                    $('#editMedicineCategoryId').val(category.id);
                    $('#editCategoryName').val(category.name);
                    if (category.is_active === 1)
                        $('#editCategoryIsActive').prop('checked', true);
                    else
                        $('#editCategoryIsActive').prop('checked', false);
                    $('#edit_categories_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };
    listenClick('.editCategoryBtn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let categoryId = $(event.currentTarget).attr('data-id');
        renderCategoryDetailData(categoryId);
    });
}
