@extends('layouts.app')
@section('title')
    {{ __('messages.operation_report.operation_reports') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('operationReportUrl',url('operation-reports'),['id'=>'operationReportUrl'])}}
            {{Form::hidden('operationReportCreateUrl',route('operation-reports.store'),['id'=>'operationReportCreateUrl'])}}
            {{ Form::hidden('operation_report', __('messages.operation_report.operation_report'), ['id' => 'operationReport']) }}
            <livewire:operation-report-table/>
            @include('operation_reports.templates.templates')
            @include('operation_reports.create_modal')
            @include('operation_reports.edit_modal')
        </div>
    </div>
@endsection
{{-- 
    JS File :- assets/js/operation_reports/operation_reports.js
               assets/js/operation_reports/create-edit.js
 --}}
