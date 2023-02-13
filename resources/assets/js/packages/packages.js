'use strict';


listenClick('.deletePackageBtn', function (event) {
    let packageId = $(event.currentTarget).attr('data-id');
    deleteItem(
        $('#showPackageReportUrl').val() + '/' + packageId,
        '',
        $('#Packages').val(),
    );
});
