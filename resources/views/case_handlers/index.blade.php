@extends('layouts.app')
@section('title')
    {{ __('messages.case_handlers') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('caseHandlerUrl',url('case-handlers'),['id'=>'indexCaseHandlerUrl'])}}
            {{ Form::hidden('case_handler', __('messages.case_handler.case_handler'), ['id' => 'caseHandler']) }}
            <livewire:case-handler-table/>
            @include('case_handlers.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/case_handlers/case_handlers.js
--}}
