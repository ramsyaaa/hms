'use strict';

document.addEventListener('turbo:load', loadAppointmentCalender)

function loadAppointmentCalender(){
    
    if(!$('#calendar').length){
        return false
    }
    
    const patientIdAppointmentElement = $('#patientIdAppointment')
    const doctorIdAppointmentElement = $('#doctorIdAppointment')

    if(patientIdAppointmentElement.length){
        $('#patientIdAppointment').select2({
            width: '100%',
            dropdownParent: $('#addAppointmentModal')
        });
    }

    if(doctorIdAppointmentElement.length){
        $('#doctorIdAppointment').select2({
            width: '100%',
            dropdownParent: $('#addAppointmentModal')
        });
    }
    
    let calendarEl = document.getElementById('calendar');
    
    if($('#calendar').length) {
        screenLock();
        $.ajax({
            url: 'calendar-list',
            type: 'GET',
            dataType: 'json',
            success: function (obj) {
                screenUnLock();
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap5',
                    height: 750,
                    locale: $('.getLanguage').val(),
                    headerToolbar: {
                        left: 'title',
                        center: 'prev,next today',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',
                    },
                    buttonText: {
                        today: $('#todayText').val(),
                        month: $('#monthText').val(),
                        week: $('#weekText').val(),
                        day: $('#dayText').val(),
                    },
                    initialDate: new Date(),
                    initialView: 'dayGridMonth',
                    editable: false,
                    selectable: true,
                    selectMirror: true,
                    timeZone: 'UTC',
                    dayMaxEvents: true,
                    select: function (start) {
                        $('#opdDateAppointment').
                        val(moment(start.startStr).format('YYYY-MM-DD'))

                        let today = moment().format('YYYY-MM-DD');
                        if (start.startStr >= today) {
                            if ($('#isDoctor').val() != 1) {
                                $('#addAppointmentModal').modal('show');
                            }
                        }
                    },
                    eventDidMount: function (event, element) {
                        $(element).tooltip({
                            title: event.title,
                            container: 'body',
                        });
                    },
                    events: obj.data,
                    eventTimeFormat: {
                        hour12: true,
                        hour: '2-digit',
                        minute: '2-digit',
                    },
                    loading: function (isLoading) {
                        if (!isLoading) {
                            setTimeout(function () {
                                $('#calendar button.fc-today-button').
                                    removeClass('disabled').
                                    prop('disabled', false);
                            }, 100);
                        }
                    },
                    eventClick: function (e) {
                        showAppointmentDetails(e.event.id);
                    },
                });
                calendar.render();
            },
            error: function (obj) {
                console.log(obj.responseJSON.message)
            }
        });
    }

}

listenShownBsModal('#addAppointmentModal', function () {
    $('#patientIdAppointment:first').focus();
});

function showAppointmentDetails(appointmentId) {
    $.ajax({
        url: 'appointment-detail' + '/' + appointmentId,
        type: 'GET',
        beforeSend: function () {
            screenLock();
        },
        success: function (data) {
            $('#showPatientName').text(data.data.patient);
            $('#showDepartmentName').text(data.data.department);
            $('#showDoctorName').text(data.data.doctor);
            $('#showOpdDate').text(data.data.opdDate);
            $('#showStatus').text(data.data.status);
            $('#showIsCompleted').text(data.data.is_completed);
            $('#showProblem').text(addNewlines(data.data.problem, 30));
            $('.tooltip ').tooltip('hide');
            $('#appointmentDetailModal').modal('show');
        },
        complete: function () {
            screenUnLock();
        },
    });
};

function addNewlines(str, chr) {
    let result = '';
    if (str != null) {
        while (str.length > 0) {
            result += str.substring(0, chr) + '\n';
            str = str.substring(chr);
        }

        return result;
    } else
        return 'N/A';
};

//parseIn date_time
function parseIn(date_time) {
    let d = new Date();
    d.setHours(date_time.substring(11, 13));
    d.setMinutes(date_time.substring(14, 16));

    return d;
};

//make time slot list
function getTimeIntervals(time1, time2, duration) {
    let arr = [];
    while (time1 < time2) {
        arr.push(time1.toTimeString().substring(0, 5));
        time1.setMinutes(time1.getMinutes() + duration);
    }
    return arr;
};

//slot click change color
let calendersSelectedTime;
listenClick('.time-interval', function (event) {
    let appointmentId = $(event.currentTarget).attr('data-id');
    if ($(this).data('id') == appointmentId) {
        if ($(this).parent().hasClass('booked')) {
            $('.time-slot-book').css('background-color', '#ffa0a0');
        }
    }
    calendersSelectedTime = ($(this).text());
    $('.time-slot').removeClass('time-slot-book');
    $(this).parent().addClass('time-slot-book');
});

//create appointment
listenSubmit('#calenderAppointmentForm', function (event) {
    if (calendersSelectedTime == null || calendersSelectedTime == '') {
        $('#calenderAppointmentErrorsBox')
        .show().removeClass('d-none')
        .html('Please select appointment time slot');

        $('.alert-danger').delay(5000).slideUp(300, function () {
            $('.alert-danger').attr('style', 'display:none')
        })
        return false;
    }
    event.preventDefault();
    screenLock();
    let formData = $(this).serialize() + '&time=' + calendersSelectedTime;
    $.ajax({
        url: $('#calenderAppointmentSaveUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function (result) {
            displaySuccessMessage(result.message);
            window.location.href = $('#calenderIndexPage').val();
        },
        error: function (result) {
            printErrorMessage('#calenderAppointmentErrorsBox', result);
            screenUnLock();
        },
    });
});

let calenderDoctorId;
let calenderDoctorChange = false;
let calenderSelectedDate;
let calenderIntervals;
let calenderAlreadyCreateTimeSlot;
listenChange('#doctorIdAppointment', function () {
    if (calenderDoctorChange) {
        $('.error-message').css('display', 'none');
        calenderDoctorChange = true;
    }
    $('.error-message').css('display', 'none');
    calenderDoctorId = $(this).val();
    calenderDoctorChange = true;
    if ($('#opdDateAppointment').val() !== '') {
        $('.doctor-schedule').css('display', 'none');
        $('.error-message').css('display', 'none');
        $('.available-slot-heading').css('display', 'none');
        $('.color-information').css('display', 'none');
        $('.time-slot').remove();

        if ($('#doctorIdAppointment').val() == '') {
            $('#calenderAppointmentErrorsBox').show().html('Please select Doctor');
            $('#calenderAppointmentErrorsBox').delay(5000).fadeOut();
            $('#opdDateAppointment').val('');
            $('#opdDateAppointment').data('DateTimePicker').clear();
            return false;
        }
        let weekday = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'];
        calenderDoctorChange = $('#opdDateAppointment').val();
        let selected = new Date(calenderDoctorChange);
        let dayName = weekday[selected.getDay()];
        //if dayName is blank, then ajax call not run.
        if (dayName == null || dayName == '') {
            return false;
        }

        //get doctor schedule list with time slot.
        $.ajax({
            type: 'GET',
            url: $('#doctorScheduleList').val(),
            data: {
                day_name: dayName,
                doctor_id: calenderDoctorId,
            },
            success: function (result) {
                if (result.success) {
                    if (result.data != '') {
                        if (result.data.scheduleDay.length != 0) {
                            let doctorStartTime = calenderDoctorChange + ' ' +
                                result.data.scheduleDay[0].available_from;
                            let doctorEndTime = calenderDoctorChange + ' ' +
                                result.data.scheduleDay[0].available_to;
                            let doctorPatientTime = result.data.perPatientTime[0].per_patient_time;

                            //perPatientTime convert to Minuter
                            let a = doctorPatientTime.split(':'); // split it at the colons
                            let minutes = (+a[0]) * 60 + (+a[1]); // convert to minute

                            //parse In
                            let startTime = parseIn(doctorStartTime);
                            let endTime = parseIn(doctorEndTime);

                            //call to getTimeIntervals function
                            calenderIntervals = getTimeIntervals(startTime, endTime,
                                minutes);

                            //if intervals array length is grater then 0 then process
                            if (calenderIntervals.length > 0) {
                                $('.available-slot-heading').
                                    css('display', 'block');
                                $('.color-information').
                                    css('display', 'block');
                                let index;
                                let timeStlots = '';
                                for (index = 0; index <
                                calenderIntervals.length; ++index) {
                                    let data = [
                                        {
                                            'index': index,
                                            'timeSlot': calenderIntervals[index],
                                        }]
                                    let timeSlot = prepareTemplateRender(
                                        '#appointmentSlotTemplate', data)
                                    timeStlots += timeSlot

                                }
                                $('.available-slot').append(timeStlots);
                            }

                            // display Day Name and time
                            if ((result.data.scheduleDay[0].available_from !=
                                '00:00:00' &&
                                result.data.scheduleDay[0].available_to !=
                                '00:00:00') &&
                                (doctorStartTime != doctorEndTime)) {
                                $('.doctor-schedule').
                                    css('display', 'block');
                                $('.color-information').
                                    css('display', 'block');
                                $('.day-name').
                                    html(
                                        result.data.scheduleDay[0].available_on);
                                $('.schedule-time').
                                    html('[' +
                                        result.data.scheduleDay[0].available_from +
                                        ' - ' +
                                        result.data.scheduleDay[0].available_to +
                                        ']');
                            } else {
                                $('.doctor-schedule').
                                    css('display', 'none');
                                $('.color-information').
                                    css('display', 'none');
                                $('.error-message').css('display', 'block');
                                $('.error-message').
                                    html(
                                        'Doctor Schedule not available this date.');
                            }
                        } else {
                            $('.doctor-schedule').css('display', 'none');
                            $('.color-information').css('display', 'none');
                            $('.error-message').css('display', 'block');
                            $('.error-message').
                                html(
                                    'Doctor Schedule not available this date.');
                        }
                    }
                }
            },
        });

        if ($('.isCreate').val()) {
            let delayCall = 200;
            setTimeout(getCreateTimeSlot, delayCall);

            function getCreateTimeSlot() {
                let data = null;
                if ($('.isCreate').val()) {
                    data = {
                        editSelectedDate: calenderDoctorChange,
                        doctor_id: calenderDoctorId,
                    };
                }
                $.ajax({
                    url: $('#getBookingSlot').val(),
                    type: 'GET',
                    data: data,
                    success: function (result) {
                        calenderAlreadyCreateTimeSlot = result.data.bookingSlotArr;
                        if (result.data.hasOwnProperty('onlyTime')) {
                            if (result.data.bookingSlotArr.length > 0) {
                                editTimeSlot = result.data.onlyTime.toString();
                                $.each(result.data.bookingSlotArr,
                                    function (index, value) {
                                        $.each(calenderIntervals, function (i, v) {
                                            if (value == v) {
                                                $('.time-interval').
                                                    each(function () {
                                                        if ($(this).
                                                                data('id') ==
                                                            i) {
                                                            if ($(this).
                                                                    html() !=
                                                                editTimeSlot) {
                                                                $(this).
                                                                    parent().
                                                                    css(
                                                                        {
                                                                            'background-color': '#ffa721',
                                                                            'border': '1px solid #ffa721',
                                                                            'color': '#ffffff',
                                                                        });
                                                                $(this).
                                                                    parent().
                                                                    addClass(
                                                                        'booked');
                                                                $(this).
                                                                    parent().
                                                                    children().
                                                                    prop(
                                                                        'disabled',
                                                                        true);
                                                            }
                                                        }
                                                    });
                                            }
                                        });
                                    });
                            }
                            $('.time-interval').each(function () {
                                if ($(this).html() == editTimeSlot &&
                                    result.data.bookingSlotArr.length > 0) {
                                    $(this).
                                        parent().
                                        addClass('time-slot-book');
                                    $(this).parent().removeClass('booked');
                                    $(this).
                                        parent().
                                        children().
                                        prop('disabled', false);
                                    $(this).click();
                                }
                            });
                        } else if (calenderAlreadyCreateTimeSlot.length > 0) {
                            $.each(calenderAlreadyCreateTimeSlot,
                                function (index, value) {
                                    $.each(calenderIntervals, function (i, v) {
                                        if (value == v) {
                                            $('.time-interval').
                                                each(function () {
                                                    if ($(this).
                                                            data('id') ==
                                                        i) {
                                                        $(this).
                                                            parent().
                                                            addClass(
                                                                'time-slot-book');
                                                        $('.time-slot-book').
                                                            css(
                                                                {
                                                                    'background-color': '#ffa721',
                                                                    'border': '1px solid #ffa721',
                                                                    'color': '#ffffff',
                                                                });
                                                        $(this).
                                                            parent().
                                                            addClass(
                                                                'booked');
                                                        $(this).
                                                            parent().
                                                            children().
                                                            prop('disabled',
                                                                true);
                                                    }
                                                });
                                        }
                                    });
                                });
                        }
                    },
                });
            }
        }
    }
});

// reset the modal data after cancel/close
listenHiddenBsModal('#addAppointmentModal', function () {
    resetModalForm('#calenderAppointmentForm', '#calenderAppointmentErrorsBox');
    $('.day-name').html('');
    $('.schedule-time').html('');
    $('.doctor-schedule').css('display', 'none');
    $('.error-message').css('display', 'none');
    $('.available-slot-heading').css('display', 'none');
    $('.available-slot').html('');
    $('.color-information').css('display', 'none');
    calendersSelectedTime = null;
    $('#patientIdAppointment, #doctorIdAppointment').
        val('').
        trigger('change.select2');
});

