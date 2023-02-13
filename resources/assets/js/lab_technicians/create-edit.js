document.addEventListener('turbo:load', loadLabTechnicianData)

function loadLabTechnicianData() {
    if (!$('#createLabTechnicianForm').length && !$('#editLabTechnicianForm').length) {
        return
    }

    $('#technicianBloodGroup').select2({
        width: '100%',
    });
    $('#editTechnicianBloodGroup').select2({
        width: '100%',
    });
    $('.departmentId').select2({
        width: '100%',
    });
    let birthDate = $('.technicianBirthDate').flatpickr({
        dateFormat: 'Y-m-d',
        useCurrent: false,
        locale : $('.userCurrentLanguage').val(),
    });
    birthDate.set('maxDate', new Date());
}
    listenSubmit('#createLabTechnicianForm, #editLabTechnicianForm', function () {
        if ($('.error-msg').text() !== '') {
            $('.phoneNumber').focus();
            return false;
        }
    });
    $('#createLabTechnicianForm, #editLabTechnicianForm').find('input:text:visible:first').focus();
    
listenChange('.technicianProfileImage', function () {
    let extension = isValidImage($(this), '#technicianErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#technicianErrorsBox').html('').hide();
        displayDocument(this, '#technicianErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#technicianErrorsBox').removeClass('d-none hide');
        $('#technicianErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=technicianErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

listenChange('.editTechnicianProfileImage', function () {
    let extension = isValidImage($(this), '#editTechnicianErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editTechnicianErrorsBox').html('').hide();
        displayDocument(this, '#editTechnicianErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#editTechnicianErrorsBox').removeClass('d-none hide');
        $('#editTechnicianErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editTechnicianErrorsBox]').focus();
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

