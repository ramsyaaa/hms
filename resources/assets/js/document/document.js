'use strict'

document.addEventListener('turbo:load', loadDocumentCreateEdit)

function loadDocumentCreateEdit () {

    if (!$('.addDocumentForm').length && !$('#editDocumentForm').length) {
        return false;
    }

    const documentPatientIdElement = $('#documentPatientId')
    const documentTypeIdElement = $('#documentTypeId')
    const editDocumentPatientIdElement = $('#editDocumentPatientId')
    const editDocumentTypeIdElement = $('#editDocumentTypeId')
    
    if(documentPatientIdElement.length){editDocumentTypeId
        $('#documentPatientId').select2({
            width: '100%',
            dropdownParent: $('#add_documents_modal')
        });
    }

    if(documentTypeIdElement.length){
        $('#documentTypeId').select2({
            width: '100%',
            dropdownParent: $('#add_documents_modal')
        });
    }
    
    if(editDocumentPatientIdElement.length){
        $('#editDocumentPatientId').select2({
            width: '100%',
            dropdownParent: $('#edit_documents_modal')
        });
    }

    if(editDocumentTypeIdElement.length){
        $('#editDocumentTypeId').select2({
            width: '100%',
            dropdownParent: $('#edit_documents_modal')
        });
    }

}

listenClick('.document-delete-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexDocumentsUrl').val() + '/' + id, '', $('#Documents').val());
});

var documentFileName;
listenChange('#documentImage,#editDocumentImage', function () {
    documentFileName = $(this).val();
});

listenSubmit('.addDocumentForm', function (event) {
    event.preventDefault();
    // if (documentFileName == null || documentFileName == '') {
    //     let message = 'Please select attachment';
    //     displayErrorMessage(message);
    //     return false;
    // }
    if ($('#documentErrorsBox').text() !== '') {
        $('#documentImage').focus();
        displayErrorMessage($('#documentErrorsBox').text())
        return false;
    }
    let loadingButton = jQuery(this).find('#documentSave');
    loadingButton.button('loading');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#indexDocumentsCreateUrl').val(),
        'type': 'POST',
    };
    newRecord(data, loadingButton, '#add_documents_modal');
});

listenClick('.document-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let documentId = $(event.currentTarget).attr('data-id');
    renderDocumentData(documentId);
});

function renderDocumentData(id) {
    $.ajax({
        url: $('#indexDocumentsUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.document_url.split('.').pop().toLowerCase();
                if (ext == 'pdf') {
                    $('#editDocumentPreviewImage').css('background-image', 'url("' + $('.pdfDocumentImageUrl').val() + '")');
                } else if ((ext == 'docx') || (ext == 'doc')) {
                    $('#editDocumentPreviewImage').css('background-image', 'url("' + $('.docxDocumentImageUrl').val() + '")');
                } else {
                    $('#editDocumentPreviewImage').css('background-image', 'url("' + result.data.document_url + '")');
                }

                $('#editDocumentTypeId').val(result.data.document_type_id).trigger('change.select2');
                $('#editDocumentPatientId').val(result.data.patient_id).trigger('change.select2');
                $('#editDocumentTitle').val(result.data.title);
                isEmpty(result.data.document_url) ? $('#editDocumentUrl').hide() : $('#editDocumentUrl').attr('href', result.data.document_url);
                $('#documentId').val(result.data.id);
                $('#editDocumentNotes').val(result.data.notes);
                $('#edit_documents_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editDocumentForm', function (event) {
    event.preventDefault();
    if ($('#editDocumentErrorsBox').text() !== '') {
        $('#documentImage').focus();
        displayErrorMessage($('#editDocumentErrorsBox').text())
        return false;
    }
    let loadingButton = jQuery(this).find('#editDocumentSave');
    loadingButton.button('loading');
    let id = $('#documentId').val();
    let url = $('#indexDocumentsUrl').val() + '/' + id + '/update';
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
    };
    editRecord(data, loadingButton, '#edit_documents_modal');
});

listenHiddenBsModal('#add_documents_modal', function () {
    $('#documentTypeId').val(null).trigger('change');
    $('#documentPatientId').val(null).trigger('change');
    $('#documentPreviewImage').css('background-image', 'url(' + $('#indexDefaultDocumentImageUrl').val() + ')');
    documentFileName = null;
    resetModalForm('.addDocumentForm', '#documentErrorsBox');
});

listenHiddenBsModal('#edit_documents_modal', function () {
    resetModalForm('#editDocumentForm', '#editDocumentErrorsBox');
});

listenShownBsModal('#add_documents_modal,#edit_documents_modal', function () {
    $('#documentTypeId,#documentPatientId').select2({
        width: '100%',
        dropdownParent: $('#add_documents_modal')
    });
    
    $('#editDocumentTypeId,#editDocumentPatientId').select2({
        width: '100%',
        dropdownParent: $('#edit_documents_modal')
    })
})

listenChange('#documentImage', function () {
    let extension = isValidDocument($(this), '#documentErrorsBox', this);
    if (!isEmpty(extension) && extension != false) {
        $('#documentErrorsBox').html('').hide();
        displayDocument(this, '#documentPreviewImage', extension);
    }
});

listenChange('#editDocumentImage', function () {
    let extension = isValidDocument($(this),
        '#editDocumentErrorsBox', this);
    if (!isEmpty(extension) && extension != false) {
        $('#editDocumentErrorsBox').html('').hide();
        displayDocument(this, '#editPreviewImage', extension);
    }
});

function isValidDocument(inputSelector, validationMessageSelector, input) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if (input.files[0].size > 10000000) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be less than 10 mb').show();
        setTimeout(function () {
            $(validationMessageSelector).slideUp(500);
        }, 5000);
        return false;
    }
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx', 'webp']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx, webp').show();
        setTimeout(function () {
            $(validationMessageSelector).slideUp(500);
        }, 5000);
        return false;
    }

    return ext;
}
