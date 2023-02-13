document.addEventListener('turbo:load', loadEditPaymentData)

function loadEditPaymentData() {
    if (!$('#paymentDate').length) {
        return
    }

    $('#paymentDate').flatpickr({
        dateFormat: 'Y-m-d',
        locale : $('.userCurrentLanguage').val(),
    });

    // $('select').focus();

    $('.price-input').trigger('input');
}
