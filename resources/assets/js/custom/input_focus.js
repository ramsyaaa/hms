'use strict';

listen('focus', '.image__file-upload', function () {
    $('.image__file-upload').on('keypress', function (e) {
        if (e.keyCode === 13) {
            $('#profileImage').trigger('click');
        }
    });
});

listen('focus', '.switch-label', function () {
    $('.switch-label').on('keypress', function (e) {
        if (e.keyCode === 13) {
            $('.switch-input').trigger('click');
        }
    });
});
