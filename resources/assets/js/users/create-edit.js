document.addEventListener('turbo:load', loadUserCreateEdit)

function loadUserCreateEdit () {
    if (!$('#userDob').length) {
        return
    }

    $('#userDob').flatpickr({
        maxDate: new Date(),
        locale: $('.userCurrentLanguage').val(),
    })
}

listen('submit', '#createUserForm, #editUserForm', function () {
    $('#userBtnSave').attr('disabled', true)
})

listenKeyup('#userFacebookUrl', function () {
    this.value = this.value.toLowerCase()
})
listenKeyup('#userTwitterUrl', function () {
    this.value = this.value.toLowerCase()
})
listenKeyup('#userInstagramUrl', function () {
    this.value = this.value.toLowerCase()
})
listenKeyup('#userLinkedInUrl', function () {
    this.value = this.value.toLowerCase()
})

listenSubmit('#createUserForm, #editUserForm', function () {
    if ($('.error-msg').text() !== '') {
        $('#userPhoneNumber').focus()
        return false
    }

    let facebookUrl = $('#userFacebookUrl').val()
    let twitterUrl = $('#userTwitterUrl').val()
    let instagramUrl = $('#userInstagramUrl').val()
    let linkedInUrl = $('#userLinkedInUrl').val()

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i)
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i)
    let instagramUrlExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i)
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i)

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
        facebookExp) ? true : false))
    if (!facebookCheck) {
        displayErrorMessage('Please enter a valid Facebook URL')
        $('#userBtnSave').attr('disabled', false)
        return false
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false))
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter URL')
        $('#userBtnSave').attr('disabled', false)
        return false
    }
    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramUrlExp) ? true : false))
    if (!instagramCheck) {
        displayErrorMessage('Please enter a valid Instagram URL')
        $('#userBtnSave').attr('disabled', false)
        return false
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false))
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin URL')
        $('#userBtnSave').attr('disabled', false)
        return false
    }
})

listen('keyup keypress', '#createUserForm, #editUserForm'
    , function (e) {
        let keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })
listen('change', '#userProfileImage', function () {
    let extension = isValidUsersDocument($(this), '#userValidationErrorsBox')
    if (!isEmpty(extension) && extension != false) {
        $('#userValidationErrorsBox').html('').hide()
        displayDocument(this, '#userPreviewImage', extension)
    }
    else {
        $(this).val('');
        $('#userValidationErrorsBox').removeClass('d-none hide');
        $('#userValidationErrorsBox').text('The image must be a file of type: jpg, jpeg, png.').show();
        $('[id=userValidationErrorsBox]').focus();
        $("html, body").animate({ scrollTop: "0" },  500);
        $('.alert').delay(5000).slideUp(300)
    }
})

function isValidUsersDocument (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase()
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        return false
    }
    $(validationMessageSelector).addClass('d-none')
    $('#userBtnSave').attr('disabled', false)
    return ext
}

listen('click', '.remove-users-image', function () {
    defaultImagePreview('#userPreviewImage', 1)
})

