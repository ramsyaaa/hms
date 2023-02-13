document.addEventListener('turbo:load', loadAdminInvoiceData)

function loadAdminInvoiceData()
{
    listen('click', '#resetEmployeeInvoiceFilter', function () {
        $('#invoice_status_filter').val(2).trigger('change');
        hideDropdownManually($('#invoiceFilterBtn'), $('.dropdown-menu'));
    });
}

listen('click', '.deleteInvoicesBtn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexInvoiceUrl').val() + '/' + id, '', $('#Invoices').val());
});

listenChange('#invoice_status_filter', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});


