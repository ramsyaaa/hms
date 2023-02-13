<div class="row gx-10 mb-5">
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('patient_id',__('messages.ipd_patient.patient_id').':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
                {{ Form::select('patient_id', $data['patients'], null, ['class' => 'form-select', 'required', 'id' => 'editOpdPatientId', 'placeholder' => 'Select Patient', 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('case_id', __('messages.ipd_patient.case_id').':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('case_id', [null], null, ['class' => 'form-select', 'required', 'id' => 'editOpdCaseId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Choose Case']) }}
                {{ Form::hidden('patient_case_id', !empty($opdPatientDepartment->patientCase) ? $opdPatientDepartment->patientCase->case_id : '', ['class' => 'patientCaseId']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('opd_number', __('messages.opd_patient.opd_number').':', ['class' => 'form-label']) }}
                {{ Form::text('opd_number', null, ['class' => 'form-control', 'readonly']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('height', __('messages.ipd_patient.height').':', ['class' => 'form-label']) }}
                {{ Form::number('height', null, ['class' => 'form-control', 'max' => '7', 'step' => '.01']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('weight', __('messages.ipd_patient.weight').':', ['class' => 'form-label']) }}
                {{ Form::number('weight', null, ['class' => 'form-control', 'max' => '200', 'step' => '.01']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('bp', __('messages.ipd_patient.bp').':', ['class' => 'form-label']) }}
                {{ Form::text('bp', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('appointment_date', __('messages.opd_patient.appointment_date').':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::text('appointment_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'editOpdAppointmentDate','autocomplete' => 'off', 'required']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('doctor_id',__('messages.ipd_patient.doctor_id').':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('doctor_id', $data['doctors'], null, ['class' => 'form-select', 'required', 'id' => 'editOpdDoctorId', 'placeholder' => 'Select Doctor', 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                <div class="form-group">
                    {{ Form::label('standard_charge', __('messages.doctor_opd_charge.standard_charge').':', ['class' => 'form-label']) }}
                    <div class="input-group">
                        {{ Form::text('standard_charge', null , ['class' => 'form-control price-input', 'id' => 'editOpdStandardCharge', 'required']) }}
                        <div class="input-group-text border-0"><a><span>{{ getCurrencySymbol() }}</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('payment_mode', __('messages.ipd_payments.payment_mode').':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('payment_mode', $data['paymentMode'], null, ['class' => 'form-select', 'required', 'id' => 'editOpdPaymentMode', 'data-control' => 'select2', 'placeholder' => 'Choose Payment']) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('symptoms',__('messages.ipd_patient.symptoms').':', ['class' => 'form-label']) }}
                {{ Form::textarea('symptoms', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('notes',__('messages.ipd_patient.notes').':', ['class' => 'form-label']) }}
                {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('is_old_patient', __('messages.ipd_patient.is_old_patient').':', ['class' => 'form-label']) }}
                <br>
                <div class="form-check form-switch">
                    <input class="form-check-input w-35px h-20px" name="is_old_patient" type="checkbox"
                           value="1" {{ ($opdPatientDepartment->is_old_patient) ? 'checked' : '' }}>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnEditOpdSave']) }}
    <a href="{!! route('opd.patient.index') !!}"
       class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
</div>
