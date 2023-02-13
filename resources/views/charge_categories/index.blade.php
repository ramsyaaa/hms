@extends('layouts.app')
@section('title')
    {{ __('messages.charge_category.charge_categories') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('chargeCategoryUrl', url('charge-categories'), ['class' => 'chargeCategoryURLID' , 'id' => 'chargeCategoryURLID']) }}
            {{ Form::hidden('chargeCategoryCreateUrl', route('charge-categories.store'), ['class' => 'chargeCategoryCreateURLID']) }}
            <livewire:charge-category-table/>
            {{ Form::hidden('charge-category', __('messages.radiology_test.charge_category'), ['id' => 'chargeCategory']) }}
            @include('charge_categories.create_modal')
            @include('charge_categories.edit_modal')
        </div>
    </div>
@endsection
    {{--     ssets/js/charge_categories/charge_categories.js -}}
    {{--     assets/js/charge_categories/create-edit.js --}}

