listenClick('.deleteItemsBtn', function (event) {
    let itemId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexItemUrl').val() + '/' + itemId, '', $('#Items').val());
});
