@extends('layouts.app')
@section('title')
    {{ __('messages.opd_patients') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('opdPatientUrl',url('patient/my-opds'),['id'=>'indexOpdListPatientUrl'])}}
            <livewire:opd-patient-department-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/opd_patients_list/opd_patients.js --}}
