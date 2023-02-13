@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicine_category')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.medicine.medicine_category')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary category-edit-btn"
                   href="javascript:void(0)" data-id="{{ $category->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('categories.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                {{Form::hidden('categoriesShowUrl',Request::fullUrl(),['id'=>'categoriesShowUrl'])}}
                {{Form::hidden('indexCategoriesUrl',url('categories'),['id'=>'indexCategoriesUrl'])}}
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            @include('categories.show_fields')
            @include('categories.edit_modal')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/category/category-details-edit.js --}}
