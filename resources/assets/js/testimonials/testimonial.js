document.addEventListener('turbo:load',
    loadTestimonialData)

function loadTestimonialData() {

    if (!$('#indexTestimonialUrl').length) {
        return
    }
    $('.testimonialDescription').attr('maxlength', 150);

}

function renderTestimonialData(id) {
    $.ajax({
        url: $('#indexTestimonialUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.document_url.split('.').pop().toLowerCase();
                if (ext == '') {
                    $('#editTestimonialPreviewImage').css('background-image',
                        'url("' + result.data.document_url + '")');
                } else {
                    $('#editTestimonialPreviewImage').css('background-image',
                        'url("' + result.data.document_url + '")');
                }
                $('#testimonialId').val(result.data.id);
                $('#editTestimonialName').val(result.data.name);
                $('#editTestimonialDescription').val(result.data.description);
                if (isEmpty(result.data.document_url)) {
                    $('#testimonialDocumentUrl').hide();
                    $('.btn-view').hide();
                } else {
                    $('#testimonialDocumentUrl').show();
                    $('.btn-view').show();
                    $('#testimonialDocumentUrl').attr('href', result.data.document_url);
                }
                $('#edit_testimonials').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

function isValidTestimonialDocument(
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) ==
        -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html($('#indexTestimonialProfileError').val()).removeClass('d-none');
        return false;
    }
    $(validationMessageSelector).html($('#indexTestimonialProfileError').val()).addClass('d-none');
    return ext;
}

listenSubmit('#addTestimonialForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#testimonialSave');
    loadingButton.button('loading');
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#indexTestimonialCreateUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function success(result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_testimonials').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function error(result) {
            printErrorMessage('#testimonialErrorsBox', result);
        },
        complete: function complete() {
            loadingButton.button('reset');
        },
    });

});

listen('click', '.edit-testimonial-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let testimonialId = $(event.currentTarget).attr('data-id')
    renderTestimonialData(testimonialId);
});

listenKeyup('.testimonialDescription', function () {
    $('.description').attr('maxlength', 150);
});

listenSubmit('#editTestimonialForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editTestimonialSave');
    loadingButton.button('loading');
    let id = $('#testimonialId').val();
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: $('#indexTestimonialUrl').val() + '/' + id,
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_testimonials').modal('hide');
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listenHiddenBsModal('#add_testimonials', function () {
    resetModalForm('#addTestimonialForm', '#add_testimonials #testimonialErrorsBox');
    $('#testimonialPreviewImage').attr('src', $('#indexTestimonialDefaultDocumentImageUrl').val()).css('background-image', `url(${$('#indexTestimonialDefaultDocumentImageUrl').val()})`);
});

listenShownBsModal('#add_testimonials', function () {
    $('#add_testimonials #testimonialErrorsBox').show();
    $('#add_testimonials #testimonialErrorsBox').addClass('d-none');
});

listenHiddenBsModal('#edit_testimonials', function () {
    resetModalForm('#editTestimonialForm', '#edit_testimonials #editTestimonialErrorsBox');
    $('.editTestimonialPreviewImage').attr('src', $('#indexTestimonialDefaultDocumentImageUrl').val()).css('background-image', `url(${$('#indexTestimonialDefaultDocumentImageUrl').val()})`);
});

listenShownBsModal('#edit_testimonials', function () {
    $('#edit_testimonials #editTestimonialErrorsBox').show();
    $('#edit_testimonials #editTestimonialErrorsBox').addClass('d-none');
});

listen('click', '.delete-testimonial-btn', function (event) {
    let testimonialId = $(event.currentTarget).attr('data-id');
    deleteItem($('#indexTestimonialUrl').val() + '/' + testimonialId, '', $('#Testimonial').val());
});

// listenChange('#testimonialProfile', function () {
//     let extension = isValidTestimonialDocument($(this), '#add_testimonials #testimonialErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         displayDocument(this, '#testimonialPreviewImage', extension);
//     }
// });

// listenChange('#editTestimonialProfile', function () {
//     let extension = isValidTestimonialDocument($(this),
//         '#edit_testimonials #editTestimonialErrorsBox');
//     if (!isEmpty(extension) && extension != false) {
//         displayDocument(this, '#editTestimonialPreviewImage', extension);
//     }
// });

listen('click', '.view-testimonial-btn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let testimonialId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: $('#indexTestimonialUrl').val() + '/' + testimonialId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showTestimonialName').html('');
                $('#showTestimonialDescription').html('');
                $('#showTestimonialName').append(result.data.name);
                $('#showTestimonialDescription').append(result.data.description);
                $('#userProfilePicture').attr('src', result.data.document_url);
                $('#show_testimonials').appendTo('body').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});

