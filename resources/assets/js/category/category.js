'use strict';

listenSubmit('#addMedicineCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#medicineCategorySave');
        loadingButton.button('loading');
        $.ajax({
            url: $('#indexCategoryCreateUrl').val(),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#add_categories_modal').modal('hide');
                    Livewire.emit('refresh')

                }
            },
            error: function (result) {
                printErrorMessage('#medicineCategoryErrorsBox', result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
});

listenSubmit('#editMedicineCategoryForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#editCategorySave');
        loadingButton.button('loading');
        var id = $('#editMedicineCategoryId').val();
        $.ajax({
            url: $('#indexCategoriesUrl').val() + '/' + id,
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#edit_categories_modal').modal('hide')
                    if ($('#categoriesShowUrl').length) {
                        window.location.href = $('#categoriesShowUrl').val()
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

listenHiddenBsModal('#add_categories_modal', function () {
        resetModalForm('#addMedicineCategoryForm', '#medicineCategoryErrorsBox');
});

listenHiddenBsModal('#edit_categories_modal', function () {
        resetModalForm('#editMedicineCategoryForm', '#editMedicineCategoryErrorsBox');
});

function renderCategoryData(id) {
        $.ajax({
            url: $('#indexCategoriesUrl').val() + '/' + id + '/edit',
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
}
    
listenClick('.category-edit-btn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let categoryId = $(event.currentTarget).attr('data-id');
        renderCategoryData(categoryId);
});

listenClick('.category-delete-btn', function (event) {
        let categoryId = $(event.currentTarget).attr('data-id');
        deleteItem($('#indexCategoriesUrl').val() + '/' + categoryId, '',
            Lang.get('messages.medicine.medicine_category'));
});

// category activation deactivation change event
listenChange('.medicine-category-status', function (event) {
        let categoryId = $(event.currentTarget).attr('data-id');
    activeDeActiveCategory(categoryId);
});
listenClick('#categoryResetFilter', function () {
    $('#medicineCategoryHead').val(2).trigger('change');
    hideDropdownManually($('#medicineCategoryFilterBtn'),
        $('.dropdown-menu'));
});

// activate de-activate category
function activeDeActiveCategory(id) {
        $.ajax({
            url: $('#indexCategoriesUrl').val() + '/' + id + '/active-deactive',
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    window.livewire.emit('refresh')
                }
            },
        });
};
    
listenChange('#medicineCategoryHead', function () {
        window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
        hideDropdownManually($('#medicineCategoryFilterBtn'),
            $('#medicineCategoryFilter'));
});
 
