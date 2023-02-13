@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicine_brands')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.medicine.medicine_brands_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary edit-btn"
                   href="{{ route('brands.edit',['brand' => $brand->id])}}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('brands.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('brands.show_fields')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/brands/medicine_brands_list.js --}}
