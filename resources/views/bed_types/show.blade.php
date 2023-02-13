@extends('layouts.app')
@section('title')
    {{ __('messages.bed_type.bed_type_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{ __('messages.bed_type.bed_type_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary bed-type-edit-btn"
                   data-id="{{ $bedType->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            @include('bed_types.show_fields')
            @include('bed_types.edit_modal')
        </div>
    </div>
    {{Form::Hidden('bedTypesUrl',url('bed-types'),['id'=>'bedTypesUrl'])}}
    {{Form::Hidden('bedTypeShowUrl',Request::fullUrl(),['id'=>'bedTypeShowUrl'])}}
@endsection
@section('page_scripts')
    {{--    assets/js/bed_types/beds_view_list.js --}}
@endsection
@section('scripts')
    {{--   assets/js/bed_types/bed_types_details_edit.js--}}
@endsection
