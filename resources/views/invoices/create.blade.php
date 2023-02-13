@extends('layouts.app')
@section('title')
    {{ __('messages.invoice.new_invoice') }}
@endsection
@section('page_css')
{{--    <link href="{{ asset('assets/css/jquery.toast.min.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{ asset('assets/css/bill.css') }}" rel="stylesheet" type="text/css"/>--}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('invoices.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    <div class="alert alert-danger d-none hide" id="invoicesErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'invoices.store', 'class' => 'invoiceForm', 'name' => 'invoiceForm']) }}
                    @include('invoices.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    {{Form::hidden('invoiceSaveUrl',route('invoices.store'),['id'=>'createInvoiceSaveUrl','class'=>'invoiceSaveUrl'])}}
    {{Form::hidden('invoiceUrl',route('invoices.index'),['id'=>'createInvoiceUrl','class'=>'invoiceUrl'])}}
    {{Form::hidden('patients',json_encode($patients),['id'=>'createInvoicePatients','class'=>'invoicePatients'])}}
    {{Form::hidden('accounts',json_encode($associateAccounts),['id'=>'createInvoiceAccounts','class'=>'invoiceAccounts'])}}
    {{Form::hidden('uniqueId',2,['id'=>'createInvoiceUniqueId','class'=>'uniqueId'])}}

    @include('invoices.templates.templates')
@endsection
@section('page_scripts')
    {{--  assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--  assets/js/custom/input_price_format.js --}}
    {{--  assets/js/invoices/new.js --}}
@endsection
