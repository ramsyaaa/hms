document.addEventListener('turbo:load', loadIpdStrikePaymentData)

function loadIpdStrikePaymentData() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
}
listenClick('#ipdPaymentBtn', function () {
    let payloadData = {
        amount: parseInt($('#billAmount').val()),
        ipdNumber: $('#ipdNumber').val(),
        // charge_currency: $('#payment_currency').val(),
    };
    
    let stripeKey = $('#stripeConfigKey').val();
    let stripe = Stripe(stripeKey);

    // return false;
    $(this).html(
        '<div class="spinner-border spinner-border-sm " role="status">\n' +
        '                                            <span class="sr-only">Loading...</span>\n' +
        '                                        </div>').addClass('disabled');
    $.post($('#showListIpdStripePaymentUrl').val(), payloadData).done((result) => {
        let sessionId = result.data.sessionId;
        stripe.redirectToCheckout({
            sessionId: sessionId,
        }).then(function (result) {
            $(this).html('Make Payment').removeClass('disabled');
            manageAjaxErrors(result);
        });
    }).catch(error => {
        $(this).html('Make Payment').removeClass('disabled');
        manageAjaxErrors(error);
    });
});
