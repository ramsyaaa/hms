<div id="edit_consulatation_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.live_consultation.edit_live_consultation') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editConsultationForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editConsultationErrorsBox"></div>
                {{ Form::hidden('live_consultation_id',null,['id'=>'liveConsultationId']) }}
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_title', __('messages.live_consultation.consultation_title').(':'), ['class' => 'form-label ']) }}
                        <span class="required"></span>
                        {{ Form::text('consultation_title', null, ['class' => 'form-control edit-consultation-title','required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_date', __('messages.live_consultation.consultation_date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('consultation_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light edit-consultation-date form-control' : 'bg-white edit-consultation-date form-control'),'required', 'autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_duration_minutes', __('messages.live_consultation.consultation_duration_minutes').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::number('consultation_duration_minutes', '', ['class' => 'form-control edit-consultation-duration-minutes','required', 'min' => '0', 'max' => '720']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.blood_issue.patient_name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select edit-patient-name patient-name', 'placeholder' => 'Select Patient Name', 'id' => 'editConsultationPatientName', 'required', 'data-control'=>'select2']) }}
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        {{ Form::label('doctor_id', __('messages.blood_issue.doctor_name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select edit-doctor-name', 'placeholder' => 'Select Doctor Name', 'required', 'id' => 'editConsultationDoctorName','data-control'=>'select2']) }}
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        {{ Form::label('type', __('messages.live_consultation.type').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('type', $type, null, ['class' => 'form-select edit-consultation-type', 'placeholder' => 'Select Type', 'disabled', 'required', 'id' => 'editConsultationType','data-control'=>'select2']) }}
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        {{ Form::label('type_number', __('messages.live_consultation.type_number').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('type_number', [null], null, ['class' => 'form-select edit-consultation-type-number', 'placeholder' => 'Select Type Number', 'disabled', 'required','data-control'=>'select2', 'id' => 'editConsultationTypeNumber']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('host_video',__('messages.live_consultation.host_video').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        <br>
                        <div class="d-flex align-items-center">
                            <div class="form-check me-10">
                                <label class="form-label" for="editConsultationHostEnable">{{ __('messages.live_consultation.enable') }}</label>
                                {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_ENABLE, false, ['class' => 'form-check-input host-enable','id'=>'editConsultationHostEnable']) }} &nbsp;
                            </div>
                            <div class="form-check me-10">
                                <label class="form-label" for="editConsultationHostDisable">{{ __('messages.live_consultation.disabled') }}</label>&nbsp;
                                {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_DISABLED, true, ['class' => 'form-check-input host-disabled','id'=>'editConsultationHostDisable']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('participant_video',__('messages.live_consultation.client_video').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        <br>
                        <div class="d-flex align-items-center">
                            <div class="form-check me-10">
                                <label class="form-label" for="editConsultationParticipantEnable">{{ __('messages.live_consultation.enable') }}</label>
                                {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_ENABLE, false, ['class' => 'form-check-input client-enable','id'=>'editConsultationParticipantEnable']) }} &nbsp;
                            </div>
                            <div class="form-check me-10">
                                <label class="form-label" for="editConsultationParticipantDisable">{{ __('messages.live_consultation.disabled') }}</label>&nbsp;
                                {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_DISABLED, true, ['class' => 'form-check-input client-disabled','id'=>'editConsultationParticipantDisable']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.testimonial.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', '', ['class' => 'form-control edit-description', 'rows' => 3]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editConsultationSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
