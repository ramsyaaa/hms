@extends('layouts.app')
@section('title')
    {{ __('messages.doctors') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexDoctorUrl'])}}
            {{ Form::hidden('doctors', __('messages.patient_admission.doctor'), ['id' => 'Doctor']) }}
            <livewire:doctor-table/>
        </div>
        @include('doctors.templates.templates')
        @include('partials.page.templates.templates')
    </div>
@endsection
{{--  JS File :- assets/js/doctors/doctors.js --}}
