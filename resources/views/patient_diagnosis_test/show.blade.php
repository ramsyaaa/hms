@extends('layouts.app')
@section('title')
    {{ __('messages.patient_diagnosis_test.patient_diagnosis_test')}}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">--}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.patient_diagnosis_test.patient_diagnosis_test_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a data-turbo="false"
                   href="{{route('patient.diagnosis.test.pdf',['patientDiagnosisTest' => $patientDiagnosisTest->id])}}"
                   class="btn btn-success text-white me-2 edit-btn" target="_blank">{{ __('messages.patient_diagnosis_test.print_diagnosis_test') }}</a>
                <a href="{{route('patient.diagnosis.test.edit',['patientDiagnosisTest' => $patientDiagnosisTest->id])}}"
                   class="btn btn-primary edit-btn me-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ url('patient-diagnosis-test')}}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('patient_diagnosis_test.show_fields')
        </div>
    </div>
@endsection
