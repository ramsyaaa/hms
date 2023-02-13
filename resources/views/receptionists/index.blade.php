@extends('layouts.app')
@section('title')
    {{__('messages.receptionist.receptionists')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('receptionistUrl', url('receptionists'), ['id' => 'receptionistUrl']) }}
            {{ Form::hidden('receptionist', __('messages.receptionist.receptionist'), ['id' => 'Receptionist']) }}
            <livewire:receptionist-table/>
            @include('receptionists.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/receptionists/receptionists.js --}}
