document.addEventListener('turbo:load', loadOpdTimelineData)

function loadOpdTimelineData() {

    if (!$('#opdTimelineDate').length && !$('#editOpdTimelineDate').length) {
        return
    }
    getOpdTimelines($('#opdPatientDepartmentId').val());

    $('#opdTimelineDate, #editOPdTimelineDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        locale : $('.userCurrentLanguage').val(),
        minDate: moment($('#showOpdAppointmentDate').val()).format('YYYY-MM-DD'),
    });

}

listenSubmit('#addOpdTimelineNewForm', function (e) {
    e.preventDefault();
    let loadingButton = jQuery(this).find('#btnOpdTimelineSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': $('#showOpdTimelineCreateUrl').val(),
        'type': 'POST',
        'tableSelector': '#tbl',
    };
    newRecord(data, loadingButton, '#addOpdTimelineModal');
    loadingButton.attr('disabled', false);
    $('#addOpdTimelineNewForm')[0].reset();
    setTimeout(function () {
        getOpdTimelines($('#opdPatientDepartmentId').val());
        // $(".timeline-container").load(location.href + " .timeline-container");
    }, 500);
});

listenClick('.edit-OpdTimeline-btn', function () {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let opdTimelineId = $(this).data('timeline-id');
    renderOpdTimelineData(opdTimelineId);
});

window.renderOpdTimelineData = function (id) {
    $.ajax({
        url: $('#showOpdTimelinesUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                if (result.data.opd_timeline_document_url != '') {
                    let ext = result.data.opd_timeline_document_url.split(
                        '.').pop().toLowerCase();
                    if (ext == 'pdf') {
                        $('#editOpdPreviewTimelineImage').
                            css('background-image',
                                'url("' + $('.pdfDocumentImageUrl').val() +
                                '")')
                    } else if ((ext == 'docx') || (ext == 'doc')) {
                        $('#editOpdPreviewTimelineImage').
                            css('background-image',
                                'url("' + $('.docxDocumentImageUrl').val() +
                                '")')
                    } else {
                        $('#editOpdPreviewTimelineImage').
                            css('background-image', 'url("' +
                                result.data.opd_timeline_document_url + '")')
                    }
                    $('#editOpdTimeDocumentUrl').show()
                    $('.btn-view').show()
                } else {
                    $('#editOpdTimeDocumentUrl').hide()
                    $('.btn-view').hide()
                    $('#editOpdPreviewTimelineImage').
                        css('background-image', 'url("' +
                            $('#showOpdDefaultDocumentImageUrl').val() + '")')
                }
                $('#opdTimelineId').val(result.data.id);
                $('#editOPdTimelineTitle').val(result.data.title);
                document.querySelector('#editOPdTimelineDate')._flatpickr.setDate(moment(result.data.date).format());
                $('#editOpdTimelineDescription').val(result.data.description);
                $('#editOpdTimeDocumentUrl').attr('href', result.data.opd_timeline_document_url);
                (result.data.visible_to_person == 1)
                    ? $('#editOpdTimelineVisibleToPerson').prop('checked', true)
                    : $('#editOpdTimelineVisibleToPerson').prop('checked', false);
                $('#editOpdTimelineModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

listenSubmit('#editOpdTimelineForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnOpdTimelineEdit');
    loadingButton.button('loading');
    let id = $('#opdTimelineId').val();
    let url = $('#showOpdTimelinesUrl').val() + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'POST',
        'tableSelector': '#tbl',
    };
    editRecord(data, loadingButton, '#editOpdTimelineModal');
    setTimeout(function () {
        getOpdTimelines($('#opdPatientDepartmentId').val());
        // $(".timeline-container").load(location.href + " .timeline-container");
        // location.reload();
    }, 500);
});

listenClick('.delete-OpdTimeline-btn', function () {
    let id = $(this).data('timeline-id');
    swal({
        title: $('.deleteVariable').val(),
        text: $('.confirmVariable').val()  + $('#opdTimeline').val() + '?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonColor: '#50cd89',
        showLoaderOnConfirm: true,
        buttons: {
            confirm: 'Yes',
            cancel: 'No',
        },
    }).then(function (result) {
        if (result) {
            $.ajax({
                url: $('#showOpdTimelinesUrl').val() + '/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function (obj) {
                    if (obj.success) {
                        setTimeout(function () {
                            getOpdTimelines(
                                $('#opdPatientDepartmentId').val());
                        }, 500);
                    }
                    swal({
                        title: $('.deletedVariable').val(),
                        text: $('#opdTimeline').val() +  $('.hasBeenDeletedVariable').val(),
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

listenHiddenBsModal('#addOpdTimelineModal', function () {
    resetModalForm('#addOpdTimelineNewForm', '#timeLinevalidationErrorsBox');
    $('#opdPreviewTimelineImage').attr('src', $('.defaultDocumentImageUrl').val());
    $('#opdPreviewTimelineImage').css('background-image', 'url("' + $('.defaultDocumentImageUrl').val() + '")');
});

listenHiddenBsModal('#editOpdTimelineModal', function () {
    resetModalForm('#editOpdTimelineForm', '#editTimelineValidationErrorsBox');
});

// listenChange('#opdTimelineDocumentImage', function () {
//     let extension = isValidOpdTimelineDocument($(this), '#timeLinevalidationErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         $('#timeLinevalidationErrorsBox').html('').hide();
//         displayDocument(this, '#opdPreviewTimelineImage', extension);
//     }
// });

// listenChange('#editOpdTimelineDocumentImage', function () {
//     let extension = isValidOpdTimelineDocument($(this),
//         '#editTimelineValidationErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         $('#editTimelineValidationErrorsBox').html('').hide();
//         displayDocument(this, '#editOpdPreviewTimelineImage', extension);
//     }
// });

window.isValidOpdTimelineDocument = function (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
        return false;
    }
    return ext;
};

function getOpdTimelines(opdPatientDepartmentId) {
    $.ajax({
        url: $('#showOpdTimelinesUrl').val(),
        type: 'get',
        data: {id: opdPatientDepartmentId},
        success: function (data) {
            $('#opdPatientTimelines').html(data);
            // $(".timeline-container").load(location.href + " .timeline-container");
        },
    });
}

listenClick('.removeOpdTimelineImage', function () {
    defaultImagePreview('#opdPreviewTimelineImage');
});

listenClick('.removeOpdTimelineImageEdit', function () {
    defaultImagePreview('#editOpdPreviewTimelineImage');
});
