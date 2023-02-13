@extends('layouts.app')
@section('title')
    {{ __('messages.charges') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('chargeCategoryUrl', url('charge-categories'), ['id' => 'chargesCategoryURl']) }}
            {{ Form::hidden('chargeUrl', url('charges'), ['class' => 'chargesURl']) }}
            {{ Form::hidden('chargeCreateUrl', route('charges.store'), ['id' => 'createChargesURL']) }}
            {{ Form::hidden('changeChargeTypeUrl', url('get-charge-categories'), ['class' => 'changeChargeTypeURL']) }}
            {{ Form::hidden('charges', __('messages.bed.charge'), ['id' => 'Charges']) }}
            <livewire:charge-table/>
            @include('charges.create_modal')
            @include('charges.edit_modal')
        </div>
    </div>
@endsection
{{--   assets/js/custom/input_price_format.js --}}
{{--   assets/js/charges/charges.js --}}
{{--   assets/js/charges/create-edit.js --}}

