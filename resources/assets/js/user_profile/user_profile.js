document.addEventListener('turbo:load', loadUserProfileData)

function loadUserProfileData() {
    $('#language').select2({
        width: '100%',
        dropdownParent: $("#changeLanguageModal")
    });
}

window.renderProfileData = function () {
    $.ajax({
        url: $('.profileUrl').val(),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let user = result.data;
                $('#editUserId').val(user.id);
                $('#firstName').val(user.first_name);
                $('#lastName').val(user.last_name);
                $('#email').val(user.email);
                $('#phone').val(user.phone);
                // $('#editPhoto').attr('src', user.image_url);
                $('#editPhoto').css('background-image', 'url("' + user.image_url + '")');
                $('#editProfileModal').modal('show');
            }
        },
    });
};
window.displayProfilePhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

listenSubmit('#changePasswordForm', function (event) {
    event.preventDefault();
    let isValidate = validateUserPassword();
    if (!isValidate) {
        return false;
    }
    let loadingButton = jQuery(this).find('#btnPrPasswordEditSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('.changePasswordUrl').val(),
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                $('#changePasswordModal').modal('hide');
                displaySuccessMessage(result.message);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

function validateUserPassword() {
    let currentPassword = $('#pfCurrentPassword').val().trim();
    let password = $('#pfNewPassword').val().trim();
    let confirmPassword = $('#pfNewConfirmPassword').val().trim();

    if (currentPassword == '' || password == '' || confirmPassword == '') {
        $('#editPasswordValidationErrorsBox').show().html('Please fill all the required fields.');
        return false;
    }
    return true;
}

listenSubmit('#editProfileForm', function (event) {
    event.preventDefault();
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
    let loadingButton = jQuery(this).find('#btnPrEditSave');
    loadingButton.button('loading');
    $.ajax({
        url: $('.profileUpdateUrl').val(),
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            $('#editProfileModal').modal('hide');
            setTimeout(function () {
                location.reload();
            }, 2000);
        },
        error: function (result) {
            manageAjaxErrors(result, 'editProfileValidationErrorsBox');
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenSubmit('#changeLanguageForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnLanguageChange');
    loadingButton.button('loading');
    $.ajax({
        url: $('.updateLanguageURL').val(),
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            setTimeout(function () {
                location.reload();
            }, 2000);
        },
        error: function (result) {
            manageAjaxErrors(result, 'editProfileValidationErrorsBox');
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenHiddenBsModal('#editProfileModal', function () {
    resetModalForm('#editProfileForm', '#editProfileValidationErrorsBox');
    $('#change-btn').show();
});

// open edit user profile model
listenClick('.editProfile', function (event) {
    let userId = $(event.currentTarget).attr('data-id');
    renderProfileData();
});
listenChange('#profileImage', function () {
    let ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(this).val('');
        // $('#editProfileValidationErrorsBox').html('The profile image must be a file of type: jpeg, jpg, png.').show();
        displayErrorMessage('The profile image must be a file of type: jpeg, jpg, png.')
    } else {
        displayProfilePhoto(this, '#editPhoto');
    }

    $('#change-btn').hide();
});

listenClick('.changeType', function (e) {
    let inputField = $(this).parent().siblings();
    let oldType = inputField.attr('type');
    if (oldType == 'password') {
        $(this).children().addClass('icon-eye');
        $(this).children().removeClass('icon-ban');
        inputField.attr('type', 'text');
    } else {
        $(this).children().removeClass('icon-eye');
        $(this).children().addClass('icon-ban');
        inputField.attr('type', 'password');
    }
});

listenHiddenBsModal('#changePasswordModal', function () {
    resetModalForm('#changePasswordForm', '#editPasswordValidationErrorsBox');
});

listenHiddenBsModal('#changeLanguageModal', function () {
    $('#language').val($('.userCurrentLanguage').val()).trigger('change.select2');
});

listenClick('.remove-profile-image', function () {
    defaultImagePreview('#editPhoto', 1);
});

