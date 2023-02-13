'use strict';


listenChange('#patients_prescription_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});
listenClick('#patientPrescriptionResetFilter', function () {
    $('#patients_prescription_filter_status').val(2).trigger('change');
    hideDropdownManually($('#patientsPrescriptionFilterBtn'), $('.dropdown-menu'));
});

