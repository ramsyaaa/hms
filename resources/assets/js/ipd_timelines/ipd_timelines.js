document.addEventListener('turbo:load', loadIpdTimelineData)

function loadIpdTimelineData() {
    if (!$('#editIpdTimelineForm').length && !$('#addIpdTimelineNewForm').length) {
        return
    }
    getIpdTimelines($('#ipdPatientDepartmentId').val());
    $('#ipdTimelineDate, #editIpdTimelineDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        minDate: $('#showIpdPatientCaseDate').val(),
        locale : $('.userCurrentLanguage').val(),
    });

}

    listenSubmit('#addIpdTimelineNewForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#btnIpdTimelineSave');
        loadingButton.button('loading');
        let data = {
            'formSelector': $(this),
            'url': $('#showIpdTimelineCreateUrl').val(),
            'type': 'POST',
            'tableSelector': '#tbl',
        };
        newRecord(data, loadingButton, '#addIpdTimelineModal');
        loadingButton.attr('disabled', false);
        setTimeout(function () {
            getIpdTimelines($('#ipdPatientDepartmentId').val());
        }, 500);
    });

    listenClick('.edit-timeline-btn', function () {
        if ($('.ajaxCallIsRunning').val()) {
            return;
        }
        ajaxCallInProgress();
        let ipdTimelineId = $(this).data('timeline-id');
        renderIpdTimelineData(ipdTimelineId);
    });

function renderIpdTimelineData(id) {
    $.ajax({
        url: $('#showIpdTimelinesUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                if (result.data.ipd_timeline_document_url != '') {
                    let ext = result.data.ipd_timeline_document_url.split(
                        '.').pop().toLowerCase();
                    if (ext == 'pdf') {
                        $('#editPreviewIpdTimelineImage').css('background-image', 'url("' + $('.pdfDocumentImageUrl').val() + '")');
                        } else if ((ext == 'docx') || (ext == 'doc')) {
                            $('#editPreviewIpdTimelineImage').css('background-image', 'url("' + $('.docxDocumentImageUrl').val() + '")');
                        } else {
                            $('#editPreviewIpdTimelineImage').css('background-image', 'url("' + result.data.ipd_timeline_document_url + '")');
                        }
                        $('#ipdTimeDocumentUrl').show();
                        $('.btn-view').show();

                    } else {
                        $('#ipdTimeDocumentUrl').hide();
                        $('.btn-view').hide();
                        $('#editPreviewIpdTimelineImage').css('background-image', 'url("' + $('#showDefaultDocumentImageUrl').val() + '")');
                    }
                    $('#ipdTimelineId').val(result.data.id);
                    $('#editIpdTimelineTitle').val(result.data.title);
                    document.querySelector('#editIpdTimelineDate')._flatpickr.setDate(moment(result.data.date).format());
                $('#editIpdTimelineDescription').val(result.data.description);
                $('#ipdTimeDocumentUrl').attr('href', result.data.ipd_timeline_document_url);
                    (result.data.visible_to_person == 1)
                        ? $('#editIpdTimelineVisibleToPerson').prop('checked', true)
                        : $('#editIpdTimelineVisibleToPerson').prop('checked', false);
                    $('#editIpdTimelineModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    listenSubmit('#editIpdTimelineForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnIpdTimelineEdit');
        loadingButton.button('loading');
        let id = $('#ipdTimelineId').val();
        let url = $('#showIpdTimelinesUrl').val() + '/' + id;
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
            'tableSelector': '#tbl',
        };
        editRecord(data, loadingButton, '#editIpdTimelineModal');
        // location.reload();
        setTimeout(function () {
            getIpdTimelines($('#ipdPatientDepartmentId').val());
        }, 500);
    });

    listenClick('.delete-timeline-btn', function () {
        let id = $(this).data('timeline-id');
        swal({
            title: $('.deleteVariable').val(),
            text: $('.confirmVariable').val()  + $('#ipdTimeline').val() + '?',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: '#50cd89',
            showLoaderOnConfirm: true,
            buttons: {
                confirm: $('.yesVariable').val()  +  $('.deleteVariable').val(),
                cancel: $('.noVariable').val()  +  $('.cancelVariable').val(),
            },
        }).then(function (result) {
            if (result) {
                $.ajax({
                    url: $('#showIpdTimelinesUrl').val() + '/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (obj) {
                        if (obj.success) {
                            setTimeout(function () {
                                getIpdTimelines(
                                    $('#ipdPatientDepartmentId').val());
                            }, 500);
                        }
                        swal({
                            title: $('.deletedVariable').val(),
                            text: $('#ipdTimeline').val() +  $('.hasBeenDeletedVariable').val(),
                            icon: 'success',
                            confirmButtonColor: '#50cd89',
                            timer: 2000,
                        })
                        livewire.emit('refresh')
                    },
                })
            }
        })
    });

    listenHiddenBsModal('#addIpdTimelineModal', function () {
        resetModalForm('#addIpdTimelineNewForm', '#ipdTimelineErrorsBox');
        $('#previewIpdTimelineImage').attr('src', $('#showDefaultDocumentImageUrl').val());
        $('#previewIpdTimelineImage').css('background-image', 'url("' + $('#showDefaultDocumentImageUrl').val() + '")');
    });

    listenHiddenBsModal('#editIpdTimelineModal', function () {
        resetModalForm('#editIpdTimelineForm', '#editIpdTimelineErrorsBox');
    });


// listenChange('#ipdTimelineDocumentImage', function () {
//     let extension = isValidTimelineIpdDocument($(this), '#ipdTimelineErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         $('#ipdTimelineErrorsBox').html('').hide();
//         displayDocument(this, '#previewIpdTimelineImage', extension);
//     }
// });

// listenChange('#editIpdTimelineDocumentImage', function () {
//     let extension = isValidTimelineIpdDocument($(this),
//         '#editIpdTimelineErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         $('#editIpdTimelineErrorsBox').html('').hide();
//         displayDocument(this, '#editPreviewIpdTimelineImage', extension);
//     }
// });

// function isValidTimelineIpdDocument(
//     inputSelector, validationMessageSelector) {
//     let ext = $(inputSelector).val().split('.').pop().toLowerCase();
//     if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
//         $(inputSelector).val('');
//         $(validationMessageSelector).html(
//             'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
//         return false;
//     }
//     return ext;
// }

function getIpdTimelines(ipdPatientDepartmentId) {
    $.ajax({
        url: $('#showIpdTimelinesUrl').val(),
        type: 'get',
        data: {id: ipdPatientDepartmentId},
        success: function (data) {
            $('#ipdTimelines').html(data);
        },
    });
}

listenClick('.removeIpdTimeline', function () {
    defaultImagePreview('#previewIpdTimelineImage');
});
listenClick('.removeIpdTimelineEdit', function () {
    defaultImagePreview('#editPreviewIpdTimelineImage');
});
