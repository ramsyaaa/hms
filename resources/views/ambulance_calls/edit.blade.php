@extends('layouts.app')
@section('title')
    {{ __('messages.ambulance_call.edit_ambulance_call') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('ambulance-calls.index') }}"
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
                {{Form::hidden('getDriverNameUrl',route('driver.name'),['class'=>'getDriverNameUrl'])}}
                <div class="card-body p-12">
                    {{ Form::model($ambulanceCall, ['route' => ['ambulance-calls.update', $ambulanceCall->id], 'method' => 'patch', 'id' => 'editAmbulanceCall']) }}

                    @include('ambulance_calls.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
{{--
    JS File :- assets/js/ambulance_call/create-edit.js
               assets/js/custom/input_price_format.js
--}}
