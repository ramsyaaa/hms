@extends('layouts.app')
@section('title')
    {{ __('messages.appointment.new_appointment') }}
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
                    <div class="alert alert-danger d-none hide" id="createAppointmentErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                {{ Form::hidden('doctorDepartmentUrl', url('doctors-list'), ['class' => 'doctorDepartmentUrl']) }}
                {{ Form::hidden('doctorScheduleList', url('doctor-schedule-list'), ['class' => 'doctorScheduleList']) }}
                {{ Form::hidden('appointmentSaveUrl', route('appointments.store'), ['id' => 'saveAppointmentURLID']) }}
                {{ Form::hidden('appointmentIndexPage', route('appointments.index'), ['class' => 'appointmentIndexPage']) }}
                {{ Form::hidden('isEdit', false, ['class' => 'isEdit']) }}
                {{ Form::hidden('isCreate', true, ['class' => 'isCreate']) }}
                {{ Form::hidden('getBookingSlot', route('get.booking.slot'), ['class' => 'getBookingSlot']) }}
                <div class="card-body p-12">
                    {{ Form::open(['id' => 'appointmentForm']) }}

                    @include('appointments.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @include('appointments.templates.appointment_slot')
    </div>
@endsection
@section('scripts')
    {{--  backend/js/moment-round/moment-round.js --}}
    {{--  assets/js/appointments/create-edit.js  --}}
@endsection
