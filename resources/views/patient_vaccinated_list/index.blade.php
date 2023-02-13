@extends('layouts.app')
@section('title')
    {{ __('messages.vaccinated_patients') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:vaccinated-patients-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/vaccinated_patients/patient_vaccinated.js --}}
