listenClick('.deleteStockBtn', function (event) {
    let itemStockId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexItemStockUrl').val() + '/' + itemStockId, '',
        $('#itemStock').val());
});
