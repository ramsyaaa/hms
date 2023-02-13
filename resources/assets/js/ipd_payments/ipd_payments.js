document.addEventListener('turbo:load', loadIpdPaymentData)

function loadIpdPaymentData() {
    if (!$('#addIpdPaymentNewForm').length && !$('#editIpdPaymentForm').length) {
        return
    }

    $('#ipdPaymentDate,#editIpdPaymentDate').flatpickr({
        dateFormat: "Y-m-d",
        enableTime: false,
        minDate: $('#showIpdPatientCaseDate').val(),
        locale : $('.userCurrentLanguage').val(),
        widgetPositioning: {
            horizontal: 'right',
            vertical: 'bottom',
        },
    });

    $('#ipdPaymentModeId').select2({
        width: '100%',
        dropdownParent: $('#addIpdPaymentModal')
    });
    $('#editIpdPaymentModeId').select2({
        width: '100%',
        dropdownParent: $('#editIpdPaymentModal')
    });
}

listen('click', '.ipdpayment-delete-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#showIpdPaymentUrl').val() + '/' + id, null,
        $('#ipdPaymentButton').val())
    
});

listen('click', '.ipdpayment-edit-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let ipdPaymentId = $(event.currentTarget).attr('data-id');
    renderIpdPaymentData(ipdPaymentId);
});

listenSubmit('#addIpdPaymentNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnIpdPaymentSave');
    loadingButton.button('loading');

    var formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#showIpdPaymentCreateUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addIpdPaymentModal').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function error (result) {
            printErrorMessage('#ipdPaymentValidationErrorsBox', result);
        },
        complete: function complete () {
            loadingButton.button('reset');
        },
    });

});

function renderIpdPaymentData(id) {
    $.ajax({
        url: $('#showIpdPaymentUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.ipd_payment_document_url.split('.').pop().toLowerCase();
                if (ext == 'pdf') {
                    $('#editIpdPaymentPreviewImage').css('background-image', 'url("' + $('.pdfDocumentImageUrl').val() + '")');
                } else if ((ext == 'docx') || (ext == 'doc')) {
                    $('#editIpdPaymentPreviewImage').css('background-image', 'url("' + $('.docxDocumentImageUrl').val() + '")');
                } else {
                    if (result.data.ipd_payment_document_url != '') {
                        $('#editIpdPaymentPreviewImage').css('background-image', 'url("' + result.data.ipd_payment_document_url + '")');
                    }
                    else {
                        $('#editIpdPaymentPreviewImage').css('background-image', 'url("' + $('.showDefaultDocumentImageUrl').val() + '")');
                    }
                }
                $('#ipdPaymentId').val(result.data.id);
                $('#editIpdPaymentAmount').val(result.data.amount);
                document.querySelector('#editIpdPaymentDate')._flatpickr.setDate(moment(result.data.date).format('YYYY-MM-DD h:mm A'));
                $('#editIpdPaymentNote').val(result.data.notes);
                $('#editIpdPaymentModeId').val(result.data.payment_mode).trigger('change.select2');
                $('#editIpdPaymentModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editIpdPaymentForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditIpdPaymentSave');
    loadingButton.button('loading');
    let id = $('#ipdPaymentId').val();
    let url = $('#showIpdPaymentUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
    };
    editIpdPaymentRecord(data, loadingButton, '#editIpdPaymentModal');
});

listenHiddenBsModal('#addIpdPaymentModal', function () {
    resetModalForm('#addIpdPaymentNewForm', '#ipdPaymentValidationErrorsBox');
    $('#ipdPaymentPreviewImage').attr('src', $('#showDefaultDocumentImageUrl').val());
    $('#ipdPaymentPreviewImage').css('background-image', 'url("' + $('#showDefaultDocumentImageUrl').val() + '")');
});

listenHiddenBsModal('#editIpdPaymentModal', function () {
    resetModalForm('#editIpdPaymentForm',
        '#editIpdPaymentValidationErrorsBox');
});

listenChange('#ipdPaymentDocumentImage', function () {
    let extension = isValidIpdPaymentDocument($(this), '#ipdPaymentValidationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#ipdPaymentValidationErrorsBox').html('').hide();
        displayDocument(this, '#ipdPaymentPreviewImage', extension);
    }
});

listenChange('#editIpdPaymentDocumentImage', function () {
    let extension = isValidIpdPaymentDocument($(this), '#editIpdPaymentValidationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editIpdPaymentValidationErrorsBox').html('').hide();
        displayDocument(this, '#editIpdPaymentPreviewImage', extension);
    }
});

function isValidIpdPaymentDocument(inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
        return false;
    }
    return ext;
};

function deleteItemPaymentAjax (url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                Livewire.emit('resetPage')
            }
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                confirmButtonColor: '#009ef7',
                text: header + ' has been deleted.',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            Swal.fire({
                title: '',
                text: data.responseJSON.message,
                confirmButtonColor: '#009ef7',
                icon: 'error',
                timer: 5000,
            })
        },
    });
}

window.editIpdPaymentRecord = function (data, loadingButton) {
    var modalSelector = arguments.length > 2 && arguments[2] !== undefined
        ? arguments[2]
        : '#EditModal';
    var formData = data.formSelector === '' ? data.formData : new FormData(
        $(data.formSelector)[0]);
    $.ajax({
        url: data.url,
        type: data.type,
        data: formData,
        processData: false,
        contentType: false,
        success: function success (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(modalSelector).modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function error(result) {
            UnprocessableInputError(result);
        },
        complete: function complete() {
            loadingButton.button('reset');
        },
    });
};

listen('click', '#ipdPaymentDocumentImage', function () {
    defaultImagePreview('#ipdPaymentPreviewImage');
});

listen('click', '.removeIpdPaymentImageEdit', function () {
    defaultImagePreview('#editIpdPaymentPreviewImage');
});
