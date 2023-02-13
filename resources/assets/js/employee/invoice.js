document.addEventListener('turbo:load', loadEmployeeDoctorData)

function loadEmployeeDoctorData() {
    if (!$('#invoice_status_filter').length) {
        return
    }
    $('#invoice_status_filter').select2({
        width: '100%',
    });
}
listenChange('#invoice_status_filter', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

listen('click', '#resetEmployeeInvoiceFilter', function () {
    $('#invoice_status_filter').val(0).trigger('change');
});
