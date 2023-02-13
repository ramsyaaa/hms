@extends('layouts.app')
@section('title')
    {{ __('messages.ambulance_call.ambulance_calls') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('ambulanceCallUrl',url('ambulance-calls'),['id'=>'showAmbulanceCallUrl'])}}
            {{Form::hidden('patientUrl',url('patients'),['id'=>'showCallPatientUrl'])}}
            {{ Form::hidden('ambulance_calls', __('messages.ambulance_call.ambulance_call'), ['id' => 'ambulanceCalls']) }}
            <livewire:ambulance-call-table/>
            @include('ambulance_calls.templates.templates')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/custom/input_price_format.js
               assets/js/ambulance_call/ambulance_calls.js
--}}

