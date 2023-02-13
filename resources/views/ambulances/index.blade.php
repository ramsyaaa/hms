@extends('layouts.app')
@section('title')
    {{ __('messages.ambulances') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('ambulanceUrl',url('ambulances'),['id'=>'indexAmbulanceUrl'])}}
            {{ Form::hidden('ambulance', __('messages.ambulance.ambulance'), ['id' => 'Ambulance']) }}
            <livewire:ambulance-table/>
            @include('ambulances.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/ambulances/ambulances.js --}}

