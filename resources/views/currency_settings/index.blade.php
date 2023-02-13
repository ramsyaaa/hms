@extends('layouts.app')
@section('title')
    {{ __('messages.currency_setting') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        {{Form::hidden('currencyCreateUrl',route('currency-settings.store'),['id'=>'indexCurrencyCreateUrl'])}}
        {{Form::hidden('currenciesUrl',url('currency-settings'),['id'=>'indexCurrenciesUrl'])}}
        {{ Form::hidden('category', __('messages.charge.charge_category'), ['id' => 'Category']) }}
        {{ Form::hidden('currency', __('messages.currency.currency'), ['id' => 'Currency']) }}

        <div class="d-flex flex-column">
            <livewire:currency-table/>
        </div>
        @include('currency_settings.modal')
        @include('currency_settings.edit_modal')
{{--        @include('categories.templates.templates')--}}
{{--        @include('partials.page.templates.templates')--}}
    </div>
@endsection

