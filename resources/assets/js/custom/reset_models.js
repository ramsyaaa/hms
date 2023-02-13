'use strict';

listenHiddenBsModal('#AddModal', function () {
    $('.preview-image').prop('src', $('.defaultImageUrl').val());
    $('.select2-dd').val('').trigger('change.select2');
    resetModalForm('#addNewForm', '#validationErrorsBox');
});
listenHiddenBsModal('#EditModal', function () {
    $('.preview-image').prop('src', $('.defaultImageUrl').val());
    $('.select2-dd').val('').trigger('change.select2');
    resetModalForm('#editForm', '#editValidationErrorsBox');
});
