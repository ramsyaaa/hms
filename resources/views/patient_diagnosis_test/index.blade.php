@extends('layouts.app')
@section('title')
    {{ __('messages.patient_diagnosis_test.patient_diagnosis_test') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/livewire-table.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('patientDiagnosisTestUrl', url('patient-diagnosis-test'), ['id' => 'patientDiagnosisTestUrl']) }}
            {{ Form::hidden('diagnosisCategoryUrl', url('diagnosis-categories'), ['id' => 'diagnosisCategoryUrl']) }}
            {{ Form::hidden('doctorUrl', (Auth::user()->hasRole('Lab Technician')) ? url('employee/doctor') : url('doctors'), ['id' => 'doctorUrl']) }}
            {{ Form::hidden('patientUrl', url('patients'), ['id' => 'patientUrl']) }}
            {{ Form::hidden('patient_diagnosis_test', __('messages.patient_diagnosis_test.diagnosis'), ['id' => 'patientDiagnosisTest']) }}
            <livewire:patient-diagnosis-test-table/>
            {{Form::hidden('patientDiagnosisTestUrl',url('patient-diagnosis-test'),['id'=>'indexPatientDiagnosisTestUrl','class'=>'patientDiagnosisTestUrl'])}}
            @include('accountants.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/custom/delete.js --}}
    {{--  assets/js/patient_diagnosis_test/patient_diagnosis_test.js --}}
@endsection
