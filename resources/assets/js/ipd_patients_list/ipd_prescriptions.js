
    listenClick('.viewIpdPrescription', function () {
        $.ajax({
            url: $('#showIpdPrescriptionUrl').val() + '/' + $(this).data('id'),
            type: 'get',
            success: function (result) {
                $('#ipdPrescriptionViewData').html(result);
                $('#showIpdPrescriptionModal').modal('show');
                ajaxCallCompleted();
            },
        });
    });

    listenClick('.printIpdPrescription', function () {
        let divToPrint = document.getElementById('DivIdToPrint');
        let newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write(
            '<html><link href="' + $('#showListBootstrapUrl').val() +
            '" rel="stylesheet" type="text/css"/>' +
            '<body onload="window.print()">' + divToPrint.innerHTML +
            '</body></html>');
        newWin.document.close();
        setTimeout(function () {
            newWin.close();
        }, 10);
    });

