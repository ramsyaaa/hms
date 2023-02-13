@extends('layouts.app')
@section('title')
    {{ __('messages.insurance.insurances') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('insuranceUrl',url('insurances'),['id'=>'indexInsuranceUrl'])}}
            {{ Form::hidden('insurance', __('messages.insurance.insurance'), ['id' => 'Insurance']) }}
            <livewire:insurance-table/>
        </div>
    </div>
@endsection
{{-- 
        JS File :- assets/js/insurances/insurances.js
                   assets/js/custom/input_price_format.js 
--}}
