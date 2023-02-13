listenClick('.patient-diagnosys-test-delete-btn', function (event) {
    let patientDiagnosisTestId = $(event.currentTarget).attr('data-id');
    deleteItem($('#patientDiagnosisTestUrl').val() + '/' + patientDiagnosisTestId,
        '', $('#patientDiagnosisTest').val());
});
