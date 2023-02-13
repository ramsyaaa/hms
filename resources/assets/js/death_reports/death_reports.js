'use strict'

listenClick( '.death-report-delete-btn', function (event) {
    let deathReportId = $(event.currentTarget).attr('data-id');
    deleteItem($('.deathReportUrl').val() + '/' + deathReportId, '', $('#deathReport').val());
});
