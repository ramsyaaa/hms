@extends('layouts.app')
@section('title')
    {{ __('messages.item_stock.item_stocks') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('itemStockUrl',url('item-stocks'),['id'=>'indexItemStockUrl'])}}
            {{Form::hidden('itemStockDownload',url('item-stocks-download'),['class'=>'indexItemStockDownload'])}}
            {{ Form::hidden('item_stock', __('messages.item_stock.item_stock'), ['id' => 'itemStock']) }}
            <livewire:item-stock-table/>
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/custom/input_price_format.js --}}
    {{--  assets/js/item_stocks/item_stocks.js --}}
@endsection
