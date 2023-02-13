@extends('layouts.app')
@section('title')
    {{ __('messages.pharmacist.pharmacists') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('pharmacistUrl',url('pharmacists'),['id'=>'indexPharmacistUrl'])}}
            {{ Form::hidden('pharmacist', __('messages.pharmacist.pharmacists'), ['id' => 'Pharmacist']) }}
            <livewire:pharmacist-table/>
            @include('pharmacists.templates.templates')
        </div>
    </div>
@endsection
{{--  JS file :- assets/js/pharmacists/pharmacists.js  --}}
