@extends('layouts.app')
@section('title')
    {{ __('messages.package.packages') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('packageReportUrl',url('packages'),['id'=>'showPackageReportUrl'])}}
            {{ Form::hidden('packages', __('messages.package.package'), ['id' => 'Packages']) }}
            <livewire:package-table/>
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/custom/input_price_format.js
               assets/js/packages/packages.js
--}}
