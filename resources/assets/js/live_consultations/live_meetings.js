

document.addEventListener('turbo:load', loadMeetingData)

function loadMeetingData() {

    if (!$('#indexLiveMeetingUrl').length) {
        return
    }

    $('.change-meeting-status').select2({
        width: '100%',
    });

    $('#meetingUserId, #statusArr').select2({
        width: '100%',
    });
    
    $('.editUserId').select2({
        width: '100%',
    });

    $('.consultation-date, .edit-consultation-date').flatpickr({
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
        locale : $('.userCurrentLanguage').val(),
    });
}
listenSubmit('#addLiveMeetingForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#meetingSave');
    // loadingButton.button('loading');
    $('#meetingSave').attr('disabled', true);
    $.ajax({
        url: $('#indexLiveMeetingCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#add_live_meeting_modal').modal('hide');
                loadingButton.attr('disabled', false);
                livewire.emit('refresh')
                $('.change-meeting-status').select2({
                    width: '100%',
                });
                setTimeout(function () {
                    loadingButton.attr('disabled', false);
                }, 3000);
            }
        },
        error: function (result) {
            printErrorMessage('#meetingErrorsBox', result);
            setTimeout(function () {
                loadingButton.attr('disabled', false);
            }, 2000);
        },
    });
});
listenHiddenBsModal('#add_live_meeting_modal', function () {
    resetModalForm('#addLiveMeetingForm', '#meetingErrorsBox');
    $('#meetingUserId').val($('.loggedInUserId').val()).trigger('change.select2');
});

listenChange('.change-meeting-status', function () {
    let statusId = $(this).val();
    $.ajax({
        url: $('#indexLiveMeetingUrl').val() + '/change-status',
        type: 'GET',
        data: {statusId: statusId, id: $(this).attr('data-id')},
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});

listen('click', '.startMeetingBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let liveConsultationId = $(event.currentTarget).attr('data-id');
    renderStartMeetingData(liveConsultationId);
});

function renderStartMeetingData(id) {
    $.ajax({
        url: $('#indexLiveMeetingUrl').val() + '/' + id + '/start',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data;
                $('#startLiveConsultationId').val(liveConsultation.liveMeeting.id);
                $('.start-modal-title').text(liveConsultation.liveMeeting.consultation_title);
                $('.host-name').text(liveConsultation.liveMeeting.user.full_name);
                // $('.date').text(liveConsultation.liveMeeting.consultation_date);
                $('.date').text(moment(liveConsultation.liveMeeting.consultation_date).format('Do MMM, Y') + ' ' + moment(liveConsultation.liveMeeting.consultation_date).format('LT'));
                $('.minutes').text(
                    liveConsultation.liveMeeting.consultation_duration_minutes);
                $('#startConsultationModal').find('.status').append((liveConsultation.zoomLiveData.data.status ===
                    'started') ? $('.status').text('Started') : $(
                    '.status').text('Awaited'));
                !($('#indexMeetingAdminRole').val() || $('#indexMeetingDoctorRole').val())
                    ? $('.start').attr('href', liveConsultation.liveMeeting.meta.join_url)
                    : ((liveConsultation.zoomLiveData.data.status ===
                    'started') ? $('.start').addClass('disabled') : $('.start').attr('href', liveConsultation.liveMeeting.meta.start_url));
                $('#startConsultationModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listen('click', '.showMeetingData', function (event) {
    let meetingId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: $('#indexLiveMeetingUrl').val() + '/' + meetingId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveMeeting = result.data;
                $('#showMeetingId').val(liveMeeting.id);
                $('#showMeetingTitle').text(liveMeeting.consultation_title);
                $('#showMeetingDate').text(moment(liveMeeting.consultation_date).format('Do MMM, Y') + ' ' + moment(liveMeeting.consultation_date).format('LT'));
                $('#showMeetingMinutes').text(liveMeeting.consultation_duration_minutes);

                (liveMeeting.host_video == 0) ? $('#showMeetingHost').text('Disable') : $('#showMeetingHost').text('Enable');
                (liveMeeting.participant_video == 0) ? $('#showMeetingParticipant').text('Disable') : $('#showMeetingParticipant').text('Enable');
                isEmpty(liveMeeting.description) ? $('#showMeetingDescription').text('N/A') : $('#showMeetingDescription').text(liveMeeting.description);
                $('#show_live_meetings_modal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});

listen('click', '.editMeetingBtn', function (event) {
    if ($('.ajaxCallIsRunning').val()) {
        return;
    }
    ajaxCallInProgress();
    let liveMeetingId = $(event.currentTarget).attr('data-id');
    renderMeetingData(liveMeetingId);
});

function renderMeetingData(id) {
    $.ajax({
        url: $('#indexLiveMeetingUrl').val() + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveMeeting = result.data;
                $('#liveMeetingId').val(liveMeeting.id);
                $('.edit-consultation-title').val(liveMeeting.consultation_title);
                $('.edit-consultation-date').val(moment(liveMeeting.consultation_date).format('YYYY-MM-DD h:mm A'));
                $('.edit-consultation-duration-minutes').val(liveMeeting.consultation_duration_minutes);
                $('.editUserId').val(liveMeeting.meetingUsers).trigger('change.select2');
                $('.host-enable,.host-disabled').prop('checked', false);
                if (liveMeeting.host_video == 1) {
                    $(`input[name="host_video"][value=${liveMeeting.host_video}]`).prop('checked', true);
                } else {
                    $(`input[name="host_video"][value=${liveMeeting.host_video}]`).
                        prop('checked', true);
                }
                $('.client-enable,.client-disabled').prop('checked', false);
                if (liveMeeting.participant_video == 1) {
                    $(`input[name="participant_video"][value=${liveMeeting.participant_video}]`).
                        prop('checked', true);
                } else {
                    $(`input[name="participant_video"][value=${liveMeeting.participant_video}]`).
                        prop('checked', true);
                }
                $('.edit-description').val(liveMeeting.description);
                $('#edit_live_meeting_modal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
}

listenSubmit('#editMeetingForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editMeetingSave');
    loadingButton.button('loading');
    loadingButton.attr('disabled', true);
    let id = $('#liveMeetingId').val();
    $.ajax({
        url: $('#indexLiveMeetingUrl').val() + '/' + id,
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#edit_live_meeting_modal').modal('hide');
                loadingButton.attr('disabled', false);
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            loadingButton.attr('disabled', false);
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

listen('click', '.deleteMeetingBtn', function (event) {
    let liveMeetingId = $(event.currentTarget).attr('data-id');
    deleteItem(
        $('#indexLiveMeetingUrl').val() + '/' + liveMeetingId,
        '',
        $('#LiveMeeting').val(),
    );
});

listenHiddenBsModal('#show_live_meetings_modal', function () {
    $(this).find(
        '#showMeetingTitle,#showMeetingDate, #showMeetingMinutes, #showMeetingHost, #showMeetingParticipant, #showMeetingDescription').empty();
});

listenChange('#liveMeetingFilterArrID', function () {
    window.livewire.emit('changeFilter', 'statusFilter', $(this).val())
});

listenClick('#liveMeetingResetFilter', function () {
    $('#liveMeetingFilterArrID').val(0).trigger('change');
    hideDropdownManually($('#liveMeetingFilterBtn'), $('.dropdown-menu'));
});

