@extends('layouts.app')
@section('title')
    {{ __('messages.insurance.edit_insurance') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('insurances.index') }}"
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
                </div>
            </div>
            <div class="card">
                {{Form::hidden('insuranceSaveUrl',route('insurances.update', $insurance->id),['id'=>'editInsuranceSaveUrl','class'=>'insuranceSaveUrl'])}}
                {{Form::hidden('insuranceUrl',route('insurances.index'),['id'=>'editInsuranceUrl','class'=>'insuranceUrl'])}}
                {{Form::hidden('uniqueId',$diseases->count() + 1,['id'=>'editInsuranceUniqueId','class'=>'insuranceUniqueId'])}}
                {{Form::hidden('discount',$insurance->discount,['id'=>'editInsuranceDiscount','class'=>'insuranceDiscount'])}}
                <div class="card-body p-12">
                    {{ Form::model($insurance, ['id'=>'editInsuranceForm','class'=>'insuranceForm', 'method'=>'POST', 'route'=>['insurances.update', $insurance->id]]) }}

                    @include('insurances.fields')

                    {{ Form::close() }}
                </div>
            </div>
            @include('insurances.templates.templates')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/insurances/create-edit.js
               assets/js/custom/input_price_format.js
--}}
