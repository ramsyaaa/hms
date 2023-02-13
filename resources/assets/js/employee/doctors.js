
listenChange('#doctorsHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
listenClick('#doctorResetFilter', function () {
    $('#doctorsHead').val(2).trigger('change');
    hideDropdownManually($('#doctorsFilterBtn'), $('.dropdown-menu'));
});
