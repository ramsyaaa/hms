document.addEventListener('turbo:load', loadNurseData)

function loadNurseData() {
    if (!$('#createNurseForm').length && !$('#editNurseForm').length) {
        return
    }

    $('#nurseBloodGroup').select2({
        width: '100%',
    });
    $('#editNurseBloodGroup').select2({
        width: '100%',
    });
    $('.nurseBirthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });
    $('#departmentId').select2({
        width: '100%',
    });
    $('#createNurseForm, #editNurseForm').find('input:text:visible:first').focus();

}

listenSubmit('#createNurseForm, #editNurseForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});

listenChange('.nurseProfileImage', function () {
    let extension = isValidOpdTimelineDocument($(this), '#nurseErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('.alert').html('').hide();
        displayDocument(this, '.nursePreviewImage', extension);
    }
    else {
        $(this).val('');
        $('#nurseErrorsBox').removeClass('d-none hide');
        $('#nurseErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=nurseErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

listenChange('.nurseProfileImage', function () {
    let extension = isValidOpdTimelineDocument($(this), '#editNurseErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('.alert').html('').hide();
        displayDocument(this, '.nursePreviewImage', extension);
    }
    else {
        $(this).val('');
        $('#editNurseErrorsBox').removeClass('d-none hide');
        $('#editNurseErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editNurseErrorsBox]').focus();
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
