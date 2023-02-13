@extends('layouts.app')
@section('title')
    {{ __('messages.radiology_category.radiology_categories') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('radiologyCategoryCreateUrl', route('radiology.category.store'), ['id' => 'createRadiologyCategoryURL']) }}
            {{ Form::hidden('radiologyCategoryUrl', url('radiology-categories'), ['id' => 'radiologyCategoryURL']) }}
            {{ Form::hidden('radiology_category', __('messages.radiology_categories'), ['id' => 'radiologyCategory']) }}
            <livewire:radiology-categories-table/>
            @include('radiology_categories.modal')
            @include('radiology_categories.edit_modal')
            @include('radiology_categories.templates.templates')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/radiology_categories/radiology_categories.js --}}
