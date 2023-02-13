@extends('layouts.app')
@section('title')
    {{ __('messages.patient_diagnosis_test.edit_patient_diagnosis_test') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('patient.diagnosis.test.index') }}"
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
                </div>
            </div>
            <div class="card">
                {{ Form::hidden('patientDiagnosisTestSaveUrl', route('patient.diagnosis.test.update',$patientDiagnosisTest->id), ['class' => 'patientDiagnosisTestSaveUrl']) }}
                {{ Form::hidden('patientDiagnosisTest', route('patient.diagnosis.test.index'), ['class' => 'patientDiagnosisTest']) }}
                {{ Form::hidden('uniqueId', $patientDiagnosisTests->count() + 1, ['class' => 'uniqueId']) }}
                <div class="card-body p-12">
                    {{ Form::model($patientDiagnosisTest, ['id'=>'editDiagnosisTestForm','class'=>'patientDiagnosisTestForm']) }}
                    @include('patient_diagnosis_test.edit_fields')
                    {{ Form::close() }}
                </div>
                @include('patient_diagnosis_test.templates.templates')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- assets/js/patient_diagnosis_test/create-edit.js--}}
@endsection
