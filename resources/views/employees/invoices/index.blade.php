@extends('layouts.app')
@section('title')
    {{ __('messages.invoice.invoices') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:invoice-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/employee/invoice.js --}}
