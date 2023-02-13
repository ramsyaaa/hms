'use strict';

document.addEventListener('turbo:load', loadAmbulanceCallCreateEdit)

function loadAmbulanceCallCreateEdit(){

    if ($('#createAmbulanceCall').length || $('#editAmbulanceCall').length) {
        
        const callAmbulanceIdElement = $('#callAmbulanceId')
        const ambulanceCallPatientIdElement = $('#ambulanceCallPatientId')
        const ambulanceCallDateElement = $('#ambulanceCallDate')

        if(callAmbulanceIdElement.length){
            $('#callAmbulanceId').select2({
                width: '100%',
            });
        }

        if(ambulanceCallPatientIdElement.length){
            $('#ambulanceCallPatientId').select2({
                width: '100%',
            });
            // $('#ambulanceCallPatientId').focus();
        }

        if(ambulanceCallDateElement.length){
            $('#ambulanceCallDate').flatpickr({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true,
                locale : $('.userCurrentLanguage').val(),
            });
        }
        $('.price-input').trigger('input');
        
    }else{
        
        return false;
        
    }
    
}

listenChange('#callAmbulanceId', function () {
    $('#ambulanceCallDriverName').val('');
    if(!isEmpty($(this).val())) {
        $.ajax({
            url: $('.getDriverNameUrl').val(),
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (result) {
                $('#ambulanceCallDriverName').val(result.data);
            },
            error: function (result) {
                printErrorMessage('#ambulanceCallValidationErrorsBox', result);
            },
        });
    }
});

listenSubmit('#createAmbulanceCall, #editAmbulanceCall', function () {
    $('#ambulanceCallSaveBtn').attr('disabled', true);
});
 
