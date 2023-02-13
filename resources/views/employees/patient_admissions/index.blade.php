@extends('layouts.app')
@section('title')
    {{ __('messages.patient_admissions') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <livewire:patient-admission-table/>
        </div>
    </div>    
@endsection
{{-- JS File :- assets/js/employee/patient_admission.js --}}
