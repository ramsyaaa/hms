document.addEventListener('turbo:load', loadEditReceptionistsData)

function loadEditReceptionistsData() {
    createReceptionistForm()
    editReceptionistForm()
}

function createReceptionistForm() {
    if (!$('#receptionistBirthDate').length) {
        return
    }

    $('#receptionistBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });
    $('#receptionistBloodGroup').select2({
        width: '100%',
    });

    $('#receptionistDepartmentId').select2({
        width: '100%',
    });
    $('#createReceptionForm').find('input:text:visible:first').focus();

}

function editReceptionistForm() {
    if (!$('#editReceptionistBirthDate').length) {
        return
    }
    $('#editReceptionistBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });

    $('#editReceptionistBloodGroup').select2({
        width: '100%',
    });

    $('#editReceptionForm').find('input:text:visible:first').focus();
}


listenSubmit('#createReceptionForm, #editReceptionForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});
listenClick('.remove-receptionist-image', function () {
    defaultImagePreview('#receptionistPreviewImage', 1);
});

listenChange('.receptionistProfileImage', function () {
    let extension = isValidImage($(this), '#receptionistErrorsBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#receptionistErrorsBox').html('').hide();
        displayDocument(this, '#customValidationErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#receptionistErrorsBox').removeClass('d-none hide');
        $('#receptionistErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=receptionistErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

listenChange('.editReceptionistProfileImage', function () {
    let extension = isValidImage($(this), '#editReceptionistErrorsBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#editReceptionistErrorsBox').html('').hide();
        displayDocument(this, '#customValidationErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#editReceptionistErrorsBox').removeClass('d-none hide');
        $('#editReceptionistErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editReceptionistErrorsBox]').focus();
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
