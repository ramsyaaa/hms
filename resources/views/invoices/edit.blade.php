@extends('layouts.app')
@section('title')
    {{ __('messages.invoice.edit_invoice') }}
@endsection
@section('page_css')
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
                    <div class="alert alert-danger d-none hide" id="editInvoicesErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::model($invoice, ['route' => ['invoices.update', $invoice->id], 'class' => 'invoiceForm']) }}
                    @include('invoices.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    {{Form::hidden('invoiceSaveUrl',route('invoices.update', ['invoice' => $invoice->id]),['id'=>'editInvoiceSaveUrl','class'=>'invoiceSaveUrl'])}}
    {{Form::hidden('invoiceUrl',route('invoices.index'),['id'=>'editInvoiceUrl','class'=>'invoiceUrl'])}}
    {{Form::hidden('patients',json_encode($patients),['id'=>'editInvoicePatients','class'=>'invoicePatients'])}}
    {{Form::hidden('accounts',json_encode($associateAccounts),['id'=>'editInvoiceAccounts','class'=>'invoiceAccounts'])}}
    {{Form::hidden('uniqueId',$invoice->invoiceItems->count() + 1,['id'=>'editInvoiceUniqueId','class'=>'uniqueId'])}}

    @include('invoices.templates.templates')
@endsection
@section('page_scripts')
{{--    assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--    assets/js/custom/input_price_format.js --}}
    {{--    assets/js/invoices/new.js --}}
@endsection
