'use strict'

listenClick( '.birth-report-delete-btn', function (event) {
    let birthReportsId = $(event.currentTarget).attr('data-id')
    deleteItem($('.birthReportUrl').val() + '/' + birthReportsId,
        '', $('#birthReport').val())
});
