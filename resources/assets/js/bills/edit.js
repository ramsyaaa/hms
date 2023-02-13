'use strict';

document.addEventListener('turbo:load', loadBillEdit)

function loadBillEdit () {

    if (!$('#editBillPatientAdmissionId').length) {
        return false;
    }

    setTimeout(function () {
        $('#patientAdmissionId').val($('#editBillPatientAdmissionId').val());
        $('#patientAdmissionId').trigger('change');
    }, 500);

}

