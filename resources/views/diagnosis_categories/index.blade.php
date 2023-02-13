@extends('layouts.app')
@section('title')
    {{ __('messages.diagnosis_category.diagnosis_categories') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/livewire-table.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('diagnosisCategoryCreateUrl', route('diagnosis.category.store'), ['id' => 'diagnosisCategoryCreateUrl']) }}
            {{ Form::hidden('diagnosisCategoryUrl', url('diagnosis-categories'), ['id' => 'diagnosisCategoryUrl']) }}
            {{ Form::hidden('diagnosis_category', __('messages.patient_diagnosis_test.diagnosis_category'), ['id' => 'diagnosisCategory']) }}
            <livewire:diagnosis-category-table/>
            @include('diagnosis_categories.modal')
            @include('diagnosis_categories.edit_modal')
        </div>
    </div>
@endsection
    {{--    assets/js/diagnosis_category/diagnosis_category.js --}}
