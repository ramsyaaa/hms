@extends('layouts.app')
@section('title')
    {{ __('messages.services') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('serviceReportUrl',url('services'),['id'=>'showServiceReportUrl'])}}
            {{ Form::hidden('service', __('messages.package.service'), ['id' => 'Service']) }}
            <livewire:service-table/>
            @include('services.templates.templates')
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/custom/input_price_format.js
               assets/js/services/services.js
--}}
