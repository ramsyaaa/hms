'use strict';


listen('click', '.deleteTechnicianBtn', function (event) {
    let labTechnicianId = $(event.currentTarget).attr('data-id');
    deleteItem($('#labTechnicianURL').val() + '/' + labTechnicianId, '',
        $('#labTechnician').val());
});

listenChange('.technicianStatus', function (event) {
    let labTechnicianId = $(event.currentTarget).attr('data-id');
    updateLabTechnicianStatus(labTechnicianId);
});

listenChange('#technicianFilterStatus', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

listen('click', '#technicianResetFilter', function () {
    $('#technicianFilterStatus').val(0).trigger('change');
    hideDropdownManually($('#labTechnicianFilterBtn'), $('.dropdown-menu'));
});

window.updateLabTechnicianStatus = function (id) {
    $.ajax({
        url: $('#labTechnicianURL').val() + '/' + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                livewire.emit('refresh');
            }
        },
    });
};
