'use strict'

listenClick('.delete-btn', function (event) {
        let caseHandlerId = $(event.currentTarget).attr('data-id');
        deleteItem($('#indexCaseHandlerUrl').val() + '/' + caseHandlerId, '',
            $('#caseHandler').val());
});

listenChange('.case-handler-status', function (event) {
        let caseHandlerId = $(event.currentTarget).attr('data-id');
    updateCaseHandlerStatus(caseHandlerId);
});

listenClick('#caseHandlerResetFilter', function () {
    $('#caseHandlerHead').val(2).trigger('change');
    hideDropdownManually($('#caseHandlerFilterBtn'), $('.dropdown-menu'));
});

function updateCaseHandlerStatus(id) {
    $.ajax({
        url: $('#indexCaseHandlerUrl').val() + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                livewire.emit('refresh');
            }
        },
    });
}

listenChange('#caseHandlerHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#caseHandlerFilterBtn'), $('#caseHandlerFilter'));
});
