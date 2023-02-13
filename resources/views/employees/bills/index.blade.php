@extends('layouts.app')
@section('title')
    {{ __('messages.bill.bills') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            @include('flash::message')
            <livewire:bill-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/employee/bill.js --}}
