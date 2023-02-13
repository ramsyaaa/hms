document.addEventListener('turbo:load', loadVisitorData)

function loadVisitorData() {
    if (!$('#purposeArr').length) {
        return
    }

    $('#purposeArr').select2({
        width: '100%',
    });

}

listenClick('.delete-visitor-btn', function (event) {
    let visitorId = $(event.currentTarget).attr('data-id');
    deleteItem($('.visitorUrl').val() + '/' + visitorId, '', $('#Visitor').val());
});

listenClick('#visitorResetFilter', function () {
    $('#visitorsHead').val(0).trigger('change');
    hideDropdownManually($('#visitorsFilterBtn'), $('.dropdown-menu'));
});
listenChange('#visitorsHead', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
