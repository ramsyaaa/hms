@extends('layouts.app')
@section('title')
    {{ __('messages.nurses') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('nurseUrl', url('nurses'), ['id' => 'nurseURL']) }}
            {{ Form::hidden('nurse', __('messages.nurse.nurse'), ['id' => 'Nurse']) }}
            <livewire:nurse-table/>
            @include('nurses.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection

@section('scripts')
    {{--  assets/js/nurses/nurses.js--}}
@endsection

