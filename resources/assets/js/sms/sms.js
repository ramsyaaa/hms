document.addEventListener('turbo:load', loadSmsAddFunction)

    function loadSmsAddFunction(){
        if (!$('#smsUrl').length) {
            return
        }


        $('#smsMessageId').keypress(function (e) {
            var tval = $('#smsMessageId').val(),
                tlength = tval.length,
                set = 160,
                remain = parseInt(set - tlength);
            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
                $('#smsMessageId').val((tval).substring(0, tlength - 1));
                displayErrorMessage('The message may not be greater than 160 characters.');
            }
        });


        $('.mySmsClass').hide();
        $('#smsPhoneNumber').prop('required', false);


    }

function hide() {
    $('.mySmsClass').hide();
    $('.role').show();
    $('.send').show();
}

function renderSmsData(id) {
    $.ajax({
        url: $('#SMSShowModal').val() + '/' + id,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showSmsSend_to').text(result.data.user ? result.data.user.full_name : 'N/A');
                $('#showSmsUser_role').text(result.data.user ? result.data.user.roles[0].name : 'N/A');
                $('#showSms_phone').text(result.data.phone_number);
                $('#showSmsSend_by').text(result.data.send_by ? result.data.send_by.full_name : 'N/A');
                $('#showSms_message').text(result.data.message);
                moment.locale($('#smsLanguage').val());
                $('#showSms_date').text(moment(result.data.created_at).fromNow());
                $('#showSmsUpdated_on').text(moment(result.data.updated_at).fromNow());

                setValueOfEmptySpan();
                $('#showSms').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}

listenClick('.smsNumber', function () {
    if ($('.smsNumber').is(':checked')) {
        $('.mySmsClass').show();
        $('.smsNumber').attr('value', 1);
        $('.role').hide();
        $('#smsRoleId').prop('required', false);
        $('.send').hide();
        $('#smsUserId').prop('required', false);
        $('#smsPhoneNumber').attr('required')
        $('#smsPhoneNumber').prop('required', true);
    } else {
        $('#smsPhoneNumber').prop('required', false);
        hide();
    }
});

listenHiddenBsModal('#AddSmsModal', function () {
    resetModalForm('#addSmsForm', '#smsValidationErrorsBox');
    $('#smsUserId').val('').trigger('change.select2');
    $('#smsRoleId').val('').trigger('change.select2');
    $('.valid-msg').addClass('hide');
    hide();
});

listenShownBsModal('#AddSmsModal', function () {
    $('#smsUserId,#smsRoleId').select2({
        width: '100%',
        dropdownParent: $('#AddSmsModal')
    })
});

listenChange('#smsRoleId', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: $('#getUsersListUrl').val(),
            type: 'get',
            dataType: 'json',
            data: {id: $(this).val()},
            success: function (data) {
                $('#smsUserId').empty();
                $('#smsUserId').removeAttr('disabled');
                $.each(data.data, function (i, v) {
                    $('#smsUserId').append($('<option></option>').attr('value', i).text(v));
                });
            },
        });
    }
    $('#smsUserId').empty();
    $('#smsUserId').prop('disabled', true);
});


listen('click', '.show-sms-btn', function (event) {
    event.preventDefault()
    let smsId = $(event.currentTarget).attr('data-id');
    renderSmsData(smsId);
});


listen('submit', '#addSmsForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#smsBtnSave');
    loadingButton.button('loading');
    if ($('#smsNumber').is(':checked')) {
        $('#smsRoleId').remove();
        $('#smsUserId').remove();
    }
    $.ajax({
        url: $('#createSmsUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#AddSmsModal').modal('hide');
                livewire.emit('refresh');

            }
        },
        error: function (result) {
            displayErrorMessage('Please set your credential');
            $('#AddSmsModal').modal('hide');
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listen('click', '.delete-sms-btn', function (event) {
    let id = $(event.currentTarget).attr('data-id');
    deleteItem($('#smsUrl').val() + '/' + id, '', $('#SMS').val());
});
