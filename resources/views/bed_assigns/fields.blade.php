<div class="row">
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('case_id', __('messages.case.case').':', ['class' => 'form-label required']) }}
            {{ Form::select('case_id', $cases, null, ['class' => 'form-select', 'required', 'id' => 'caseId', 'placeholder' => 'Select Case', 'data-control' => 'select2', isset($bedAssign->case_id) ? 'disabled' : '']) }}
            @if(isset($bedAssign->case_id))
                {{Form::hidden('case_id',$bedAssign->case_id)}}
            @endif
            {{ Form::hidden('id', null,['id' => 'editBedAssignId']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('ipd_patient_department_id', __('messages.ipd_patient.ipd_patient').':', ['class' => 'form-label']) }}
            {{ Form::select('ipd_patient_department_id', [null], null , ['class' => 'form-select', 'required', 'id' => 'ipdPatientId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Select IPD Patient']) }}
            {{ Form::hidden('ipd_patient_id', !empty($bedAssign->ipdPatient) ? $bedAssign->ipdPatient->ipd_number : '', ['class' => 'ipdPatientId']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('bed_id', __('messages.bed_assign.bed').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('bed_id', $beds, isset($bedId) ? $bedId : null, ['class' => 'form-select', 'required', 'id' => 'BedAssignBedId', 'data-control' => 'select2', 'placeholder' => 'Select Bed']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('assign_date', __('messages.bed_assign.assign_date').':', ['class' => 'form-label required']) }}
            {{ Form::text('assign_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'BedAssignDate', 'required']) }}
        </div>
    </div>
    @isset($bedAssign)
        <div class="col-sm-6">
            <div class="mb-5">
                {{ Form::label('discharge_date', __('messages.bed_assign.discharge_date').':', ['class' => 'form-label']) }}
                {{ Form::text('discharge_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'BedAssignDischargeDate']) }}
            </div>
        </div>
    @endisset
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('description', __('messages.bed_assign.description').':', ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['id'=>'BedAssignDescription','class' => 'form-control', 'rows' => 4]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-5">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label']) }}
            <div class="form-check form-switch">
                <input class="form-check-input w-35px h-20px switch-input is-active" name="status" type="checkbox"
                       value="1" {{ (isset($bedAssign) && $bedAssign->status === 1) ? 'checked' : '' }} {{ !isset($bedAssign) ? 'checked' : '' }}>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'BedAssignSaveBtn']) !!}
    <a href="{!! route('bed-assigns.index') !!}"
       class="btn btn-secondary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
