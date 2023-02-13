listenChange('.enquiryStatus', function () {
    let enquiryId = $(this).attr('data-id');
    updateEnquiryStatus(enquiryId);
});

function updateEnquiryStatus(id) {
    $.ajax({
        url: $('#indexEnquiryUrl').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                Livewire.emit('refresh')
            }
        },
        });
    };

listenClick('#resetEnquiryFilter', function () {
    $('#enquiriesHead').val(2).trigger('change');
    hideDropdownManually($('#enquiriesFilterBtn'), $('.dropdown-menu'));

});

listenChange('#enquiriesHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
