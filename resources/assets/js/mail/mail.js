document.addEventListener('turbo:load', loadMailData)

function loadMailData() {
    if (!$('#mailEmailId').length) {
        return
    }
    $('#mailEmailId').focus();

}

    listenChange('#mailDocumentImage', function () {
        let extension = isValidMailDocument($(this), '#mailValidationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#mailValidationErrorsBox').html('').hide();
            displayDocument(this, '#mailPreviewImage', extension);
        }
    });

window.isValidMailDocument = function (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
        -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
        return false;
    }
    return ext;
    };

    listenClick('.removeMailImage', function () {
        defaultImagePreview('#mailPreviewImage');
    });
