listen('click', '.delete-visit-btn', function (event) {
    let opdPatientId = $(event.currentTarget).attr('data-id');
    deleteItem($('#showOpdPatientUrl').val() + '/' + opdPatientId, '',
        $('#opdPatients').val())
});
