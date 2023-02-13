document.addEventListener('turbo:load', loadItemCategoryDate)

function loadItemCategoryDate()
{
    listenClick('.editItemCategoryBtn', function (event) {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let itemCategoryId = $(event.currentTarget).attr('data-id');
        renderItemCategoryData(itemCategoryId);
    });

    listenClick('.deleteItemCategoryBtn', function (event) {
        let itemCategoryId = $(event.currentTarget).attr('data-id');
        deleteItem($('#indexItemCategoriesUrl').val() + '/' + itemCategoryId, '',
            $('#localItemCategory').val());
    });

    function renderItemCategoryData(id) {
        $.ajax({
            url: $('#indexItemCategoriesUrl').val() + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let itemCategory = result.data;
                    $('#itemCategoryId').val(itemCategory.id);
                    $('#editItemCategoryName').val(itemCategory.name);
                    $('#edit_item_categories_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    }

    listenHiddenBsModal('#add_item_categories_modal', function () {
        resetModalForm('#addItemCategoryForm', '#itemCatErrorsBox');
    });

    listenHiddenBsModal('#edit_item_categories_modal', function () {
        resetModalForm('#editItemCatForm', '#editItemCatErrorsBox');
    });
}

listenSubmit('#addItemCategoryForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#itemCategorySave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#indexItemCategoryCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_item_categories_modal').modal('hide');
                Livewire.emit('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#itemCatErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenSubmit('#editItemCatForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editItemCategorySave');
    loadingButton.button('loading');
    var id = $('#itemCategoryId').val();
    $.ajax({
        url: $('#indexItemCategoriesUrl').val() + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_item_categories_modal').modal('hide');
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
