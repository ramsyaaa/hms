listenClick('#investigationResetFilter', function () {
    $('#investigationHead').val(0).trigger('change');
    hideDropdownManually($('#investigationFilterBtn'), $('.dropdown-menu'));
});

listenClick('.deleteInvestigationBtn', function (event) {
    let investigationReportId = $(event.currentTarget).attr('data-id');
    deleteItem(
        $('#indexInvestigationReportUrl').val() + '/' + investigationReportId,
        '',
        $('#investigationReport').val(),
    );
});
listenChange('#investigationHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
