'use strict';
 
listenClick('.charge-category-delete-btn', function (event) {
    let chargeCategoryId = $(event.currentTarget).attr('data-id');
    deleteItem($('#chargeCategoryURLID').val() + '/' + chargeCategoryId,
        '',
        $('#chargeCategory').val());
});

document.addEventListener('success', function (data){
    displaySuccessMessage(data.detail)
})
