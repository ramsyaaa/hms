@extends('layouts.app')
@section('title')
    {{ __('messages.lab_technicians') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            {{ Form::hidden('labTechnicianUrl', url('lab-technicians'), ['id' => 'labTechnicianURL']) }}
            {{ Form::hidden('labtechnician', __('messages.lab_tech.lab_technician'), ['id' => 'labTechnician']) }}
            @include('flash::message')
            <livewire:lab-technician-table/>
        </div>
        @include('lab_technicians.templates.templates')
    </div>
@endsection
@section('scripts')
    {{--    assets/js/lab_technicians/lab_technicians.js --}}
@endsection
