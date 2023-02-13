'use strict';

listenSubmit('#addDiagnosisCatForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#diagnosisCatSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('#diagnosisCategoryCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_diagnosis_categories_modal').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            printErrorMessage('#diagnosisCatErrorsBox', result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenClick('.diagnosis-category-delete-btn', function (event) {
    let diagnosisCategoryId = $(event.currentTarget).attr('data-id');
    deleteItem($('#diagnosisCategoryUrl').val() + '/' + diagnosisCategoryId,
        '',
        $('#diagnosisCategory').val());
});

listenClick('.diagnosis-category-edit-btn', function (event) {
    let diagnosisCategoryId = $(event.currentTarget).attr('data-id');
    renderDiagnosisCategoryData(diagnosisCategoryId);
});

function renderDiagnosisCategoryData(id) {
    $.ajax({
        url: $('#diagnosisCategoryUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#diagnosisCategoryId').val(result.data.id);
                $('#editDiagnosisCatName').val(result.data.name);
                $('#editDiagnosisCatDescription').val(result.data.description);
                $('#edit_diagnosis_categories_modal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editDiagnosisCatForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#editDiagnosisCatSave');
    loadingButton.button('loading');
    var id = $('#diagnosisCategoryId').val();
    $.ajax({
        url: $('#diagnosisCategoryUrl').val() + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#edit_diagnosis_categories_modal').modal('hide')
                if ($('#diagnosisCategoryShowUrl').length) {
                    window.location.href = $('#diagnosisCategoryShowUrl').val()
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

listenHiddenBsModal('#add_diagnosis_categories_modal', function () {
    resetModalForm('#addDiagnosisCatForm', '#diagnosisCatErrorsBox');
});

listenHiddenBsModal('#edit_diagnosis_categories_modal', function () {
    resetModalForm('#editDiagnosisCatForm', '#editDiagnosisCatErrorsBox');
});
