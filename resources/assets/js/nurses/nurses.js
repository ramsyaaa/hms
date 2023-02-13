listen('click', '.deleteNurseBtn', function (event) {
    let nurseId = $(event.currentTarget).attr('data-id');
    deleteItem($('#nurseURL').val() + '/' + nurseId, '', $('#Nurse').val());
});

listenChange('.nurseStatus', function (event) {
    let nurseId = $(event.currentTarget).attr('data-id');
    updateNurseStatus(nurseId);
});

listen('click', '#nurseResetFilter', function () {
    $('#nurse_filter_status').val(0).trigger('change');
    hideDropdownManually($('#nurseFilterBtn'), $('.dropdown-menu'));
});

listenChange('#nurse_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
window.updateNurseStatus = function (id) {
    $.ajax({
        url: $('#nurseURL').val() + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                livewire.emit('refresh')
            }
        },
    });
};
