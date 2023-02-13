document.addEventListener('turbo:load', loadPatientData)

function loadPatientData() {
    if (!$('#createPatientForm').length && !$('#editPatientForm').length) {
        return
    }
    $('.patientBirthDate').flatpickr({
        maxDate: new Date(),
        locale : $('.userCurrentLanguage').val(),
    });
}

listenKeyup('.patientFacebookUrl', function () {
    this.value = this.value.toLowerCase();
});
listenKeyup('.patientTwitterUrl', function () {
    this.value = this.value.toLowerCase();
});
listenKeyup('.patientInstagramUrl', function () {
    this.value = this.value.toLowerCase();
});
listenKeyup('.patientLinkedInUrl', function () {
    this.value = this.value.toLowerCase();
});

    listenSubmit('#createPatientForm, #editPatientForm', function () {
        if ($('.error-msg').text() !== '') {
            $('.phoneNumber').focus();
            return false;
        }

        let facebookUrl = $('.patientFacebookUrl').val();
        let twitterUrl = $('.patientTwitterUrl').val();
        let instagramUrl = $('.patientInstagramUrl').val();
        let linkedInUrl = $('.patientLinkedInUrl').val();

        let facebookExp = new RegExp(
            /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
        let twitterExp = new RegExp(
            /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
        let instagramUrlExp = new RegExp(
            /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
        let linkedInExp = new RegExp(
            /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

        let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
            facebookExp) ? true : false));
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
    $('#createPatientForm, #editPatientForm').find('input:text:visible:first').focus();

listenClick('.remove-patient-image', function () {
    defaultImagePreview('.previewImage', 1);
});

listenChange('.patientProfileImage', function () {
    let extension = isValidImage($(this), '#patientErrorBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#patientErrorBox').html('').hide();
        displayDocument(this, '#patientErrorBox', extension);
    }
    else {
        $(this).val('');
        $('#patientErrorBox').removeClass('d-none hide');
        $('#patientErrorBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=patientErrorBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
});

listenChange('.editPatientImage', function () {
    let extension = isValidImage($(this), '#editPatientErrorsBox');
    console.log(extension)
    if (!isEmpty(extension) && extension != false) {
        $('#editPatientErrorsBox').html('').hide();
        displayDocument(this, '#patientErrorBox', extension);
    }
    else {
        $(this).val('');
        $('#editPatientErrorsBox').removeClass('d-none hide');
        $('#editPatientErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=editPatientErrorsBox]').focus();
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
