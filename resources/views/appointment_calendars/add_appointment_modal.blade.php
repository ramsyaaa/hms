<div id="addAppointmentModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.appointment.new_appointment') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'calenderAppointmentForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="calenderAppointmentErrorsBox"></div>
                <div class="row">
                    @if(Auth::user()->hasRole('Patient'))
                        <input type="hidden" name="patient_id" value="{{ Auth::user()->owner_id }}">
                    @else
                        <div class="form-group col-sm-6 mb-5">
                            {{ Form::label('patient_name', __('messages.case.patient').(':'), ['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::select('patient_id', $patients, null, ['class' => 'form-select','required','id' => 'patientIdAppointment','placeholder'=>'Select Patient']) }}
                        </div>
                    @endif
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('doctor_id', $doctorArr, null, ['class' => 'form-select','required','id' => 'doctorIdAppointment','placeholder'=>'Select Doctor','data-control' => 'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('opd_date', __('messages.appointment.date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('opd_date', '', ['id'=>'opdDateAppointment','class' => 'form-control','required', 'autocomplete' => 'off', 'readonly']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('status', __('messages.account.status').(':'),['class' => 'form-label']) }}
                        <div class="col-lg-8 d-flex align-items-center">
                            <div class="form-check form-switch fv-row">
                                <input name="is_completed" value="1" class="form-check-input w-35px h-20px"
                                       type="checkbox" {{ ($statusArr === \App\Models\Appointment::STATUS_COMPLETED) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div align="left" class="form-group col-sm-12 mb-5" id="appointmentSlotSection">
                        <div class="doctor-schedule" style="display: none">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="day-name"></span>
                            <span class="schedule-time"></span>
                        </div>
                        <strong class="error-message" style="display: none"></strong>
                        <div class="slot-heading">
                            <strong class="available-slot-heading form-label fs-6 fw-bolder text-gray-700"
                                    style="display: none">{{ __('messages.appointment.available_slot').':' }}</strong>
                        </div>
                        <div class="row no-of-slots-available overflow-auto" style="max-height: 145px;">
                            <div class="available-slot form-group col-sm-12">
                            </div>
                        </div>
                        <div class="color-information" align="left" style="display: none">
                            <div class="color-information d-none">
                            <span><i class="fa fa-circle fa-xs" aria-hidden="true"> </i> {{ __('messages.appointment.no_available') }}</span>
                        </div>
                        
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('problem', __('messages.appointment.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('problem', null, ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-2','id' => 'calenderAppointmentSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
