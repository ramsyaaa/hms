@extends('layouts.app')
@section('title')
    {{ __('messages.appointment.edit_appointment') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('appointments.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    <div class="alert alert-danger d-none hide" id="editAppointmentErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                {{ Form::hidden('doctorDepartmentUrl', url('doctors-list'), ['class' => 'doctorDepartmentUrl']) }}
                {{ Form::hidden('doctorScheduleList', url('doctor-schedule-list'), ['class' => 'doctorScheduleList']) }}
                {{ Form::hidden('getBookingSlot', route('get.booking.slot'), ['class' => 'getBookingSlot']) }}
                {{ Form::hidden('isEdit', true, ['class' => 'isEdit']) }}
                {{ Form::hidden('isCreate', false, ['class' => 'isCreate']) }}
                {{ Form::hidden('appointmentIndexPage', route('appointments.index'), ['class' => 'appointmentIndexPage']) }}
                {{ Form::hidden('appointmentEditId', $appointment->id, ['id' => 'appointmentEditsID']) }}
                {{ Form::hidden('appointmentUpdateUrl', route('appointments.update', ['appointment' => $appointment->id]), ['id' => 'appointmentUpdateUrl']) }}
                <div class="card-body">
                    {{ Form::model($appointment, ['route' => ['appointments.update', $appointment->id], 'method' => 'patch', 'id' => 'editAppointmentForm']) }}

                    @include('appointments.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @include('appointments.templates.appointment_slot')
    </div>
@endsection
{{-- Js :: assets/js/appointments/create-edit.js --}}
