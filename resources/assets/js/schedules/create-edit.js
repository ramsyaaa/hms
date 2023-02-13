document.addEventListener('turbo:load', loadSchedules)

function loadSchedules() {
    if (!$('.scheduleForm').length) {
        return
    }
    $('#doctorId, #serialVisibilityId').select2({
        width: '100%',
    });

    $('.perPatientTime').flatpickr({
        enableTime: true,
        noCalendar: true,
        enableSeconds: true,
        dateFormat: 'H:i:S',
        time_24hr: true,
        locale : $('.userCurrentLanguage').val(),
    });

    // $('#doctorId').first().focus();

    let hospitalDayOfWeek = [];
    let hospitalStartTime = [];
    $.each(JSON.parse($('.hospitalSchedule').val()), function (i, v) {
        hospitalDayOfWeek[i] = parseInt(v.day_of_week);
        hospitalStartTime[v.day_of_week] = [v.start_time, v.end_time];
    });

    let i = 0;
    let perPatTime = $('.perPatientTime').val();
    for (i; i <= 7; i++) {
        if ($.inArray(i, hospitalDayOfWeek) !== -1) {
            hospitalDayOfWeek.sort();
            $('.cpy-btn' + (hospitalDayOfWeek[0] - 1)).hide();
            $('.hospitalScheduleFrom-' + i).flatpickr({
                enableTime: true,
                noCalendar: true,
                enableSeconds: true,
                dateFormat: 'H:i:S',
                time_24hr: true,
                minTime: hospitalStartTime[i][0],
            });

            hospitalToSchedule = $('.hospitalScheduleTo-' + i).flatpickr({
                enableTime: true,
                noCalendar: true,
                enableSeconds: true,
                dateFormat: 'H:i:S',
                time_24hr: true,
                minTime: hospitalStartTime[i][0].split(':')[0] + ':' +
                    parseInt(hospitalStartTime[i][0].split(':')[1]) + 5,
                maxTime: hospitalStartTime[i][1],
            });
        } else {
            $('.hospitalScheduleFrom-' + i).parent().parent().hide();
        }
    }


    function checkedEle(element) {
        if (element.prev().length > 0) {
            if (element.prev().css('display') == 'none') {
                return checkedEle(element.prev());
            } else {
                return element.prev();
            }
        }
    }

    listenClick('.copy-btn', function (e) {
        e.preventDefault();
        let Ele = checkedEle($(this).parent().parent());
        let id = $(e.currentTarget).attr('data-id');
        let oldId = id - 1;
        let availableFrom = $('#availableFrom-'.concat(oldId)).val();
        let availableTo = $('#availableTo-'.concat(oldId)).val();
        availableFrom = Ele.find('td .availableFrom').val();
        availableTo = Ele.find('td .availableTo').val();
        let availableTimeFrom = '';
        let availableTimeTo = '';
        // if (hospitalStartTime[id + 1][0] > availableFrom) {
        //     displayErrorMessage('Hospital Schedule doesn\'t match with Selected Time');
        //     availableTimeFrom = hospitalStartTime[id + 1][0];
        // $('#availableFrom-'.concat(id)).val(hospitalStartTime[id + 1][0] + ':00');
        // } else {
        availableTimeFrom = availableFrom;
        $('#availableFrom-'.concat(id)).val(availableFrom);
        // }
        // if (hospitalStartTime[id + 1][1] > availableTo) {
        //     // availableTimeTo = hospitalStartTime[id + 1][1];
        //     // $('#availableTo-'.concat(id)).
        //     //     val(hospitalStartTime[id + 1][1] + ':00');
        //     availableTimeTo = availableTo;
        //     $('#availableTo-'.concat(id)).val(availableTo);
        // } else {
        availableTimeTo = availableTo;
        $('#availableTo-'.concat(id)).val(availableTo);
        // }
        let newId = id + 1;
        $('.hospitalScheduleFrom-' + newId).flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: 'H:i:S',
            time_24hr: true,
            minTime: availableTimeFrom,
        });
        $('.hospitalScheduleTo-' + newId).flatpickr({
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: 'H:i:S',
            time_24hr: true,
            maxTime: availableTimeTo,
        });
    });
    listenSubmit('.scheduleForm', function (e) {
        e.preventDefault();
        let perPatientTime = $('.perPatientTime').val();

        if (perPatientTime == '00:00:00') {
            $('#scheduleErrorsBox').html('Please select per patient time').show();
            $('.perPatientTime').focus()
            return false;
        }

        let j = 0;
        let availableFrom = true;
        for (j; j <= 6; j++) {
            if ($('#availableFrom-' + j).val() != '00:00:00') {
                availableFrom = false;
                if (hospitalStartTime[j + 1] !== 'undefined' && $('#availableFrom-' + j).val() < hospitalStartTime[j + 1][0]) {
                    $('#availableFrom-' + j).focus()
                    $('#scheduleErrorsBox').show().html('Available From time must be greater than hospital schedule time').show();
                    $('#scheduleErrorsBox').delay(5000).fadeOut();
                    return false
                }
            }
        }
        if (availableFrom) {
            $('#scheduleErrorsBox').show().html('Available From time must be greater than Zero');
            $('#scheduleErrorsBox').delay(5000).fadeOut();
            return false;
        }

        let i = 0;
        let availableTo = true;
        for (i; i <= 6; i++) {
            if ($('#availableTo-' + i).val() != '00:00:00') {
                availableTo = false;
                if (hospitalStartTime[i + 1] !== 'undefined' && $('#availableTo-' + i).val() > hospitalStartTime[i + 1][1] + ':00') {
                    $('#availableTo-' + i).focus()
                    $('#scheduleErrorsBox').show().html('Available To time must be less than hospital schedule time').show();
                    $('#scheduleErrorsBox').delay(5000).fadeOut();
                    return false
                }
            }
        }
        if (availableTo) {
            $('#scheduleErrorsBox').show().html('Available To time must be greater than Zero');
            $('#scheduleErrorsBox').delay(5000).fadeOut();
            return false;
        }

        $(this)[0].submit()
    });
}
