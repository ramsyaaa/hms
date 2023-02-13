'use strict'

listenClick('.bill-delete-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    deleteItem($('#indexBillUrl').val() + '/' + id, '', $('#Bill').val());
});
