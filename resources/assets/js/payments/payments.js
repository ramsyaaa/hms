listen('click', '.delete-payment-btn', function (event) {
    let paymentId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexPaymentUrl').val() + '/' + paymentId, '', $('#Payment').val());
});

listen('click', '.show-payment-btn', function (event) {
    event.preventDefault()
    let paymentId = $(event.currentTarget).attr('data-id');
    renderPaymentData(paymentId);
});

function renderPaymentData(id) {
    $.ajax({
        url: $('#paymentShowModal').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#payment_account').text(result.data.account.name);
                $('#payment_date').text(moment(result.data.payment_date).format('Do MMM, YYYY'));
                $('#pay_to').text(result.data.pay_to);
                $('#payment_amount').text(result.data.amount);
                $('#created_on').text(moment(result.data.created_at).fromNow());
                $('#updated_on').text(moment(result.data.updated_at).fromNow());
                $('#description').text(result.data.description);
                $('#description').css('overflow-wrap', 'break-word');

                setValueOfEmptySpan();
                $('#showPayment').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
