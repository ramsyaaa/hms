<div class="row">
    <!-- Patient Name Field -->
    @if(Auth::user()->hasRole('Patient'))
        <input type="hidden" name="patient_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('patient_name', __('messages.case.patient').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('patient_id', $patients, null, ['class' => 'form-select','required','id' => 'appointmentPatientId','placeholder'=>'Select Patient', 'data-control' => 'select2']) }}
        </div>
    @endif
<!-- Department Name Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('department_name', __('messages.appointment.doctor_department').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('department_id',$departments, null, ['class' => 'form-select','required','id' => 'appointmentDepartmentId','placeholder'=>'Select Department', 'data-control' => 'select2']) }}
    </div>
    <!-- Doctor Name Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('doctor_name', __('messages.case.doctor').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('doctor_id',(isset($doctors) ? $doctors : []), null, ['class' => 'form-select','required','id' => 'appointmentDoctorId','placeholder'=>'Select Doctor', 'data-control' => 'select2']) }}
    </div>

    @if(!Auth::user()->hasRole('Patient'))
    <!-- Date Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('opd_date', __('messages.appointment.date').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('opd_date', isset($appointment) ? $appointment->opd_date->format('Y-m-d') : null, ['id'=>'appointmentOpdDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light opdDate form-control' : 'bg-white opdDate form-control'), 'required', 'autocomplete'=>'off']) }}
        </div>
        <!-- Notes Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('problem', __('messages.appointment.description').':', ['class' => 'form-label']) }}
            {{ Form::textarea('problem', null, ['class' => 'form-control', 'rows'=>'4']) }}
        </div>
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label']) }}
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input w-35px h-20px" name="status" type="checkbox"
                       value="1" checked>
            </div>
        </div>
        <div class="form-group col-sm-6 mb-5">
            <div class="doctor-schedule" style="display: none">
                <i class="fas fa-calendar-alt"></i>
                <span class="day-name"></span>
                <span class="schedule-time"></span>
            </div>
            <strong class="error-message" style="display: none"></strong>
            <div class="slot-heading">
                <h3 class="available-slot-heading"
                        style="display: none">{{ __('messages.appointment.available_slot').':' }}</h3>
            </div>
            <div class="row">
                <div class="available-slot form-group col-sm-12">
                </div>
            </div>
            <div align="right" style="display: none">
                <span><i class="fa fa-circle color-information" aria-hidden="true"> </i> {{ __('messages.appointment.no_available') }}</span>
            </div>
        </div>
    @endif

    @if(Auth::user()->hasRole('Patient'))
    <!-- Date Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('opd_date', __('messages.appointment.date').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('opd_date', null, ['id'=>'patientAppointmentOpdDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light opdDate form-control' : 'bg-white opdDate form-control'), 'required', 'autocomplete'=>'off']) }}
        </div>

        <!-- Notes Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('problem', __('messages.appointment.description').':', ['class' => 'form-label']) }}
            {{ Form::textarea('problem', null, ['class' => 'form-control', 'rows'=>'4']) }}
        </div>
        <div class="form-group col-sm-6 available-slot-div">
            <div class="doctor-schedule" style="display: none">
                <i class="fas fa-calendar-alt"></i>
                <span class="day-name"></span>
                <span class="schedule-time"></span>
            </div>
            <strong class="error-message" style="display: none"></strong>
            <div class="slot-heading">
                <strong class="available-slot-heading"
                        style="display: none">{{ __('messages.appointment.available_slot').':' }}</strong>
            </div>
            <div class="row">
                <div class="available-slot form-group col-sm-10">
                </div>
            </div>
            <div class="color-information" align="right" style="display: none">
                <span><i class="fa fa-circle fa-xs" aria-hidden="true"> </i> {{ __('messages.appointment.no_available') }}</span>
            </div>
        </div>
    @endif
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12 d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id'=>'saveAppointment']) }}
        <a href="{{ route('appointments.index') }}"
           class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
