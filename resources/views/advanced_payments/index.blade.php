@extends('layouts.app')
@section('title')
    {{ __('messages.advanced_payment.advanced_payments') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <livewire:advanced-payment-table/>
        </div>
        @include('advanced_payments.create_modal')
        @include('advanced_payments.edit_modal')
        @include('partials.modal.templates.templates')
        {{Form::hidden('advancedPaymentUrl',url('advanced-payments'),['id'=>'indexAdvancedPaymentUrl','class'=>'advancedPaymentUrl'])}}
        {{Form::hidden('advancePaymentCreateUrl',route('advanced-payments.store'),['id'=>'indexAdvancePaymentCreateUrl','class'=>'advancePaymentCreateUrl'])}}
        {{Form::hidden('patientUrl',url('patients'),['id'=>'indexAdvancePaymentPatientUrl','class'=>'patientUrl'])}}
        {{ Form::hidden('advanced_payment', __('messages.advanced_payment.advanced_payment'), ['id' => 'advancedPayment']) }}

    </div>
@endsection
@section('scripts')
    {{--    assets/js/custom/input_price_format.js  --}}
    {{--    assets/js/advanced_payments/advanced_payments.js --}}
    {{--    assets/js/advanced_payments/create-edit.js --}}
@endsection
