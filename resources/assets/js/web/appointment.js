'use strict'

document.addEventListener('turbo:load', loadWebAppointmentDate)

function loadWebAppointmentDate () {
    if (!$('#webAppointmentFormSubmit').length) {
        return
    }

    if (!$('#opdDate').length) {
        return
    }

    $('#advancePaymentPatientId').selectize()
    $('#webDepartmentId').selectize()
    $('#appointmentDoctorId').selectize()
    var doctor = $('#doctor').val()
    Lang.setLocale($('.userCurrentLanguage').val())

    let opdDate = $('#opdDate').datepicker(
        {
            useCurrent: false,
            sideBySide: true,
            isRTL: false,
            minDate: new Date(),
            dateFormat: 'dd/mm/yy',
            onSelect: function (selectedDate, dateStr) {
                let selectDate = selectedDate
                dateSelectSlot = selectedDate
                $('.doctor-schedule').css('display', 'none')
                $('.error-message').css('display', 'none')
                $('.available-slot-heading').css('display', 'none')
                $('.color-information').css('display', 'none')
                $('.time-slot').remove()
                if ($('#webDepartmentId').val() == '') {
                    $('#validationErrorsBox').
                        show().
                        html(Lang.get(
                            'messages.appointment.please_select_doctor_department'))
                    $('#validationErrorsBox').delay(5000).fadeOut()
                    $('#opdDate').val('')
                    // opdDate.clear();
                    return false
                } else if ($('#appointmentDoctorId').val() == '') {
                    $('#validationErrorsBox').
                        show().
                        html(Lang.get(
                            'messages.appointment.please_select_doctor'))
                    $('#validationErrorsBox').delay(5000).fadeOut()
                    $('#opdDate').val('')
                    // opdDate.clear();
                    return false
                }
                var weekday = [
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday']
                var selected = new Date(selectedDate)
                var selectedAppDate = $(this).datepicker('getDate')
                let dayName = weekday[selectedAppDate.getDay()]
                selectedDate = dateStr

                //if dayName is blank, then ajax call not run.
                if (dayName == null || dayName == '') {
                    return false
                }

                //get doctor schedule list with time slot.
                $.ajax({
                    type: 'GET',
                    url: $('#homeDoctorScheduleList').val(),
                    data: {
                        day_name: dayName,
                        doctor_id: doctorId,
                    },
                    success: function (result) {
                        if (result.success) {
                            if (result.data != '') {
                                if (result.data.scheduleDay.length != 0) {
                                    let availableFrom = ''
                                    console.log(moment(new Date()).
                                        format('MM/DD/YYYY') === dateStr)
                                    if (moment(new Date()).
                                        format('MM/DD/YYYY') === selectDate) {
                                        // availableFrom = moment.duration(
                                        //     result.data.perPatientTime[0].per_patient_time).
                                        //     asMinutes()
                                        // availableFrom = moment(
                                        //     availableFrom.toString()).
                                        //     format('H:mm:ss')
                                        availableFrom = moment().ceil(moment.duration( result.data.perPatientTime[0].per_patient_time).asMinutes(), 'minute');
                                        // availableFrom = moment.duration( result.data.perPatientTime[0].per_patient_time).asMinutes();
                                        availableFrom = moment(availableFrom.toString()).format('H:mm:ss');
                                        console.log(availableFrom)
                                        // availableFrom = moment(new Date()).
                                        //     add(result.data.perPatientTime[0].per_patient_time,
                                        //         'minutes').
                                        //     format('H:mm:ss')
                                    } else {
                                        availableFrom = result.data.scheduleDay[0].available_from
                                    }
                                    var doctorStartTime = selectedDate + ' ' +
                                        availableFrom
                                    var doctorEndTime = selectedDate + ' ' +
                                        result.data.scheduleDay[0].available_to
                                    var doctorPatientTime = result.data.perPatientTime[0].per_patient_time
                                    // console.log(moment(new Date()).format('LTS'))
                                    // console.log(result.data.scheduleDay[0].available_to)
                                    // console.log(moment(new Date()).format('LTS') > result.data.scheduleDay[0].available_to)
                                    //perPatientTime convert to Minute
                                    var a = doctorPatientTime.split(':') // split it at the colons
                                    var minutes = (+a[0]) * 60 + (+a[1]) // convert to minute

                                    //parse In
                                    var startTime = parseIn(doctorStartTime)
                                    var endTime = parseIn(doctorEndTime)
                                    //call to getTimeIntervals function
                                    intervals = getTimeIntervals(startTime,
                                        endTime,
                                        minutes)

                                    //if intervals array length is grater then 0 then process
                                    if (intervals.length > 0) {
                                        $('.available-slot-heading').
                                            css('display', 'block')
                                        $('.color-information').
                                            css('display', 'block')
                                        var index
                                        let timeStlots = ''
                                        for (index = 0; index <
                                        intervals.length; ++index) {
                                            let data = [
                                                {
                                                    'index': index,
                                                    'timeSlot': intervals[index],
                                                }]
                                            var timeSlot = prepareTemplateRender(
                                                '#appointmentSlotTemplate',
                                                data)
                                            timeStlots += timeSlot
                                        }
                                        $('.available-slot').append(timeStlots)
                                    }
                                    // display Day Name and time
                                    if ((availableFrom !=
                                        '00:00:00' &&
                                        result.data.scheduleDay[0].available_to !=
                                        '00:00:00') &&
                                        (doctorStartTime != doctorEndTime)) {
                                        $('.doctor-schedule').
                                            css('display', 'block')
                                        $('.color-information').
                                            css('display', 'block')
                                        $('.day-name').html(
                                            result.data.scheduleDay[0].available_on)
                                        $('.schedule-time').html('[' +
                                            availableFrom +
                                            ' - ' +
                                            result.data.scheduleDay[0].available_to +
                                            ']')
                                    } else {
                                        $('.doctor-schedule').
                                            css('display', 'none')
                                        $('.color-information').
                                            css('display', 'none')
                                        $('.error-message').
                                            css('display', 'block')
                                        $('.error-message').html(
                                            Lang.get(
                                                'messages.appointment.doctor_schedule_not_available_on_this_date'))
                                    }
                                } else {
                                    $('.doctor-schedule').css('display', 'none')
                                    $('.color-information').
                                        css('display', 'none')
                                    $('.error-message').css('display', 'block')
                                    $('.error-message').html(
                                        Lang.get(
                                            'messages.appointment.doctor_schedule_not_available_on_this_date'))
                                }
                            }
                        }
                    },
                    error: function (result) {
                        displayErrorMessage(result.responseJSON.message)
                    }
                })

                if ($('#homeIsCreate').val() || $('#homeIsEdit').val()) {
                    var delayCall = 200
                    setTimeout(getCreateTimeSlot, delayCall)
                    let slotsData = null

                    function getCreateTimeSlot () {
                        if ($('#homeIsCreate').val()) {
                            slotsData = {
                                editSelectedDate: moment(
                                    $('#opdDate').datepicker('getDate')).
                                    format('MM/DD/YYYY'),
                                doctor_id: doctorId,
                            }
                        } else {
                            slotsData = {
                                editSelectedDate: moment(
                                    $('#opdDate').datepicker('getDate')).
                                    format('MM/DD/YYYY'),
                                editId: appointmentEditId,
                                doctor_id: doctorId,
                            }
                        }

                        $.ajax({
                            url: $('#homeGetBookingSlot').val(),
                            type: 'GET',
                            data: slotsData,
                            success: function (result) {
                                alreadyCreateTimeSlot = result.data.bookingSlotArr
                                if (result.data.hasOwnProperty('onlyTime')) {
                                    if (result.data.bookingSlotArr.length > 0) {
                                        editTimeSlot = result.data.onlyTime.toString()
                                        $.each(result.data.bookingSlotArr,
                                            function (index, value) {
                                                $.each(intervals,
                                                    function (i, v) {
                                                        if (value == v) {
                                                            $('.time-interval').
                                                                each(
                                                                    function () {
                                                                        if ($(
                                                                            this).
                                                                                data(
                                                                                    'id') ==
                                                                            i) {
                                                                            if ($(
                                                                                this).
                                                                                    html() !=
                                                                                editTimeSlot) {
                                                                                $(this).
                                                                                    parent().
                                                                                    css({
                                                                                        'background-color': '#ffa721',
                                                                                        'border': '1px solid #ffa721',
                                                                                        'color': '#ffffff',
                                                                                    })
                                                                                $(this).
                                                                                    parent().
                                                                                    addClass(
                                                                                        'booked')
                                                                                $(this).
                                                                                    parent().
                                                                                    children().
                                                                                    prop(
                                                                                        'disabled',
                                                                                        true)
                                                                            }
                                                                        }
                                                                    })
                                                        }
                                                    })
                                            })
                                    }
                                    $('.time-interval').each(function () {
                                        if ($(this).html() == editTimeSlot &&
                                            result.data.bookingSlotArr.length >
                                            0) {
                                            $(this).
                                                parent().
                                                addClass('time-slot-book')
                                            $(this).
                                                parent().
                                                removeClass('booked')
                                            $(this).
                                                parent().
                                                children().
                                                prop('disabled', false)
                                            $(this).click()
                                        }
                                    })
                                } else if (alreadyCreateTimeSlot.length > 0) {
                                    $.each(alreadyCreateTimeSlot,
                                        function (index, value) {
                                            $.each(intervals, function (i, v) {
                                                if (value === v) {
                                                    $('.time-interval').
                                                        each(function () {
                                                            if ($(this).
                                                                    data('id') ===
                                                                i) {
                                                                $(this).
                                                                    parent().
                                                                    addClass(
                                                                        'time-slot-book')
                                                                $('.time-slot-book').
                                                                    css({
                                                                        'background-color': '#0CA33C',
                                                                        'border': '1px solid #0CA33C',
                                                                        'color': '#ffffff',
                                                                    })
                                                                $(this).
                                                                    parent().
                                                                    addClass(
                                                                        'booked')
                                                                $(this).
                                                                    parent().
                                                                    children().
                                                                    prop(
                                                                        'disabled',
                                                                        true)
                                                            }
                                                        })
                                                }
                                            })
                                        })
                                }
                            },
                        })
                    }
                }
            },
        })

    // opdDate.datepicker(
    //     $.extend({}, $.datepicker.regional[$('.userCurrentLanguage').val()]))

    // if edit record then trigger change
    var editTimeSlot
    if ($('#homeIsEdit').val()) {
        $('#appointmentDoctorId').trigger('change', function (event) {
            doctorId = $(this).val()
        })

        $('#opdDate').trigger('dp.change', function () {
            var selected = new Date($(this).val())
        })
    }

    $('.old-patient-email').focusout(function () {
        let email = $('.old-patient-email').val()
        if (oldPatient && email != null) {
            $.ajax({
                url: 'appointments' + '/' + email + '/patient-detail',
                type: 'get',
                success: function (result) {
                    if (result.data != null) {
                        $('#patient').empty()
                        $.each(result.data, function (index, value) {
                            $('#patientName').val(value)
                            $('#patient').val(index)
                        })
                    } else {
                        displayErrorMessage(
                            Lang.get(
                                'messages.appointment.patient_not_exists_or_status_is_not_active'))
                    }
                },
            })
        }
    })

    if (!$('#appointmentDate').val()) {
        return
    }
    let appointmentDate = $('#appointmentDate').val()
    // var doctor = $('#doctor').val()
    if (appointmentDate !== null) {
        loadAppointmentDate()
    }

    function loadAppointmentDate () {
        opdDate.datepicker('setDate', appointmentDate)
        // opdDate.datepicker($.extend({},
        //     $.datepicker.regional[$('.userCurrentLanguage').val()]))
        if (opdDate !== null) {
            opdDate instanceof Date
            let dateStr = opdDate
            let selectedDate = appointmentDate
            $('.doctor-schedule').css('display', 'none')
            $('.error-message').css('display', 'none')
            $('.available-slot-heading').css('display', 'none')
            $('.color-information').css('display', 'none')
            $('.time-slot').remove()
            // if ($('#departmentId').val() == '') {
            //     $('#validationErrorsBox').
            //         show().
            //         html('Please select Doctor Department');
            //     $('#validationErrorsBox').delay(5000).fadeOut();
            //     $('#opdDate').val('');
            //     // opdDate.clear();
            //     return false;
            // } else if ($('#doctorId').val() == '') {
            //     $('#validationErrorsBox').show().html('Please select Doctor');
            //     $('#validationErrorsBox').delay(5000).fadeOut();
            //     $('#opdDate').val('');
            //     // opdDate.clear();
            //     return false;
            // }
            var weekday = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday']
            var selected = new Date(selectedDate)
            var selectedAppDate = opdDate.datepicker('getDate')
            let dayName = weekday[selectedAppDate.getDay()]
            // let dayName = weekday[selected.getDay()]
            selectedDate = dateStr

            //if dayName is blank, then ajax call not run.
            if (dayName == null || dayName == '') {
                return false
            }

            //get doctor schedule list with time slot.
            $.ajax({
                type: 'GET',
                url: $('#homeDoctorScheduleList').val(),
                data: {
                    day_name: dayName,
                    doctor_id: doctor,
                },
                success: function (result) {
                    if (result.success) {
                        if (result.data != '') {
                            if (result.data.scheduleDay.length != 0) {
                                let availableFrom = ''

                                if (moment(new Date()).
                                        format('MM/DD/YYYY') ===
                                    appointmentDate) {
                                    // availableFrom = moment(new Date()).
                                    // add(result.data.perPatientTime[0].per_patient_time,
                                    //     'minutes').
                                    // format('H:mm:ss')
                                    // availableFrom = moment.duration(
                                    //     result.data.perPatientTime[0].per_patient_time).
                                    //     asMinutes()
                                    // availableFrom = moment(
                                    //     availableFrom.toString()).
                                    //     format('H:mm:ss')
                                    availableFrom = moment().ceil(moment.duration( result.data.perPatientTime[0].per_patient_time).asMinutes(), 'minute');
                                    // availableFrom = moment.duration( result.data.perPatientTime[0].per_patient_time).asMinutes();
                                    availableFrom = moment(availableFrom.toString()).format('H:mm:ss');
                                    // availableFrom = moment(new Date()).
                                    //     add(result.data.perPatientTime[0].per_patient_time,
                                    //         'minutes').
                                    //     format('H:mm:ss')
                                } else {
                                    availableFrom = result.data.scheduleDay[0].available_from
                                }
                                var doctorStartTime = selectedDate + ' ' +
                                    availableFrom
                                var doctorEndTime = selectedDate + ' ' +
                                    result.data.scheduleDay[0].available_to
                                
                                var doctorPatientTime = result.data.perPatientTime[0].per_patient_time

                                //perPatientTime convert to Minute
                                var a = doctorPatientTime.split(':') // split it at the colons
                                var minutes = (+a[0]) * 60 + (+a[1]) // convert to minute

                                //parse In
                                var startTime = parseIn(doctorStartTime)
                                var endTime = parseIn(doctorEndTime)
                                
                                //call to getTimeIntervals function
                                intervals = getTimeIntervals(startTime, endTime,
                                    minutes)

                                //if intervals array length is grater then 0 then process
                                if (intervals.length > 0) {
                                    $('.available-slot-heading').
                                        css('display', 'block')
                                    $('.color-information').
                                        css('display', 'block')
                                    var index
                                    let timeStlots = ''
                                    for (index = 0; index <
                                    intervals.length; ++index) {
                                        let data = [
                                            {
                                                'index': index,
                                                'timeSlot': intervals[index],
                                            }]
                                        var timeSlot = prepareTemplateRender(
                                            '#appointmentSlotTemplate', data)
                                        timeStlots += timeSlot
                                    }
                                    $('.available-slot').append(timeStlots)
                                }

                                // display Day Name and time
                                if ((availableFrom !=
                                    '00:00:00' &&
                                    result.data.scheduleDay[0].available_to !=
                                    '00:00:00') &&
                                    (doctorStartTime != doctorEndTime)) {
                                    $('.doctor-schedule').
                                        css('display', 'block')
                                    $('.color-information').
                                        css('display', 'block')
                                    $('.day-name').html(
                                        result.data.scheduleDay[0].available_on)
                                    $('.schedule-time').html('[' +
                                        availableFrom +
                                        ' - ' +
                                        result.data.scheduleDay[0].available_to +
                                        ']')
                                } else {
                                    $('.doctor-schedule').css('display', 'none')
                                    $('.color-information').
                                        css('display', 'none')
                                    $('.error-message').css('display', 'block')
                                    $('.error-message').html(
                                        Lang.get(
                                            'messages.appointment.doctor_schedule_not_available_on_this_date'))
                                }
                            } else {
                                $('.doctor-schedule').css('display', 'none')
                                $('.color-information').css('display', 'none')
                                $('.error-message').css('display', 'block')
                                $('.error-message').html(
                                    Lang.get(
                                        'messages.appointment.doctor_schedule_not_available_on_this_date'))
                            }
                        }
                    }
                },
            })

            if ($('#homeIsCreate').val() || $('#homeIsEdit').val()) {
                var delayCall = 200
                setTimeout(getCreateTimeSlot, delayCall)
                let slotsData = null

                function getCreateTimeSlot () {
                    if ($('#homeIsCreate').val()) {
                        slotsData = {
                            editSelectedDate: moment(
                                $('#opdDate').datepicker('getDate')).
                                format('MM/DD/YYYY'),
                            doctor_id: doctorId,
                        }
                    } else {
                        slotsData = {
                            editSelectedDate: moment(
                                $('#opdDate').datepicker('getDate')).
                                format('MM/DD/YYYY'),
                            editId: appointmentEditId,
                            doctor_id: doctorId,
                        }
                    }

                    $.ajax({
                        url: $('#homeGetBookingSlot').val(),
                        type: 'GET',
                        data: slotsData,
                        success: function (result) {
                            alreadyCreateTimeSlot = result.data.bookingSlotArr
                            if (result.data.hasOwnProperty('onlyTime')) {
                                if (result.data.bookingSlotArr.length > 0) {
                                    editTimeSlot = result.data.onlyTime.toString()
                                    $.each(result.data.bookingSlotArr,
                                        function (index, value) {
                                            $.each(intervals,
                                                function (i, v) {
                                                    if (value == v) {
                                                        $('.time-interval').
                                                            each(
                                                                function () {
                                                                    if ($(
                                                                        this).
                                                                            data(
                                                                                'id') ==
                                                                        i) {
                                                                        if ($(
                                                                            this).
                                                                                html() !=
                                                                            editTimeSlot) {
                                                                            $(this).
                                                                                parent().
                                                                                css({
                                                                                    'background-color': '#ffa721',
                                                                                    'border': '1px solid #ffa721',
                                                                                    'color': '#ffffff',
                                                                                })
                                                                            $(this).
                                                                                parent().
                                                                                addClass(
                                                                                    'booked')
                                                                            $(this).
                                                                                parent().
                                                                                children().
                                                                                prop(
                                                                                    'disabled',
                                                                                    true)
                                                                        }
                                                                    }
                                                                })
                                                    }
                                                })
                                        })
                                }
                                $('.time-interval').each(function () {
                                    if ($(this).html() == editTimeSlot &&
                                        result.data.bookingSlotArr.length >
                                        0) {
                                        $(this).
                                            parent().
                                            addClass('time-slot-book')
                                        $(this).
                                            parent().
                                            removeClass('booked')
                                        $(this).
                                            parent().
                                            children().
                                            prop('disabled', false)
                                        $(this).click()
                                    }
                                })
                            } else if (alreadyCreateTimeSlot.length > 0) {
                                $.each(alreadyCreateTimeSlot,
                                    function (index, value) {
                                        $.each(intervals, function (i, v) {
                                            if (value === v) {
                                                $('.time-interval').
                                                    each(function () {
                                                        if ($(this).
                                                                data('id') ===
                                                            i) {
                                                            $(this).
                                                                parent().
                                                                addClass(
                                                                    'time-slot-book')
                                                            $('.time-slot-book').
                                                                css({
                                                                    'background-color': '#0CA33C',
                                                                    'border': '1px solid #0CA33C',
                                                                    'color': '#ffffff',
                                                                })
                                                            $(this).
                                                                parent().
                                                                addClass(
                                                                    'booked')
                                                            $(this).
                                                                parent().
                                                                children().
                                                                prop(
                                                                    'disabled',
                                                                    true)
                                                        }
                                                    })
                                            }
                                        })
                                    })
                            }
                        },
                    })
                }
            }
        }
    }
}

var selectedDate
var intervals
var alreadyCreateTimeSlot

let dateSelectSlot
Lang.setLocale($('.userCurrentLanguage').val())
$('#patientId').first().focus()

var doctor = $('#doctor').val()

let appointmentDate = $('#appointmentDate').val()

var doctorId
let doctorChange = false

listenChange('#webDepartmentId', function () {
    $('.error-message').css('display', 'none')
    var selectize = $('#appointmentDoctorId')[0].selectize
    selectize.clearOptions()
    $('#opdDate').val('')
    // opdDate.clear();
    $.ajax({
        url: $('#homeDoctorDepartmentUrl').val(),
        type: 'get',
        dataType: 'json',
        data: { id: $(this).val() },
        success: function (data) {
            $('#appointmentDoctorId').empty()
            $('#appointmentDoctorId').
                append($('<option value="">Select Doctor</option>'))
            $.each(data.data, function (i, v) {
                $('#appointmentDoctorId').
                    append($('<option></option>').attr('value', i).text(v))
            })
            let $select = $(document.getElementById('appointmentDoctorId')).
                selectize()
            let selectize = $select[0].selectize
            $.each(data.data, function (i, v) {
                selectize.addOption({ value: i, text: v })
            })
            selectize.refreshOptions()
        },
    })
})

listenChange('#appointmentDoctorId', function () {
    if (doctorChange) {
        $('.error-message').css('display', 'none')
        $('#opdDate').val('')
        // opdDate.clear();
        $('.doctor-schedule').css('display', 'none')
        $('.error-message').css('display', 'none')
        $('.available-slot-heading').css('display', 'none')
        $('.color-information').css('display', 'none')
        $('.time-slot').remove()
        doctorChange = true
    }
    $('.error-message').css('display', 'none')
    doctorId = $(this).val()
    doctorChange = true
})

//parseIn date_time
function parseIn (date_time) {
    var d = new Date()
    d.setHours(date_time.substring(16, 18))
    d.setMinutes(date_time.substring(19, 21))

    return d
}

//make time slot list
function getTimeIntervals (time1, time2, duration) {
    var arr = []
    if (new Date() > $('#opdDate').datepicker('getDate') && new Date().getTime() > time2.getTime()) {
        return arr
    } else if (new Date() > new Date($('#appointmentDate').val()) && new Date().getTime() > time2.getTime()) {
        return arr
    }
    else {
        while (time1 < time2) {
            arr.push(time1.toTimeString().substring(0, 5))
            time1.setMinutes(time1.getMinutes() + duration)
        }
        return arr
    }
}

//slot click change color
var selectedTime
listenClick('.time-interval', function (event) {
    let appointmentId = $(event.currentTarget).attr('data-id')
    if ($(this).data('id') == appointmentId) {
        if ($(this).parent().hasClass('booked')) {
            $('.time-slot-book').css('background-color', '#ffa0a0')
        }
    }
    selectedTime = ($(this).text())
    $('.time-slot').removeClass('time-slot-book')
    $(this).parent().addClass('time-slot-book')
})

var editTimeSlot
listenClick('.time-interval', function () {
    editTimeSlot = ($(this).text())
})

let oldPatient = false
listenChange('.new-patient-radio', function () {
    // loadAppointmentDate();
    if ($(this).is(':checked')) {
        $('.old-patient').addClass('d-none')
        $('.first-name-div').removeClass('d-none')
        $('.last-name-div').removeClass('d-none')
        $('.gender-div').removeClass('d-none')
        $('.password-div').removeClass('d-none')
        $('.confirm-password-div').removeClass('d-none')
        $('.appointment-slot').removeClass('d-none')
        $('#firstName').prop('required', true)
        $('#lastName').prop('required', true)
        $('#password').prop('required', true)
        $('#confirmPassword').prop('required', true)
        oldPatient = false
    }
})
// console.log($('.old-patient-radio').val())
listenChange('.old-patient-radio', function () {
    // console.log('radio button change')
    if ($(this).is(':checked')) {
        $('.old-patient').removeClass('d-none')
        $('.first-name-div').addClass('d-none')
        $('.last-name-div').addClass('d-none')
        $('.gender-div').addClass('d-none')
        $('.password-div').addClass('d-none')
        $('.confirm-password-div').addClass('d-none')
        $('.appointment-slot').removeClass('d-none')
        $('#firstName').prop('required', false)
        $('#lastName').prop('required', false)
        $('#password').prop('required', false)
        $('#confirmPassword').prop('required', false)
        oldPatient = true
    }
})

// function showScreenLoader () {
//     $('#overlay-screen-lock').removeClass('d-none');
// }
//
// function hideScreenLoader () {
//     $('#overlay-screen-lock').addClass('d-none');
// }

// listen('keypress', '#firstName, #lastName', function (e) {
//     if (e.which === 32)
//         return false;
// });

$.ajax({
    url: $('#homeDoctorUrl').val(),
    type: 'get',
    dataType: 'json',
    data: { id: doctor },
    success: function (data) {
        $('#appointmentDoctorId').empty()
        let $select = $(document.getElementById('appointmentDoctorId')).
            selectize()
        let selectize = $select[0].selectize
        $.each(data.data, function (i, v) {
            selectize.addOption({ value: i, text: v })
            selectize.setValue(i)
        })
    },
})

function formReset () {
    $('.old-patient').addClass('d-none')
    $('.first-name-div').removeClass('d-none')
    $('.last-name-div').removeClass('d-none')
    $('.gender-div').removeClass('d-none')
    $('.password-div').removeClass('d-none')
    $('.confirm-password-div').removeClass('d-none')
    $('.appointment-slot').removeClass('d-none')
    $('#firstName').prop('required', true)
    $('#lastName').prop('required', true)
    $('#password').prop('required', true)
    $('#confirmPassword').prop('required', true)
}

//create appointment
listenSubmit('#webAppointmentFormSubmit', function (event) {
    event.preventDefault()
    if (!oldPatient) {
        let isValidate = validatePassword()
        if (!isValidate) {
            return false
        }
    }

    if (selectedTime == null || selectedTime === '') {
        displayErrorMessage(Lang.get(
            'messages.appointment.please_select_appointment_time_slot'))
        return false
    }
    $('#opdDate').
        val(moment($('#opdDate').datepicker('getDate')).format('MM/DD/YYYY'))
    // console.log($('#opdDate').val())

    let formData = $(this).serialize() + '&time=' + selectedTime
    $.ajax({
        url: $('#homeAppointmentSaveUrl').val(),
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function (result) {
            console.log(result.message)
            displaySuccessMessage(
                Lang.get('messages.web_menu.appointment') + ' ' +
                Lang.get('messages.common.saved_successfully'))
            $('#webAppointmentFormSubmit')[0].reset()
            var $select = $('#webDepartmentId').selectize()
            var control = $select[0].selectize
            control.clear()
            var $selectOne = $('#appointmentDoctorId').selectize()
            var controlOne = $selectOne[0].selectize
            controlOne.clear()
            $('.appointment-slot').addClass('d-none')
            formReset()
        },
        error: function (result) {
            // console.log(result.responseJSON.message)
            displayErrorMessage(result.responseJSON.message)
            $('#webAppointmentFormSubmit')[0].reset()
            $('.appointment-slot').addClass('d-none')
        },
    })
})

function validatePassword () {
    let password = $('#password').val()
    let confirmPassword = $('#confirmPassword').val()

    if (password == '' || confirmPassword == '') {
        displayErrorMessage(Lang.get(
            'messages.web_password.please_fill_all_the_required_fields'))
        return false
    }

    if (password !== confirmPassword) {
        displayErrorMessage(Lang.get(
            'messages.web_password.password_and_confirm_password_not_match'))
        return false
    }

    return true
}
