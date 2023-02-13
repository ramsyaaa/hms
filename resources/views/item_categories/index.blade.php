@extends('layouts.app')
@section('title')
    {{ __('messages.item_category.item_categories') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('itemCategoryCreateUrl',route('item-categories.store'),['id'=>'indexItemCategoryCreateUrl'])}}
            {{Form::hidden('itemCategoriesUrl',url('item-categories'),['id'=>'indexItemCategoriesUrl'])}}
            {{ Form::hidden('item_category', __('messages.item_category.item_category'), ['id' => 'localItemCategory']) }}
            <livewire:item-category-table/>
            @include('item_categories.modal')
            @include('item_categories.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--   assets/js/item_categories/item_categories.js --}}
@endsection
