@extends('layouts.app')
@section('title')
    {{ __('messages.patient_diagnosis_test.patient_diagnosis_test') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            @include('flash::message')
            <livewire:patient-diagnosis-test-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/employee/patient_diagnosis_test.js --}}
