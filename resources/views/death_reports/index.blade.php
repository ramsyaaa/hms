@extends('layouts.app')
@section('title')
    {{ __('messages.death_report.death_reports') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('deathReportUrl',url('death-reports'),['class'=>'deathReportUrl'])}}
            {{Form::hidden('deathReportCreateUrl',route('death-reports.store'),['id'=>'indexDeathReportCreateUrl'])}}
            {{Form::hidden('patientUrl',url('patients'),['id'=>'indexDeathReportPatientUrl'])}}
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexDeathReportDoctorUrl'])}}
            {{Form::hidden('caseUrl',url('patient-cases'),['id'=>'indexDeathReportCaseUrl'])}}
            {{ Form::hidden('death_report', __('messages.death_report.death_report'), ['id' => 'deathReport']) }}
            <livewire:death-report-table/>
            @include('death_reports.templates.templates')
            @include('death_reports.create_modal')
            @include('death_reports.edit_modal')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/death_reports/death_reports.js
               assets/js/death_reports/create-edit.js
--}}
