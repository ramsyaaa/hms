@extends('layouts.app')
@section('title')
    {{ __('messages.blood_issues') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bloodIssueCreateUrl', route('blood-issues.store'), ['id' => 'bloodIssueCreateUrl']) }}
            {{ Form::hidden('bloodIssueUrl', route('blood-issues.index'), ['id' => 'bloodIssueUrl']) }}
            {{ Form::hidden('bloodGroupUrl', route('blood-issues.list'), ['id' => 'bloodGroupUrl']) }}
            {{ Form::hidden('doctorUrl', Auth::user()->hasRole('Lab Technician') ?  url('employee/doctor') :  url('doctors'), ['id' => 'doctorUrl']) }}
            {{ Form::hidden('isAdmin', Auth::user()->hasRole('Admin') ?  true :  false, ['id' => 'isAdmin']) }}
            {{ Form::hidden('patientUrl', url('patients'), ['id' => 'patientUrl']) }}
            {{ Form::hidden('blood_issue', __('messages.blood_issue.blood_issue'), ['id' => 'bloodIssue']) }}
            <livewire:blood-issue-table/>
            @include('blood_issues.add_modal')
            @include('blood_issues.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--    assets/js/blood_issues/blood_issues.js --}}
@endsection
