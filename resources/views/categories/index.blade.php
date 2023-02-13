@extends('layouts.app')
@section('title')
    {{ __('messages.medicine_categories') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        {{Form::hidden('categoryCreateUrl',route('categories.store'),['id'=>'indexCategoryCreateUrl'])}}
        {{Form::hidden('categoriesUrl',url('categories'),['id'=>'indexCategoriesUrl'])}}
        {{ Form::hidden('category', __('messages.charge.charge_category'), ['id' => 'Category']) }}

        <div class="d-flex flex-column">
            <livewire:medicine-category-table/>
        </div>
        @include('categories.modal')
        @include('categories.edit_modal')
        @include('categories.templates.templates')
        @include('partials.page.templates.templates')
    </div>
@endsection
{{--    assets/js/category/category.js --}}
