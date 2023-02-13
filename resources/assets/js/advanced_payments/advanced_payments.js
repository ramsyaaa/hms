'use strict'

listen('click', '.advance-payment-delete-btn', function (event) {
    let advancedPaymentId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexAdvancedPaymentUrl').val() + '/' + advancedPaymentId,
        '', $('#advancedPayment').val());
});
