document.addEventListener('turbo:load', loadDoctorsCreateEdit)

function loadDoctorsCreateEdit () {

    if ($('#createDoctorForm').length || $('#editDoctorForm').length) {

        const doctorBloodGroupElement = $('#doctorBloodGroup')
        const editDoctorBloodGroupElement = $('#editDoctorBloodGroup')
        const departmentIdElement = $('#departmentId')
        const doctorsDepartmentIdElement = $('#doctorsDepartmentId')
        const editDoctorsDepartmentIdElement = $('#editDoctorsDepartmentId')
        const createDoctorFormElement = $('#createDoctorForm')
        const editDoctorFormElement = $('#editDoctorForm')
        const doctorBirthDateElement = $('#doctorBirthDate')
        const editDoctorBirthDateElement = $('#editDoctorBirthDate')

        if (doctorBloodGroupElement.length) {
            $('#doctorBloodGroup').select2({
                width: '100%',
            });
        }

        if (editDoctorBloodGroupElement.length) {
            $('#editDoctorBloodGroup').select2({
                width: '100%',
            });
        }

        if (departmentIdElement.length) {
            $('#departmentId').select2({
                width: '100%',
            });
        }

        if (doctorsDepartmentIdElement.length) {
            $('#doctorsDepartmentId').select2({
                width: '100%',
            });
        }

        if (editDoctorsDepartmentIdElement.length) {
            $('#editDoctorsDepartmentId').select2({
                width: '100%',
            });
        }

        if (createDoctorFormElement.length) {
            $('#createDoctorForm').find('input:text:visible:first').focus();
        }

        if (editDoctorFormElement.length) {
            $('#editDoctorForm').find('input:text:visible:first').focus();
        }

        if (doctorBirthDateElement.length) {
            $('#doctorBirthDate').flatpickr({
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

        if (editDoctorBirthDateElement.length) {
            $('#editDoctorBirthDate').flatpickr({
                maxDate: new Date(),
                locale : $('.userCurrentLanguage').val(),
            });
        }

    } else {

        return false;

    }

}

listenChange('.doctorProfileImage', function () {
    let extension = isValidImage($(this), '#customValidationErrorsBox');
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

listenChange('.editDoctorProfileImage', function () {
    let extension = isValidImage($(this), '#editDoctorErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editDoctorErrorsBox').html('').hide();
        displayDocument(this, '#editDoctorErrorsBox', extension);
    }
    else {
        $(this).val('');
        $('#editDoctorErrorsBox').removeClass('d-none hide');
        $('#editDoctorErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editDoctorErrorsBox]').focus();
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


listenKeyup('#doctorFacebookUrl,#editDoctorFacebookUrl', function () {
    this.value = this.value.toLowerCase();
});

listenKeyup('#doctorTwitterUrl,#editDoctorTwitterUrl', function () {
    this.value = this.value.toLowerCase();
});

listenKeyup('#doctorInstagramUrl,#editDoctorInstagramUrl', function () {
    this.value = this.value.toLowerCase();
});

listenKeyup('#doctorLinkedInUrl,#editDoctorLinkedInUrl', function () {
    this.value = this.value.toLowerCase();
});

listenSubmit('#createDoctorForm, #editDoctorForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
    let facebookUrl = $('.facebookUrl').val();
    let twitterUrl = $('.twitterUrl').val();
    let instagramUrl = $('.instagramUrl').val();
    let linkedInUrl = $('.linkedInUrl').val();

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let instagramUrlExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(facebookExp) ? true : false));
    if (!facebookCheck) {
        displayErrorMessage('Please enter a valid Facebook URL');
        return false;
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false));
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter URL');
        return false;
    }
    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramUrlExp) ? true : false));
    if (!instagramCheck) {
        displayErrorMessage('Please enter a valid Instagram URL');
        return false;
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false));
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin URL');
        return false;
    }
});

listenClick('.doctor-remove-image', function () {
    defaultImagePreview('.previewImage', 1);
});

    

 
