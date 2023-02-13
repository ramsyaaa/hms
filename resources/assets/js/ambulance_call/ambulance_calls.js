'use strict';

listenClick('.ambulance-call-delete-btn', function (event) {
    let ambulanceCallId = $(event.currentTarget).attr('data-id');
    deleteItem($('#showAmbulanceCallUrl').val() + '/' + ambulanceCallId, '',
        $('#ambulanceCalls').val());
});
