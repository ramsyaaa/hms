@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        {{ Form::hidden('appointmentUrl', url('appointments'), ['class' => 'appointmentURL']) }}
        {{ Form::hidden('patientUrl', url('patients'), ['class' => 'patientAppointmentURL']) }}
        {{ Form::hidden('doctorUrl', url('doctors'), ['class' => 'doctorAppointmentURL']) }}
        {{ Form::hidden('doctorShowUrl', url('employee/doctor'), ['class' => 'doctorShowURL']) }}
        {{ Form::hidden('patientRole', Auth::user()->hasRole('Patient')?true:false, ['class' => 'patientRole']) }}
        {{ Form::hidden('doctorRole', Auth::user()->hasRole('Doctor')?false:true, ['class' => 'doctorRole']) }}
        {{ Form::hidden('loginDoctor', Auth::user()->hasRole('Doctor')?true:false, ['class' => 'loginDoctor']) }}
        {{ Form::hidden('adminRole', Auth::user()->hasRole('Admin')?true:false, ['class' => 'adminRole']) }}
        {{ Form::hidden('doctorDepartmentUrl', url('doctor-departments'), ['class' => 'doctorDepartmentURL']) }}
        {{ Form::hidden('appointment', __('messages.web_menu.appointment'), ['id' => 'Appointment']) }}
        {{ Form::hidden('todayAppointment', __('messages.appointment.today'), ['id' => 'todayAppointment']) }}
        {{ Form::hidden('yesterdayAppointment', __('messages.appointment.yesterday'), ['id' => 'yesterdayAppointment']) }}
        {{ Form::hidden('thisWeekAppointment', __('messages.appointment.this_week'), ['id' => 'thisWeekAppointment']) }}
        {{ Form::hidden('last7DayAppointment', __('messages.appointment.last_7_days'), ['id' => 'last7DayAppointment']) }}
        {{ Form::hidden('last30DayAppointment', __('messages.appointment.last_30_days'), ['id' => 'last30DayAppointment']) }}
        {{ Form::hidden('thisMonthAppointment', __('messages.appointment.this_month'), ['id' => 'thisMonthAppointment']) }}
        {{ Form::hidden('lastMonthAppointment', __('messages.appointment.last_month'), ['id' => 'lastMonthAppointment']) }}
        <div class="d-flex flex-column">
            <livewire:appointment-table/>
        </div>
        @include('appointments.templates.templates')
    </div>
@endsection
@section('scripts')
    
    {{--        asset('assets/js/plugins/daterangepicker.js >--}}
    {{--    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Doctor'))--}}
    {{--        assets/js/appointments/appointments.js --}}
    {{--    @else--}}
    {{--       assets/js/appointments/patient_appointment.js --}}
    {{--    @endif--}}

@endsection

