'use strict';

listenClick('.editDocTypeBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let docTypeId = $(event.currentTarget).attr('data-id');
    renderDocTypeDetailData(docTypeId);
});

window.renderDocTypeDetailData = function (id) {
    $.ajax({
        url: $('#showDocTypeUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#docTypeId').val(result.data.id);
                $('#editDocTypeName').val(result.data.name);
                $('#edit_document_types_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editDocTypeForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editDocTypeSave');
    loadingButton.button('loading');
    let id = $('#docTypeId').val();
    let url = $('#showDocTypeUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
    };
    editDocumentTypeRecordWithForm(data, loadingButton);
});

window.editDocumentTypeRecordWithForm = function (data, loadingButton) {
    let formData = (data.formSelector === '') ? data.formData : $(
        data.formSelector).serialize();
    $.ajax({
        url: data.url,
        type: data.type,
        data: formData,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_document_types_modal').modal('hide');
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
};
