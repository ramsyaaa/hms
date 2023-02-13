document.addEventListener('turbo:load', loadIpdDiagnosisData)


function loadIpdDiagnosisData() {
    if (!$('#ipdDiagnosisReportDate').length && !$('#editIpdDiagnosisReportDate').length) {
        return
    }
    $('#ipdDiagnosisReportDate, #editIpdDiagnosisReportDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: "Y-m-d H:i",
        minDate: $('#showIpdPatientCaseDate').val(),
        locale : $('.userCurrentLanguage').val(),
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
    });

}

listen('click', '.ipdDignosis-delete-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#showIpdDiagnosisUrl').val() + '/' + id, '', $('#ipdDiagnosisDelete').val());
});

listenSubmit('#addIpdDiagnosisForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#showIpdDiagnosisCreateUrl').val(),
        'type': 'POST',
    };
    newRecord(data, loadingButton, '#add_ipd_diagnosis_modal');
});

listen('click', '.ipdDignosis-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let ipdDiagnosisId = $(event.currentTarget).attr('data-id');
    renderDataIpdDiagnosis(ipdDiagnosisId);
});

function renderDataIpdDiagnosis(id) {
    $.ajax({
        url: $('#showIpdDiagnosisUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.ipd_diagnosis_document_url.split('.').pop().toLowerCase();
                if (ext == 'pdf') {
                    $('#editIpdDiagnosisPreviewImage').css('background-image', 'url("' + $('.pdfDocumentImageUrl').val() + '")');
                } else if ((ext == 'docx') || (ext == 'doc')) {
                    $('#editIpdDiagnosisPreviewImage').css('background-image', 'url("' + $('.docxDocumentImageUrl').val() + '")');
                } else {
                    if (result.data.ipd_diagnosis_document_url != '') {
                        $('#editIpdDiagnosisPreviewImage').css('background-image', 'url("' + result.data.ipd_diagnosis_document_url + '")');
                    }
                }
                $('#ipdDiagnosisId').val(result.data.id);
                $('#editIpdDiagnosisReportType').val(result.data.report_type);
                document.querySelector('#editIpdDiagnosisReportDate')._flatpickr.setDate(moment(result.data.report_date).format());
                $('#editIpdDiagnosisDescription').val(result.data.description);
                if (result.data.ipd_diagnosis_document_url != '') {
                    $('#editIpdDiagnosisDocumentViewUrl').show();
                    $('.btn-view').show();
                    $('#editIpdDiagnosisDocumentViewUrl').attr('href', result.data.ipd_diagnosis_document_url);
                } else {
                    $('#editIpdDiagnosisDocumentViewUrl').hide();
                    $('.btn-view').hide();
                }
                $('#edit_ipd_diagnosis_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editIpdDiagnosisForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editIpdDiagnosisSave');
    loadingButton.button('loading');
    let id = $('#ipdDiagnosisId').val();
    let url = $('#showIpdDiagnosisUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
    };
    editRecord(data, loadingButton, '#edit_ipd_diagnosis_modal');
});

listenHiddenBsModal('#add_ipd_diagnosis_modal', function () {
    resetModalForm('#addIpdDiagnosisForm', '#ipdDiagnosisErrorsBox');
    $('#ipdDiagnosisPreviewImage').attr('src', $('#showDefaultDocumentImageUrl').val());
    $('#ipdDiagnosisPreviewImage').css('background-image', 'url("' + $('#showDefaultDocumentImageUrl').val() + '")');
});

listenHiddenBsModal('#edit_ipd_diagnosis_modal', function () {
    resetModalForm('#editIpdDiagnosisForm', '#editIpdDiagnosisErrorsBox');
    $('#editIpdDiagnosisPreviewImage').attr('src', $('#showDefaultDocumentImageUrl').val());
    $('#editIpdDiagnosisPreviewImage').css('background-image', 'url("' + $('#showDefaultDocumentImageUrl').val() + '")');
});

listenChange('#documentImage', function () {
    let extension = isValidIpdDiagnosisDocument($(this), '#ipdDiagnosisErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#ipdDiagnosisErrorsBox').html('').hide();
        displayDocument(this, '#ipdDiagnosisPreviewImage', extension);
    }
});

listenChange('#editDocumentImage', function () {
    let extension = isValidIpdDiagnosisDocument($(this), '#editIpdDiagnosisErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editIpdDiagnosisErrorsBox').html('').hide();
        displayDocument(this, '#editIpdDiagnosisPreviewImage', extension);
    }
});

function isValidIpdDiagnosisDocument(inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
        return false;
    }
    return ext;
};

listen('click', '.removeIpdDiagnosisImage', function () {
    defaultImagePreview('.previewImage');
});

listen('click', '.removeIpdDiagnosisImageEdit', function () {
    defaultImagePreview('.previewImage');
});
