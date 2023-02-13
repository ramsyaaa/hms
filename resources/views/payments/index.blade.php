@extends('layouts.app')
@section('title')
    {{ __('messages.payment.payments') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:payment-table/>
        </div>
        @include('payments.templates.templates')
        @include('payments.show_modal')
    </div>
    {{Form::hidden('paymentUrl',url('payments'),['id'=>'indexPaymentUrl','class'=>'paymentUrl'])}}
    {{ Form::hidden('payments.show.modal', url('payments-show-modal'), ['id' => 'paymentShowModal']) }}
    {{ Form::hidden('payment', __('messages.payment.payment'), ['id' => 'Payment']) }}

@endsection
@section('page_scripts')
    {{--  assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--   assets/js/custom/input_price_format.js --}}
    {{--   assets/js/payments/payments.js --}}
@endsection

