document.addEventListener('turbo:load', loadPatientDiagnosisTestData)

function loadPatientDiagnosisTestData() {
    if (!$('#diagnosisTestPatientId').length && !$('#editDiagnosisTestPatientId').length) {
        return
    }
    
    $('#diagnosisTestPatientId,#diagnosisTestDoctorId,#diagnosisTestCategoryId').select2();
    $('#editDiagnosisTestPatientId,#editDiagnosisTestDoctorId,#editDiagnosisTestCategoryId').select2();
}

listenClick('#addDiagnosisTestItem,#addEditDiagnosisTestItem', function () {
    let uniqueId = $('.uniqueId').val();
    let data = {
        'uniqueId': uniqueId,
    };
        let patientDiagnosisTestHtml = prepareTemplateRender(
            '#patientDiagnosisTestTemplate', data);
        $('.diagnosis-item-container').append(patientDiagnosisTestHtml);
        uniqueId++;

        resetPatientDiagnosisTestIndex();
    });

    listenClick('.delete-diagnosis', function () {
        $(this).parents('tr').remove();
        resetPatientDiagnosisTestIndex();
    });

    function resetPatientDiagnosisTestIndex() {
        let index = 1;
        $('.diagnosis-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
    }

    listenSubmit('.patientDiagnosisTestForm', function (event) {
        event.preventDefault();
        // screenLock();
        let loadingButton = jQuery(this).find('.saveBtn');
        loadingButton.attr('disabled',true)
        // loadingButton.button('loading');
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: $('.patientDiagnosisTestSaveUrl').val(),
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                displaySuccessMessage(result.message);
                window.location.href = $('.patientDiagnosisTest').val();
                loadingButton.attr('disabled',false)
            },
            error: function (result) {
                printErrorMessage('#diagnosisTestErrorsBox', result);
                loadingButton.attr('disabled',false)
            },
            // complete: function () {
            //     screenUnLock();
            //     loadingButton.button('reset');
            // },
        });
    });

