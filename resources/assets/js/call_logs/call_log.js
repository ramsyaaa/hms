'use strict'

listenClick('#callLogResetFilter', function () {
    $('#callType').val(0).trigger('change');
    hideDropdownManually($('#callTypeFilterBtn'), $('.dropdown-menu'));
});

listenClick( '.call-log-delete-btn', function (event) {
    let callLogId = $(event.currentTarget).attr('data-id');
    deleteItem($('.callLogUrl').val() + '/' + callLogId, '', $('#callLogs').val());
});
listenChange('#callType', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

