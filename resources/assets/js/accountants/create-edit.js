'use strict';

document.addEventListener('turbo:load', loadAccountantCreateEdit)

function loadAccountantCreateEdit () {
    
    if ($('#createAccountantForm').length || $('#editAccountantForm').length) {
        
        const bloodGroupElement = $('#bloodGroup')
        const birthDateElement = $('#birthDate')
        const createAccountantForm = $('#createAccountantForm')
        const editAccountantForm = $('#editAccountantForm')
        

        if (birthDateElement.length) {
            $('#birthDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if (createAccountantForm.length) {
            createAccountantForm.find('input:text:visible:first').focus();
        }

        if (editAccountantForm.length) {
            editAccountantForm.find('input:text:visible:first').focus();
        }

        if (bloodGroupElement.length) {
            $('#bloodGroup').select2({
                width: '100%',
            })
        }
        
    }else{

        return false;
        
    }
 
}

listenChange('.accountantProfileImage', function () {
    let extension = isValidImage($(this), '#customValidationErrorsBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#customValidationErrorsBox').html('').hide();
        displayDocument(this, '#customValidationErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#customValidationErrorsBox').removeClass('d-none hide');
        $('#customValidationErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=customValidationErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

listenChange('.editAccountantProfileImage', function () {
    let extension = isValidImage($(this), '#editAccountantErrorBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editAccountantErrorBox').html('').hide();
        displayDocument(this, '#editAccountantErrorBox', extension);
    }
    else {
        $(this).val('');
        $('#editAccountantErrorBox').removeClass('d-none hide');
        $('#editAccountantErrorBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editAccountantErrorBox]').focus();
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

listenClick('.remove-accountant-image', function () {
    defaultImagePreview('#previewImage', 1);
});

listenSubmit('#createAccountantForm, #editAccountantForm', function () {
    if ($('.error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
});
