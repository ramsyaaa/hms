@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patients') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            {{Form::hidden('opdPatientUrl',url('opds'),['id'=>'indexOpdPatientUrl'])}}
            {{Form::hidden('patientUrl',url('patients'),['id'=>'indexPatientOpdUrl'])}}
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexOpdDoctorUrl'])}}
            {{ Form::hidden('opd_patient_department', __('messages.opd_patient.opd_patient'), ['id' => 'Receptionist']) }}
            <livewire:opd-patient-table/>
            @include('opd_patient_departments.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{-- assets/js/opd_patients/opd_patients.js--}}
@endsection
