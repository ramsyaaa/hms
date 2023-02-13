@extends('layouts.app')
@section('title')
    {{ __('messages.doctors') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:doctor-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/employee/doctors.js --}}
