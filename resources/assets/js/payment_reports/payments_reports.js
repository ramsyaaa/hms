document.addEventListener('turbo:load', loadPaymentReportData)

function loadPaymentReportData() {
    if (!$('#filterPaymentAccount').length) {
        return
    }
    $('#filterPaymentAccount').select2({
        width: '100%',
    });
}

listenChange('#filterPaymentReport', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

listen('click', '#paymentReportResetFilter', function () {
    $('#filterPaymentReport').val(0).trigger('change');
    hideDropdownManually($('#paymentReportFilterBtn'), $('.dropdown-menu'));
});

