@extends('layouts.app')
@section('title')
    {{ __('messages.charge.charge_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary charge-edit-btn"
                   data-id="{{ $charge->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('charges.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                {{ Form::hidden('chargeUrl', url('charges'), ['class' => 'chargesURl']) }}
                {{ Form::hidden('changeChargeTypeUrl', url('get-charge-categories'), ['class' => 'changeChargeTypeURL']) }}
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            @include('charges.show_fields')
        </div>
    </div>
    @include('charges.edit_modal')
    {{Form::Hidden('chargesURl',url('charges'),['id'=>'chargesURl','class'=>'chargesURl'])}}
    {{Form::Hidden('chargeDetailShowUrl',Request::fullUrl(),['id'=>'chargeDetailShowUrl'])}}
@endsection
{{--  assets/js/charges/create-details-edit.js --}}
