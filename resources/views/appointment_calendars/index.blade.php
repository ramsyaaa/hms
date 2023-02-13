@extends('layouts.app')
@section('title')
    {{ __('messages.appointment.appointment_calendar') }}
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
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{ Form::hidden('todayText', __('messages.appointment.today'), ['id' => 'todayText']) }}
                {{ Form::hidden('weekText', __('messages.appointment.week'), ['id' => 'weekText']) }}
                {{ Form::hidden('monthText', __('messages.appointment.month'), ['id' => 'monthText']) }}
                {{ Form::hidden('dayText', __('messages.appointment.day'), ['id' => 'dayText']) }}
                {{ Form::hidden('doctorScheduleList', url('doctor-schedule-list'), ['id' => 'doctorScheduleList']) }}
                {{ Form::hidden('calenderAppointmentSaveUrl', route('appointments.store'), ['id' => 'calenderAppointmentSaveUrl']) }}
                {{ Form::hidden('calenderIndexPage', route('appointment-calendars.index'), ['id' => 'calenderIndexPage']) }}
                {{ Form::hidden('getBookingSlot', route('get.booking.slot'), ['id' => 'getBookingSlot']) }}
                {{ Form::hidden('userRole', Auth::user()->hasRole('Doctor'), ['id' => 'userRole']) }}
                {{ Form::hidden('isCreate', true, ['class' => 'isCreate']) }}
                {{ Form::hidden('getLanguage',getCurrentLoginUserLanguageName(), ['class' => 'getLanguage']) }}
                {{ Form::hidden('isDoctor', (Auth::user()->hasRole('Doctor'))? 1 :0 , ['id' => 'isDoctor']) }}
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Appointment show modal --}}
    <div id="appointmentDetailModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ __('messages.appointment.appointment_details') }}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('patient_name', __('messages.case.patient').(':'), ['class' => 'form-label']) }}
                            <p id="showPatientName"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('department_name', __('messages.appointment.doctor_department').(':'),['class' => 'form-label']) }}
                            <p id="showDepartmentName"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('doctor_name', __('messages.case.doctor').(':'),['class' => 'form-label']) }}
                            <p id="showDoctorName"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('opd_date', __('messages.appointment.date').(':'),['class' => 'form-label']) }}
                            <br>
                            <p id="showOpdDate"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('problem', __('messages.common.status').(':'),['class' => 'form-label']) }}
                            <p id="showIsCompleted"></p>
                        </div>
                        <div class="form-group col-sm-12 mb-5">
                            {{ Form::label('problem', __('messages.appointment.description').(':'),['class' => 'form-label']) }}
                            <p id="showProblem"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('appointment_calendars.add_appointment_modal')
    @include('appointments.templates.appointment_slot')
@endsection
@section('scripts')
    {{--  assets/js/appointment_calendar/appointment_calendar.js --}}
@endsection
