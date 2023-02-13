@extends('layouts.app')
@section('title')
    {{ __('messages.prescriptions') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('patient_id',true,['id'=>'indexPatientPrescriptionId'])}}
            <livewire:patient-prescription-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/patient_prescriptions/patient_prescriptions.js --}}
