@extends('layouts.app')
@section('title')
    {{ __('messages.prescriptions') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:prescription-table/>
        </div>
        @include('prescriptions.templates.templates')
        @include('prescriptions.show_modal')
        {{Form::hidden('prescriptionUrl',url('prescriptions'),['id'=>'indexPrescriptionUrl'])}}
        {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexPrescriptionDoctorUrl'])}}
        {{Form::hidden('patientUrl',route('patients.index'),['id'=>'indexPrescriptionPatientUrl'])}}
        {{ Form::hidden('prescriptions.show.modal', url('prescriptions-show-modal'), ['id' => 'prescriptionShowModal']) }}
        {{ Form::hidden('Prescription', __('messages.prescription.prescription'), ['id' => 'Prescription']) }}
    </div>
@endsection
@section('scripts')
    {{--    assets/js/prescriptions/prescriptions.js --}}
    {{--    assets/js/prescriptions/create-edit.js --}}
@endsection
