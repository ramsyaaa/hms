@extends('layouts.app')
@section('title')
    {{ __('messages.patient_admissions') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('patientAdmissionsUrl',url('patient-admissions'),['id'=>'indexPatientAdmissionsUrl'])}}
            {{Form::hidden('patientUrl',url('patients'),['id'=>'admissionPatientUrl'])}}
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'admissionDoctorUrl'])}}
            {{Form::hidden('packageUrl',url('packages'),['id'=>'admissionPackageUrl'])}}
            {{Form::hidden('insuranceUrl',url('packages'),['id'=>'admissionInsuranceUrl'])}}
            {{Form::hidden('userRole', Auth()->user()->hasRole('Case Manager')?true:false ,['id'=>'admissionUserRole'])}}
            {{ Form::hidden('patient-admissions.show.modal', url('patient-admissions-show'), ['id' => 'patientAdmissionsShowModal']) }}
            {{ Form::hidden('case-language', getCurrentLoginUserLanguageName(),['id' => 'patientAdmissionDate']) }}
            {{ Form::hidden('patient_admission_active', __('messages.common.active'), ['id' => 'patientAdmissionActive']) }}
            {{ Form::hidden('patient_admission_de_active', __('messages.common.de_active'), ['id' => 'patientAdmissionDeActive']) }}
            {{ Form::hidden('patient_admission', __('messages.patient_admission.patient_admission'), ['id' => 'patientAdmission']) }}
            <livewire:patient-admission-table/>
            @include('partials.page.templates.templates')
            @include('patient_admissions.show_modal')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/patient_admissions/patient_admission.js --}}
