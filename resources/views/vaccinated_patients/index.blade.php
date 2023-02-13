@extends('layouts.app')
@section('title')
    {{ __('messages.vaccinated_patients') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('vaccinated_patients_store',route('vaccinated-patients.store'),['id'=>'vaccinatedPatientsStore'])}}
            {{Form::hidden('vaccinated_patients_index',route('vaccinated-patients.index'),['id'=>'vaccinatedPatientsIndex'])}}
            {{ Form::hidden('vaccinated_patient', __('messages.vaccinated_patient.vaccinated_patient'), ['id' => 'vaccinatedPatient']) }}
            {{Form::hidden('patient_Url',url('patients'),['id'=>'patientUrl'])}}
            <livewire:vaccinated-patients-table/>
                @include('vaccinated_patients.add_modal')
                @include('vaccinated_patients.edit_modal')
                @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection

{{--JS File :- assets/js/vaccinated_patients/vaccinated_patients.js--}}
