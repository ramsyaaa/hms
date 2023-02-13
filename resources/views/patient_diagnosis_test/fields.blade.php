<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('patient_id', __('messages.patient_diagnosis_test.patient').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('patient_id', $patients, isset($patientDiagnosisTest)?$patientDiagnosisTest->patient_id:null, ['class' => 'form-select', 'required', 'id' => 'diagnosisTestPatientId', 'placeholder' => 'Select Patient', 'data-control' => 'select2']) }}
        </div>
    </div>
    @if(Auth::user()->hasRole('Doctor'))
        <input type="hidden" name="doctor_id" value="{{ Auth::user()->owner_id }}">
    @else
        <div class="form-group col-md-3">
            {{ Form::label('doctor_id', __('messages.patient_diagnosis_test.doctor').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('doctor_id', $doctors, isset($patientDiagnosisTest)?$patientDiagnosisTest->doctor_id:null, ['class' => 'form-select','required','id' => 'diagnosisTestdoctorId','placeholder'=>'Select Doctor', 'data-control' => 'select2']) }}
        </div>
    @endif
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('category_id', __('messages.patient_diagnosis_test.diagnosis_category').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('category_id', $diagnosisCategory, isset($patientDiagnosisTest)?$patientDiagnosisTest->category_id:null, ['class' => 'form-select', 'required', 'id' => 'diagnosisTestCategoryId', 'data-control' => 'select2', 'placeholder' => 'Select Diagnosis Category']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('report_number', __('messages.patient_diagnosis_test.report_number').':', ['class' => 'form-label']) }}
            {{ Form::text('report_number', isset($patientDiagnosisTest)?$patientDiagnosisTest->report_number:$reportNumber, ['class' => 'form-control', 'readonly']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('age', __('messages.patient_diagnosis_test.age').':', ['class' => 'form-label']) }}
            {{ Form::number('age', null, ['class' => 'form-control', 'min' => '1', 'max' => '100']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('height', __('messages.patient_diagnosis_test.height').':', ['class' => 'form-label']) }}
            {{ Form::number('height', null, ['class' => 'form-control floatNumber', 'max' => '7', 'min' => '1' , 'step' => '.01']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('weight', __('messages.patient_diagnosis_test.weight').':', ['class' => 'form-label']) }}
            {{ Form::number('weight', null, ['class' => 'form-control floatNumber', 'data-mask'=>'##0,00', 'min' => '1' , 'max' => '200', 'step' => '.01']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('average_glucose', __('messages.patient_diagnosis_test.average_glucose').':', ['class' => 'form-label']) }}
            {{ Form::text('average_glucose', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('fasting_blood_sugar', __('messages.patient_diagnosis_test.fasting_blood_sugar').':', ['class' => 'form-label']) }}
            {{ Form::text('fasting_blood_sugar', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('urine_sugar', __('messages.patient_diagnosis_test.urine_sugar').':', ['class' => 'form-label']) }}
            {{ Form::text('urine_sugar', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('blood_pressure', __('messages.patient_diagnosis_test.blood_pressure').':', ['class' => 'form-label']) }}
            {{ Form::number('blood_pressure', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('diabetes', __('messages.patient_diagnosis_test.diabetes').':', ['class' => 'form-label']) }}
            {{ Form::text('diabetes', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="mb-5">
            {{ Form::label('cholesterol', __('messages.patient_diagnosis_test.cholesterol').':', ['class' => 'form-label']) }}
            {{ Form::text('cholesterol', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 mt-3 mb-5">
        <div class="row">
            <div class="mb-3 h5 col-lg-8">
                {{__('messages.patient_diagnosis_test.add_other_diagnosis_property')}}
            </div>
        </div>
        <table class="table table-striped"
               id="patientDiagnosisTestTbl">
            <thead class="thead-dark">
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="text-center">#</th>
                <th class="diagnoses-filed">{{__('messages.patient_diagnosis_test.diagnosis_property_name')}}
                </th>
                <th class="diagnoses-filed">{{__('messages.patient_diagnosis_test.diagnosis_property_value')}}
                </th>
                <th class="diagnoses-filed text-center">
                    <button type="button" class="btn btn-sm btn-primary float-right w-50" id="addDiagnosisTestItem">
                        {{ __('messages.invoice.add') }}
                    </button>
                </th>
            </tr>
            </thead>
            <tbody class="diagnosis-item-container text-gray-600 fw-bold">
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2 saveBtn','id' => 'diagnosisTestSave']) !!}
    <a href="{{ route('patient.diagnosis.test.index') }}"
       class="btn btn-secondary me-2">{!! __('messages.common.cancel') !!}</a>
</div>
