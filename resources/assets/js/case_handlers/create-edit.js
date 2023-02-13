'use strict';

document.addEventListener('turbo:load', loadCaseHandlersCreateEdit)

function loadCaseHandlersCreateEdit () {

    if ($('#createCaseHandlerForm').length || $('#editCaseHandlerForm').length) {

        const caseHandlerBirthDateElement = $('#caseHandlerBirthDate')
        const editCaseHandlerBirthDateElement = $('#editCaseHandlerBirthDate')
        const createCaseHandlerFormElement = $('#createCaseHandlerForm')
        const editCaseHandlerFormElement = $('#editCaseHandlerForm')

        if(caseHandlerBirthDateElement.length){
            $('#caseHandlerBirthDate').flatpickr({
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if(editCaseHandlerBirthDateElement.length){
            $('#editCaseHandlerBirthDate').flatpickr({
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if (createCaseHandlerFormElement.length){
            $('#createCaseHandlerForm').
                find('input:text:visible:first').
                focus();
        }

        if (editCaseHandlerFormElement.length){
            $('#editCaseHandlerForm').
                find('input:text:visible:first').
                focus();
        }


    }else{

        return false;

    }

}

listenSubmit('#createCaseHandlerForm, #editCaseHandlerForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});

listenClick('.case-andler-remove-image', function () {
    defaultImagePreview('.previewImage', 1);
});

listenChange('.caseHandlerProfileImage', function () {
    let extension = isValidImage($(this), '#caseHandlerErrorBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#caseHandlerErrorBox').html('').hide();
        displayDocument(this, '#customValidationErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#caseHandlerErrorBox').removeClass('d-none hide');
        $('#caseHandlerErrorBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=caseHandlerErrorBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

listenChange('.editCaseHandlerProfileImage', function () {
    let extension = isValidImage($(this), '#editCaseHandlerErrorsBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#editCaseHandlerErrorsBox').html('').hide();
        displayDocument(this, '#customValidationErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#editCaseHandlerErrorsBox').removeClass('d-none hide');
        $('#editCaseHandlerErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editCaseHandlerErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

function isValidImage(inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};
