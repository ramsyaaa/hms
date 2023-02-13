@extends('layouts.app')
@section('title')
    {{ __('messages.prescriptions') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('accountantUrl', url('accountants'), ['id' => 'accountantURL']) }}
            <livewire:employee-prescriptions-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/employee_prescriptions/employee_prescriptions.js --}}
