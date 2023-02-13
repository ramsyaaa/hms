listenClick('.deleteOperationReportsBtn', function (event) {
    let operationReportId = $(event.currentTarget).attr('data-id')
    deleteItem($('#operationReportUrl').val() + '/' + operationReportId,
        '',
        $('#operationReport').val())
})

