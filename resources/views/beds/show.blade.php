@extends('layouts.app')
@section('title')
    {{ __('messages.bed.bed_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.bed.bed_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                @if (!Auth::user()->hasRole('Doctor|Receptionist'))
                    <a class="btn btn-primary bed-edit-btn"
                       data-id="{{ $bed->id }}">{{ __('messages.common.edit') }}</a>
                @endif
{{--                <a href="javascript:history.back(-1);"--}}
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
                @include('beds.show_fields')
            @include('beds.edit_modal')
        </div>
    </div>
    {{ Form::hidden('bedUrl', url('beds'), ['class' => 'bedUrl']) }}
    {{Form::Hidden('bedTypesUrl',url('beds'),['id'=>'bedTypesUrl'])}}
    {{Form::Hidden('bedDetailShowUrl',Request::fullUrl(),['id'=>'bedDetailShowUrl'])}}
@endsection
@section('page_scripts')
    {{--  assets/js/beds/beds_assigns_view_list.js --}}
@endsection
@section('scripts')
    {{--    assets/js/custom/input_price_format.js --}}
    {{--    assets/js/beds/beds-details-edit.js --}}
@endsection
