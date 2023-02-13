@extends('layouts.app')
@section('title')
    {{ __('messages.birth_report.birth_reports') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('birthReportUrl',url('birth-reports'),['class'=>'birthReportUrl'])}}
            {{Form::hidden('birthReportCreateUrl',route('birth-reports.store'),['id'=>'indexBirthReportCreateUrl'])}}
            {{Form::hidden('patientUrl',url('patients'),['id'=>'indexBirthReportPatientUrl'])}}
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexBirthReportDoctorUrl'])}}
            {{Form::hidden('caseUrl',url('patient-cases'),['id'=>'indexBirthReportCaseUrl'])}}
            {{ Form::hidden('birth_report', __('messages.birth_report.birth_report'), ['id' => 'birthReport']) }}
            <livewire:birth-report-table/>
            @include('birth_reports.templates.templates')
            @include('birth_reports.create_modal')
            @include('birth_reports.edit_modal')
        </div>
    </div>
@endsection
{{-- 
    JS File :- assets/js/birth_reports/birth_reports.js
               assets/js/birth_reports/create-edit.js
 --}}

