document.addEventListener('turbo:load', loadPaymentPrescriptionData)

function loadPaymentPrescriptionData() {
    if (!$('#indexPatientPrescriptionId').length) {
        return
    }

    $('#patient_id,#filter_status').select2({
        width: '100%',
    });
}


