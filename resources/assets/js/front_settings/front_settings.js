listenChange('#aboutUsImage', function () {
    let extension = isValidFrontSettingImage($(this), '#aboutUsErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#aboutUsErrorsBox').html('').hide();
        displayDocument(this, '#aboutUsPreviewImage', extension);
    }
});

function isValidFrontSettingImage(inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).html(Lang.get('messages.allow_file_type')).show();
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};
