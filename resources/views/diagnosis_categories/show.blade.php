@extends('layouts.app')
@section('title')
    {{ __('messages.diagnosis_category.diagnosis_category')}}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">--}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.diagnosis_category.diagnosis_category')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary diagnosis-category-edit-btn me-2"
                   data-id="{{ $diagnosisCategory->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('diagnosis.category.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            {{Form::Hidden('accountUrl',route('accounts.index'),['id'=>'indexAccountUrl'])}}
            {{Form::Hidden('accountShowUrl',Request::fullUrl(),['id'=>'accountShowUrl'])}}
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('diagnosis_categories.show_fields')
            </div>
            @include('diagnosis_categories.edit_modal')
            {{ Form::hidden('diagnosisCategoryUrl', url('diagnosis-categories'), ['id' => 'diagnosisCategoryUrl']) }}
            {{ Form::hidden('diagnosisCategoryShowUrl', Request::fullUrl(),   ['id' => 'diagnosisCategoryShowUrl']) }}
        </div>
    </div>  
@endsection
    {{--   assets/js/diagnosis_category/diagnosis_category-details-edit.js --}}
