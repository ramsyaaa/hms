document.addEventListener('turbo:load', loadInsurancesCreateEdit)

function loadInsurancesCreateEdit () {
    if (!$('#createInvestigationForm').length && !$('#editInvestigationForm').length) {
        return
    }


    $('#investigationDate,#editInvestigationDate').flatpickr({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: true,
        sideBySide: true,
        enableTime: true,
        locale : $('.userCurrentLanguage').val(),
    });
    $('#investigationPatientId,#investigationDoctorId,#investigationStatus').select2({
        width: '100%',
    });

    $('#createInvestigationForm, #editInvestigationForm').
        find('input:text:visible:first').
        focus();
};

// listenChange('#investigationAttachment', function () {
//     let extension = isValidInvestigationDocument($(this), '#investigationErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         $('#investigationErrorsBox').html('').hide();
//         //document url
//         if (extension === 'pdf') {
//             $('.image-input-wrapper').css('background-image', 'url(' + $('.pdfDocumentImageUrl').val() + ')');
//         } else if (extension === 'doc') {
//             $('.image-input-wrapper').css('background-image', 'url(' + $('.docxDocumentImageUrl').val() + ')');
//         }
//         //old preview
//         // displayDocument(this, '#previewImage', extension);
//     }
// });

// function isValidInvestigationDocument(inputSelector, validationMessageSelector) {
//     let ext = $(inputSelector).val().split('.').pop().toLowerCase();
//     if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
//         $(inputSelector).val('');
//         $(validationMessageSelector).html(
//             'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
//         return false;
//     }
//     return ext;
// }

listenClick('.removeInvestigationImage', function () {
    defaultImagePreview('#investigationPreviewImage');
});

