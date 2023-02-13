import moment from 'moment'

document.addEventListener('turbo:load', loadOpdDiagnosisData)

function loadOpdDiagnosisData() {
    if (!$('#opdDiagnosisReportDate').length && !$('#editOpdDiagnosisReportDate').length) {
        return
    }
    $('#opdDiagnosisReportDate, #editOpdDiagnosisReportDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: "Y-m-d H:i",
        useCurrent: true,
        sideBySide: true,
        minDate: moment($('#showOpdAppointmentDate').val()).format('YYYY-MM-DD'),
        locale : $('.userCurrentLanguage').val(),
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
    });

}

listenClick('.deleteOpdDiagnosisBtn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#showOpdDiagnosisUrl').val() + '/' + id, null,
        $('#opdDiagnosisDeleteBtn').val())
});

listenSubmit('#addOpdDiagnosisForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnOpdDiagnosisSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#showOpdDiagnosisCreateUrl').val(),
        'type': 'POST',
    };
    newRecord(data, loadingButton, '#add_opd_diagnoses_modal');
    loadingButton.attr('disabled', false);
    });

listenClick('.editOpdDiagnosisBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let opdDiagnosisId = $(event.currentTarget).attr('data-id');
    renderOpdDiagnosisData(opdDiagnosisId);
});

window.renderOpdDiagnosisData = function (id) {
    $.ajax({
        url: $('#showOpdDiagnosisUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.opd_diagnosis_document_url.split('.').pop().toLowerCase();
                if (ext == 'pdf') {
                    $('#editOpdDiagnosisPreviewImage').css('background-image', 'url("' + $('.pdfDocumentImageUrl').val() + '")');
                } else if ((ext == 'docx') || (ext == 'doc')) {
                    $('#editOpdDiagnosisPreviewImage').css('background-image', 'url("' + $('.docxDocumentImageUrl').val() + '")');
                    } else {
                        if (result.data.opd_diagnosis_document_url != '') {
                            $('#editOpdDiagnosisPreviewImage').css('background-image', 'url("' + result.data.opd_diagnosis_document_url + '")');
                        }
                    }
                    $('#opdDiagnosisId').val(result.data.id);
                    $('#editOpdDiagnosisReportType').val(result.data.report_type);
                    document.querySelector('#editOpdDiagnosisReportDate')._flatpickr.setDate(moment(result.data.report_date).format());
                    $('#editOpdDiagnosisDescription').val(result.data.description);
                    if (result.data.opd_diagnosis_document_url != '') {
                        $('#opdDiagnosisDocumentUrl').show();
                        $('.btn-view').show();
                        $('#opdDiagnosisDocumentUrl').attr('href',
                            result.data.opd_diagnosis_document_url);
                    } else {
                        $('#opdDiagnosisDocumentUrl').hide();
                        $('.btn-view').hide();
                    }
                    $('#edit_opd_diagnoses_modal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

listenSubmit('#editOpdDiagnosisForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditOpdDiagnosisSave');
    loadingButton.button('loading');
    let id = $('#opdDiagnosisId').val();
    let url = $('#showOpdDiagnosisUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
        'tableSelector': null,
    };
        editRecord(data, loadingButton, '#edit_opd_diagnoses_modal');
    });

listenHiddenBsModal('#add_opd_diagnoses_modal', function () {
    resetModalForm('#addOpdDiagnosisForm', '#opdDiagnosisErrorsBox');
    $('#opdDiagnosisPreviewImage').attr('src', $('#showOpdDefaultDocumentImageUrl').val());
    $('#opdDiagnosisPreviewImage').css('background-image', 'url("' + $('#showOpdDefaultDocumentImageUrl').val() + '")');
});

listenHiddenBsModal('#edit_opd_diagnoses_modal', function () {
    resetModalForm('#editOpdDiagnosisForm', '#editOpdDiagnosisErrorsBox');
    $('#editOpdDiagnosisPreviewImage').attr('src', $('#showOpdDefaultDocumentImageUrl').val());
    $('#editOpdDiagnosisPreviewImage').css('background-image', 'url("' + $('#showOpdDefaultDocumentImageUrl').val() + '")');
});

listenChange('#opdDiagnosisDocumentImage', function () {
    let extension = isValidDocumentOpdDiagnosis($(this), '#opdDiagnosisErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#opdDiagnosisErrorsBox').html('').hide();
        displayDocument(this, '#opdDiagnosisPreviewImage', extension);
    }
});

listenChange('#editOpdDiagnosisDocumentImage', function () {
    let extension = isValidDocumentOpdDiagnosis($(this), '#editOpdDiagnosisErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editOpdDiagnosisErrorsBox').html('').hide();
        displayDocument(this, '#editOpdDiagnosisPreviewImage', extension);
    }
});

window.isValidDocumentOpdDiagnosis = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
        return false;
    }
    return ext;
};

listenClick('.removeOpdDiagnosisImage', function () {
    defaultImagePreview('#opdDiagnosisPreviewImage');
});
listenClick('.removeOpdDiagnosisImageEdit', function () {
    defaultImagePreview('#editOpdDiagnosisPreviewImage');
});
