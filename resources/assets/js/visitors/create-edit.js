document.addEventListener('turbo:load',
    loadVisitorFlatpickrData)

function loadVisitorFlatpickrData () {
    loadVisitorDate()
    loadVisitorOutTime()
}

function loadVisitorDate () {
    if (!$('#visitorDate').length) {
        return
    }

    $('#visitorDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        locale: $('.userCurrentLanguage').val(),
    })
}

function loadVisitorOutTime () {
    if (!$('#visitorOutTime').length) {
        return
    }
    $('#visitorInTime,#visitorOutTime').flatpickr({
        enableTime: true,
        enableSeconds: true,
        noCalendar: true,
        dateFormat: 'H:i:S',
        locale: $('.userCurrentLanguage').val(),
    })

    $('#visitorOutTime').flatpickr({
        enableTime: true,
        enableSeconds: true,
        noCalendar: true,
        dateFormat: 'H:i:S',
        minTime: moment(new Date()).format('HH:mm:ss'),
        locale: $('.userCurrentLanguage').val(),
    })
    $('#visitorPurpose').select2({
        width: '100%',
    })
}

listenSubmit('#createVisitorForm, #editVisitorForm', function () {
    if ($('.error-msg').text() !== '') {
        $('#visitorPhoneNumber').focus()
        return false
    }
})

listen('keyup keypress', '#createVisitorForm, #editVisitorForm', function (e) {
    let keyCode = e.keyCode || e.which
    if (keyCode === 13) {
        e.preventDefault()
        return false
    }
})

$('#visitorInTime').on('dp.change', function (e) {
    $('#visitorOutTime').data('flatpickr').minTime(e.time)
})

listenChange('#visitorAttachment', function () {
    let extension = isValidVisitorDocument($(this), '#visitorErrorsBox')
    if (!isEmpty(extension) && extension != false) {
        $('#visitorErrorsBox').html('').hide()
        displayDocument(this, '#visitorPreviewImage', extension)
        $('#visitorSave').attr('disabled', false)
    } else {
        $(this).val('')
        $('#visitorErrorsBox').removeClass('d-none hide')
        $('#visitorErrorsBox').
            text('The image must be a file of type: jpg, jpeg, png.').
            show()
        $('[id=visitorErrorsBox]').focus()
        $('html, body').animate({ scrollTop: '0' }, 500)
        $('.alert').delay(5000).slideUp(300)
    }
})

window.isValidVisitorDocument = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase()
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        return false
    }
    $(validationMessageSelector).addClass('d-none')

    return ext
}

listenClick('.visitor-remove-image', function () {
    defaultImagePreview('#visitorPreviewImage')
})

