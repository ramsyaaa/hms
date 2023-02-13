@extends('layouts.app')
@section('title')
    {{ __('messages.cases') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('casesUrl',url('patient-cases'),['id'=>'indexPatientCaseUrl'])}}
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexPatientCaseDoctorUrl'])}}
            {{Form::hidden('patientUrl',url('patients'),['id'=>'indexCasePatientUrl'])}}
            {{Form::hidden('userRole',Auth::user()->hasRole('Case Manager'),['id'=>'indexPatientCaseUserRole'])}}
            {{ Form::hidden('patient_case.show.modal', url('patient-cases-show-modal'), ['id' => 'patientCaseShowModal']) }}
            {{ Form::hidden('case-language', getCurrentLoginUserLanguageName(),['id' => 'caseLanguage']) }}
            {{ Form::hidden('patient_case_active', __('messages.common.active'), ['id' => 'patientCaseActive']) }}
            {{ Form::hidden('patient_case_de_active', __('messages.common.de_active'), ['id' => 'patientCaseDeActive']) }}
            <livewire:case-table/>
            @include('partials.page.templates.templates')
            @include('patient_cases.show_modal')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/custom/input_price_format.js
               assets/js/patient_cases/patient_cases.js
--}}
