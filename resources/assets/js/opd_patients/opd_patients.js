listen('click', '.deleteOpdPatientBtn', function (event) {
    let opdPatientsId = $('.deleteOpdPatientBtn').attr('data-id');
    deleteItem($('#indexOpdPatientUrl').val() + '/' + opdPatientsId, null,
        $('#Receptionist').val())
});

