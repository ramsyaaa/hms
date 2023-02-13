'use strict'

listen('click', '.delete-accountant-btn', function (event) {
    let accountantId = $(event.currentTarget).attr('data-id');
    deleteItem($('#accountantURL').val() + '/' + accountantId, '#accountantsTbl',
        $('#Accountant').val());
});

listenChange('.accountant-status', function (event) {
    let accountantId = $(event.currentTarget).attr('data-id');
    updateAccountantStatus(accountantId);
});

listen('click', '#resetFilter', function () {
    $('#accountant_filter_status').val(0).trigger('change');
    hideDropdownManually($('#accountantFilterBtn'), $('.dropdown-menu'));
});

listenChange('#accountant_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

function updateAccountantStatus(id) {
    $.ajax({
        url: $('#accountantURL').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                // tbl.ajax.reload(null, false);
                livewire.emit('refresh')
            }
        },
    });
}
