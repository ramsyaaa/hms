<div id="editIpdConsultantInstructionModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_consultant_register.edit_consultant_register') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                </button>
            </div>
            {{ Form::open(['id'=>'editIpdConsultantNewForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editIpdConsultantErrorsBox"></div>
                {{ Form::hidden('id',null,['id'=>'ipdEditConsultantId']) }}
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('applied_date', __('messages.ipd_patient_consultant_register.applied_date').':',['class' => 'form-label']) }}
                        <span class="required"></span>

                        {{ Form::text('applied_date', null, ['class' => 'form-control appliedDate bg-white min-w-170 modelDataPickerzindex', 'id' => 'editConsultantAppliedDate', 'autocomplete' => 'off', 'required']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('doctor_id', __('messages.ipd_patient_consultant_register.doctor_id').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select doctorId select2Selector','required','placeholder'=>'Select Doctor', 'id' => 'editConsultantDoctorId']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('instruction_date', __('messages.ipd_patient_consultant_register.instruction_date').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('instruction_date', null, ['class' => 'form-control instructionDate bg-white min-w-170', 'autocomplete' => 'off', 'required', 'id' => 'editConsultantInstructionDate']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('instruction', __('messages.ipd_patient_consultant_register.instruction').':',['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::textarea('instruction', null, ['class' => 'form-control min-w-170', 'rows' => 4, 'required', 'id' => 'editConsultantInstruction', 'onkeypress' => 'return avoidSpace(event);']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-2','id'=>'editConsultantSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
