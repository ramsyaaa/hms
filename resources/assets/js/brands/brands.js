'use strict'

listenClick( '.brand-delete-btn', function (event) {
    let brandId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexBrandUrl').val() + '/' + brandId, '', $('#medicineBrand').val());
});

listenSubmit('#createBrandForm, #editBrandForm', function () {
    if ($('.error-msg').text() !== '') {
        $('.phoneNumber').focus();
        return false;
    }
});
