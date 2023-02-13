<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "//www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/img/logo.jpg') }}" type="image/png">
    <title>Invoice PDF</title>
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css"/>
    @if(getCurrentCurrency() == 'inr')
        <style>
            body {
                font-family: DejaVu Sans, sans-serif !important;
            }
        </style>
    @endif
</head>
<body>
<table width="100%">
    <tr>
        <td class="header-left">
            <div class="main-heading">{{ __('messages.invoice.invoice') }}</div>
            <div class="invoice-number font-color-gray">{{ __('messages.invoice.invoice_id') }}
                #{{ $invoice->invoice_id }}</div>
        </td>
        <td class="header-right">
            <div class="logo"><img width="100px" src="{{ $setting['app_logo'] }}" alt=""></div>
            <div class="hospital-name">{{ $setting['app_name'] }}</div>
            <div class="hospital-name font-color-gray">{{ $setting['hospital_address'] }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="address" width="100%">
                <tr>
                    <td>
                        <table class="patient-detail-one">
                            <tr>
                                <td class="text-left">
                                    <span class="font-weight-bold ">{{ __('messages.advanced_payment.patient') }}</span>: {{ $invoice->patient->patientUser->full_name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-weight-bold ">{{ __('messages.common.address') }}</span>
                                    @if(!empty($invoice->patient->address->address1) || !empty($invoice->patient->address->address2)
                                    || !empty($invoice->patient->address->city) || !empty($invoice->patient->address->zip))
                                        @if(!empty($invoice->patient->address->address1))
                                            <br><span>{{ $invoice->patient->address->address1 }}</span>
                                        @endif
                                        @if(!empty($invoice->patient->address->address2))
                                            @if(!empty($invoice->patient->address->address1)){{','}}@endif
                                            <span><br>{{ trim($invoice->patient->address->address2) }}</span>
                                        @elseif(empty($invoice->patient->address->address2) && !empty($invoice->patient->address->address1)){{','}}
                                        @endif
                                        @if(!empty($invoice->patient->address->city))
                                            @if(!empty($invoice->patient->address->address2)){{','}}@endif
                                            <span>
                                                <br>{{ $invoice->patient->address->city }}
                                            </span>
                                        @elseif(empty($invoice->patient->address->city) && !empty($invoice->patient->address->address2))
                                            {{','}}<br>
                                        @endif
                                        @if(!empty($invoice->patient->address->zip))
                                            @if(!empty($invoice->patient->address->address2)){{' '}}@endif
                                            <span>
                                                {{ $invoice->patient->address->zip }}
                                            </span>
                                        @endif
                                    @else
                                        {{ __('messages.common.n/a') }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="header-right">
                        <table class="patient-detail-two header-right">
                            <tr>
                                <td style="margin-left: auto;display: block;">
                                    <span class="font-weight-bold ">{{ __('messages.invoice.invoice_date') }}</span>: {{ $invoice->invoice_date->format('jS M, Y') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="invoice-items">
                    <td colspan="2">
                        <table class="items-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.account.account') }}</th>
                                <th>{{ __('messages.invoice.description') }}</th>
                                <th class="number-align">{{ __('messages.invoice.qty') }}</th>
                                <th class="number-align">{{ __('messages.invoice.price') }}
                                    (<b>{{$currencySymbol}}</b>)
                                </th>
                                <th class="number-align">{{ __('messages.invoice.amount') }}
                                    (<b>{{$currencySymbol}}</b>)
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($invoice) && !empty($invoice))
                                @foreach($invoice->invoiceItems as $key => $invoiceItems)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $invoiceItems->account->name }}</td>
                                        <td>{!! nl2br(e($invoiceItems->description)) !!}</td>
                                        <td class="number-align">{{ $invoiceItems->quantity }}</td>
                                        <td class="number-align">
                                            {{ checkValidCurrency($invoice->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($invoiceItems->price, strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) :
                                number_format($invoiceItems->price) . '' . ($invoice->currency_symbol ? getSymbols($invoice->currency_symbol) : getCurrencySymbol()) }}
                                        </td>
                                        <td class="number-align">
                                            {{ checkValidCurrency($invoice->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($invoiceItems->total, strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) :
                               number_format($invoiceItems->total) . '' . ($invoice->currency_symbol ? getSymbols($invoice->currency_symbol) : getCurrencySymbol()) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table class="invoice-footer">
    <tbody>
    <tr>
        <td class="font-weight-bold">{{ __('messages.invoice.sub_total') }}:</td>
        <td>
            {{ checkValidCurrency($invoice->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($invoice->amount, strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) :
       number_format($invoice->amount) . '' . ($invoice->currency_symbol ? getSymbols($invoice->currency_symbol) : getCurrencySymbol()) }}
            {{--                                    <b>{{$currencySymbol}} </b> {{ number_format($invoice->amount, 2) }}--}}
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">{{ __('messages.invoice.discount') }}:</td>
        <td>
            {{ checkValidCurrency($invoice->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($invoice->amount * $invoice->discount / 100, strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) : number_format($invoice->amount * $invoice->discount / 100, 2) . '' . ($invoice->currency_symbol ? getSymbols($invoice->currency_symbol) : getCurrencySymbol()) }}
            ({{$invoice->discount}}<span style="font-family: DejaVu Sans">&#37;</span>)
            {{--                                    <b>{{$currencySymbol}} </b> {{ number_format(($invoice->amount * $invoice->discount / 100),2) }}--}}
            {{--                                    ({{ $invoice->discount }}--}}
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">{{ __('messages.invoice.total') }}:</td>
        <td>
            {{--                                    <b>{{$currencySymbol}} </b> {{ number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100), 2) }}--}}
            {{ checkValidCurrency($invoice->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($invoice->amount - ($invoice->amount * $invoice->discount / 100), strtoupper($invoice->currency_symbol ?? getCurrentCurrency())) :
       number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100), 2) . '' . ($invoice->currency_symbol ? getSymbols($invoice->currency_symbol) : getCurrencySymbol()) }}
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>
