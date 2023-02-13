@extends('layouts.app')
@section('title')
    {{ __('messages.ipd_patient.ipd_patients') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            @include('layouts.errors')
            <livewire:ipd-patient-department-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/ipd_patients_list/ipd_patients.js --}}
