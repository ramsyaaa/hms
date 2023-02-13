'use strict'

document.addEventListener('turbo:load', loadAppointmentTable)

function loadAppointmentTable () {

    let appointmentTimeRange = $('#time_range')
    var appointmentStart = moment().startOf('week')
    var appointmentEnd = moment().endOf('week')
    let appointmentStartTime = ''
    let appointmentEndTime = ''

    if ($('#appointmentStatus').length) {
        $('#appointmentStatus').select2()
    }

    function cb (appointmentStart, appointmentEnd) {
        $('#time_range').
            html(appointmentStart.format('MMM D, YYYY') + ' - ' +
                appointmentEnd.format('MMM D, YYYY'))
    }

    if (appointmentTimeRange.length) {
        Lang.setLocale($('.userCurrentLanguage').val())
        appointmentTimeRange.daterangepicker({
            startDate: appointmentStart,
            endDate: appointmentEnd,
            locale: {
                customRangeLabel: Lang.get('messages.common.custom'),
                applyLabel:Lang.get('messages.common.apply'),
                cancelLabel: Lang.get('messages.common.cancel'),
                fromLabel:Lang.get('messages.common.from'),
                toLabel: Lang.get('messages.common.to'),
                monthNames: [
                    Lang.get('messages.months.jan'),
                    Lang.get('messages.months.feb'),
                    Lang.get('messages.months.mar'),
                    Lang.get('messages.months.apr'),
                    Lang.get('messages.months.may'),
                    Lang.get('messages.months.jun'),
                    Lang.get('messages.months.jul'),
                    Lang.get('messages.months.aug'),
                    Lang.get('messages.months.sep'),
                    Lang.get('messages.months.oct'),
                    Lang.get('messages.months.nov'),
                    Lang.get('messages.months.dec')
                ],
                daysOfWeek: [
                    Lang.get('messages.weekdays.sun'),
                    Lang.get('messages.weekdays.mon'),
                    Lang.get('messages.weekdays.tue'),
                    Lang.get('messages.weekdays.wed'),
                    Lang.get('messages.weekdays.thu'),
                    Lang.get('messages.weekdays.fri'),
                    Lang.get('messages.weekdays.sat')
                ],
            },
            ranges: {
                [ Lang.get('messages.appointment.today')]: [moment(), moment()],
                [ Lang.get('messages.appointment.yesterday')]: [
                    moment().subtract(1, 'days'),
                    moment().subtract(1, 'days')],
                [ Lang.get('messages.appointment.this_week')]: [moment().startOf('week'), moment().endOf('week')],
                [ Lang.get('messages.appointment.last_7_days')]: [moment().subtract(6, 'days'), moment()],
                [ Lang.get('messages.appointment.last_30_days')]: [moment().subtract(29, 'days'), moment()],
                [ Lang.get('messages.appointment.this_month')]: [
                    moment().startOf('month'),
                    moment().endOf('month')],
                [ Lang.get('messages.appointment.last_month')]: [
                    moment().subtract(1, 'month').startOf('month'),
                    moment().subtract(1, 'month').endOf('month')],
            },
        }, cb)
        cb(appointmentStart, appointmentEnd)
        appointmentTimeRange.on('apply.daterangepicker', function (ev, picker) {
            appointmentStartTime = picker.startDate.format(
                'YYYY-MM-D  H:mm:ss')
            appointmentEndTime = picker.endDate.format('YYYY-MM-D  H:mm:ss')
            window.livewire.emit('changeDateFilter', 'statusFilter',
                [appointmentStartTime, appointmentEndTime])
        })

    }

    listenClick('.appointment-delete-btn', function (event) {
        let appointmentId = $(event.currentTarget).attr('data-id');
        deleteItem($('.appointmentURL').val() + '/' + appointmentId,
            '',
            $('#Appointment').val())
    })

    listenChange('#appointmentStatus', function () {
        let status = $(this).val()
        window.livewire.emit('changeFilter', 'statusFilter',
            [appointmentStartTime, appointmentEndTime, status])
    })

    listenClick('#appointmentResetFilter', function () {
        let appointmentTimeRange = $('#time_range')
        appointmentStartTime = appointmentTimeRange.data('daterangepicker').
            setStartDate(moment().startOf('week').format('MM/DD/YYYY'))
        appointmentEndTime = appointmentTimeRange.data('daterangepicker').
            setEndDate(moment().endOf('week').format('MM/DD/YYYY'))
        $('#appointmentStatus').val(2).trigger('change')
        hideDropdownManually($('#appointmentFilterBtn'),
            $('.dropdown-menu'))
    })

    listenClick('.appointment-complete-status', function (event) {
        let appointmentId = $(event.currentTarget).attr('data-id');
        completeAppointment(
            $('.appointmentURL').val() + '/' + appointmentId + '/status',
            '#appointmentsTbl', Lang.get('messages.web_menu.appointment') + ' ' + Lang.get('messages.user.status'))
    })

    listenClick('.cancel-appointment', function () {
        let appointmentId = $(this).attr('data-id');
        cancelAppointment(
            $('.appointmentURL').val() + '/' + appointmentId + '/cancel',
            '', Lang.get('messages.web_menu.appointment'))
    })

    function completeAppointment (url, tableId, header, appointmentId) {
        swal({
            title: Lang.get('messages.appointment.change_status'),
            text: Lang.get('messages.appointment.are_you_sure_want_to_change') + ' ' + header + ' ?',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: '#50cd89',
            showLoaderOnConfirm: true,
            buttons: {
                confirm:Lang.get('messages.common.yes'),
                cancel: Lang.get('messages.common.no'),
            },
        }).then(function (result) {
            if (result) {
                completeAppointmentAjax(url, tableId, header, appointmentId)
            }
        })
    }

    function completeAppointmentAjax (url, tableId, header, appointmentId) {
        $.ajax({
            url: url,
            type: 'POST',
            success: function (obj) {
                if (obj.success) {
                    Livewire.emit('refresh')
                }
                swal({
                    title: Lang.get('messages.appointment.changed_appointment'),
                    text: header + ' ' + Lang.get('messages.appointment.has_been_changed'),
                    icon: 'success',
                    confirmButtonColor: '#50cd89',
                    buttons: {
                        confirm:Lang.get('messages.common.ok'),
                    },
                    timer: 2000,
                })
            },
            error: function (data) {
                swal({
                    title: 'Error',
                    icon: 'error',
                    text: data.responseJSON.message,
                    type: 'error',
                    confirmButtonColor: '#50cd89',
                    buttons: {
                        confirm:Lang.get('messages.common.ok'),
                    },
                    timer: 5000,
                })
            },
        })
    }

}

