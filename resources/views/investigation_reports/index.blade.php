@extends('layouts.app')
@section('title')
    {{ __('messages.investigation_report.investigation_reports') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('investigationReportUrl',url('investigation-reports'),['id'=>'indexInvestigationReportUrl'])}}
            {{ Form::hidden('investigation_report', __('messages.investigation_report.investigation_report'), ['id' => 'investigationReport']) }}
            <livewire:investigation-report-table/>
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/investigation_reports/investigation_reports.js --}}
