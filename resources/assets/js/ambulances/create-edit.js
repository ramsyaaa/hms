'use strict';

document.addEventListener('turbo:load', loadAmbulanceCreateEdit)

    function loadAmbulanceCreateEdit(){

        if ($('#createAmbulanceForm').length || $('#editAmbulanceForm').length) {

            const vehicleTypeElement = $('#vehicleType')
            const createAmbulanceFormElement = $('#createAmbulanceForm')
            const editAmbulanceFormElement = $('#editAmbulanceForm')
           
            if(vehicleTypeElement.length){
                $('#vehicleType').select2({
                    width: '100%',
                });
            }
        
            if(createAmbulanceFormElement.length){
                $('#createAmbulanceForm').find('input:text:visible:first').focus();
            }

            if(editAmbulanceFormElement.length){
                $('#editAmbulanceForm').find('input:text:visible:first').focus();
            }
        
        }else{
            
            return false;
            
        }
    }

    listenSubmit('#createAmbulanceForm, #editAmbulanceForm', function () {
        $('.btnSave').attr('disabled', true);

        if ($('.error-msg').text() !== '') {
            $('.phoneNumber').focus();
            $('.btnSave').attr('disabled', false);
            return false;
        }
    });

    listen('keyup keypress', '#createAmbulanceForm, #editAmbulanceForm', function (e){
        let keyCode = e.keyCode || e.which
        if(keyCode === 13) {
            e.preventDefault();
            return false;
        }
    })
 
