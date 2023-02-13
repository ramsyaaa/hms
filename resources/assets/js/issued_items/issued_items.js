$('#filter_status').select2()

listenClick('#issuedItemResetFilter', function () {
    $('#issuedItemHead').val(2).trigger('change')
})

listenClick('.deleteIssuedItemBtn', function (event) {
    let issuedItemId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexIssuedItemUrl').val() + '/' + issuedItemId,
        '',
        $('#issuedItem').val())
})

listenClick('.changes-status-btn', function (event) {
    let issuedItemId = $(this).attr('data-id');
    const issuedItemStatus = $(this).attr('status');
    Lang.setLocale($('.userCurrentLanguage').val())
    if (!issuedItemStatus) {
        swal({
            title: Lang.get('messages.appointment.change_status') + '!',
            text: Lang.get('messages.issued_item.are_you_sure_want_to_return_this_item') + '?',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: '#50cd89',
            showLoaderOnConfirm: true,
            buttons: {
                confirm: Lang.get('messages.common.yes'),
                cancel: Lang.get('messages.common.no'),
            },
        }).then(function (result) {
            if (result) {
                $.ajax({
                    url: $('#indexReturnIssuedItemUrl').val(),
                    type: 'get',
                    dataType: 'json',
                    data: { id: issuedItemId },
                    success: function (data) {
                        swal({
                            title: Lang.get('messages.issued_item.item_returned'),
                            icon: 'success',
                            confirmButtonColor: '#50cd89',
                            timer: 2000,
                        })
                        livewire.emit('refresh')
                    },
                })
            }
        })
    }
})
listenChange('#issuedItemHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#issuedItemFilter'), $('#issuedItemFilter'))
})
