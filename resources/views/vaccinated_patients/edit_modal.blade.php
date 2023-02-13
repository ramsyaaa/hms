<div id="edit_vaccinated_patient_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.vaccinated_patient.edit_vaccinate_patient') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'edit_vaccinated_patient_form']) }}
            <input type="hidden" id="editVPatientId">
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.vaccinated_patient.patient').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-control', 'required','id'=>'editVPatientName','placeholder' => 'Select Patient','data-control'=> 'select2']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('vaccination_id', __('messages.vaccinated_patient.vaccine').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('vaccination_id', $vaccinations, null, ['class' => 'form-control', 'required','id'=>'editVPatientVaccinationName','placeholder' => 'Select Vaccination','data-control'=> 'select2']) }}
                    </div>

                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('vaccination_serial_number', __('messages.vaccinated_patient.serial_no').(':'),['class' => 'form-label']) }}
                        {{ Form::text('vaccination_serial_number', '', ['id'=>'editVPatientSerialNo','class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('dose_number', __('messages.vaccinated_patient.does_no').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::number('dose_number', '', ['id'=>'editVPatientDoseNumber','class' => 'form-control','min'=>'1','max'=>'50','minlength'=>'1','maxlength'=>'2','required']) }}
                    </div>
                    @php $currentLang = app()->getLocale() @endphp
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('dose_given_date', __('messages.vaccinated_patient.dose_given_date').(':'),['class' => $currentLang == 'es' ? 'label-display form-label mb-3' : 'form-label mb-3']) }}
                        <span class="required"></span>
                        {{ Form::text('dose_given_date', '', ['id'=>'editVPatientDoesGivenDate','class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'required','autocomplete' => 'off']) }}
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.document.notes').(':'),['class' => 'form-label fs-6 mb-3']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id'=>'editVPatientDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-5','id' => 'editVPatientBtnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
