@extends('layouts.app')
@section('title')
    {{ __('messages.my_payroll.my_payrolls') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:payroll-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/employee/my_payrolls.js --}}
