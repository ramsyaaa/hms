
listenSubmit('#addDocTypeForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#docTypeSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#indexDocTypeCreateUrl').val(),
        'type': 'POST',
    };
    newRecord(data, loadingButton, '#add_document_types_modal');
});

listenClick('.editDocTypBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let docTypeId = $(event.currentTarget).attr('data-id')
    renderDocTypeData(docTypeId)
})

function renderDocTypeData (id) {
    $.ajax({
        url: $('#indexDocTypeUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#docTypeId').val(result.data.id)
                $('#editDocTypeName').val(result.data.name)
                $('#edit_document_types_modal').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editDocTypForm', function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#editDocTypeSave')
    loadingButton.button('loading')
    let id = $('#docTypeId').val()
    let url = $('.docTypeUrl').val() + '/' + id
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
    };
    editRecordWithForm(data, loadingButton, '#edit_document_types_modal')
});

listenClick('.deleteDocTypeBtn', function (event) {
    let id = $(event.currentTarget).attr('data-id')
    deleteItem($('#indexDocTypeUrl').val() + '/' + id, '',
        $('#documentType').val())
})

listenHiddenBsModal('#add_document_types_modal', function () {
    resetModalForm('#addDocTypeForm', '#docTypeErrorsBox')
})
