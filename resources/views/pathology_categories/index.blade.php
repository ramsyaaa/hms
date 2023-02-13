@extends('layouts.app')
@section('title')
    {{ __('messages.pathology_category.pathology_categories') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('pathologyCategoryCreateUrl', route('pathology.category.store'), ['id' => 'createPathologyCategoryURL']) }}
            {{ Form::hidden('pathologyCategoryUrl', url('pathology-categories'), ['id' => 'pathologyCategoryURL']) }}
            {{ Form::hidden('pathology_category', __('messages.pathology_categories'), ['id' => 'pathologyCategory']) }}
            <livewire:pathology-category-table/>
            @include('pathology_categories.modal')
            @include('pathology_categories.edit_modal')
            @include('pathology_categories.templates.templates')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/pathology_categories/pathology_categories.js --}}
