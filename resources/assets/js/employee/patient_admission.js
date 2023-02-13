
listenChange('#patient_admission_filter_status', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
    hideDropdownManually($('#patientAdmissionFilterBtn'), $('#patientAdmissionFilterDiv'));
});
listenClick('#admissionResetFilter', function () {
    $('#patient_admission_filter_status').val(0).trigger('change');
    hideDropdownManually($('#patientAdmissionFilterBtn'), $('#patientAdmissionFilterDiv'));
});
