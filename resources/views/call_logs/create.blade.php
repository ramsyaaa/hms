@extends('layouts.app')
@section('title')
    {{ __('messages.call_log.new') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">--}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('call_logs.index') }}"
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
                {{ Form::hidden('callLogUrl', route('call_logs.index'), ['class' => 'callLogUrl']) }}
                {{ Form::hidden('utilsScript', asset('assets/js/int-tel/js/utils.min.js'), ['class' => 'utilsScript']) }}
                {{ Form::hidden('isEdit', false, ['class' => 'isEdit']) }}
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'call_logs.store','id' => 'createCallLogForm']) }}

                    @include('call_logs.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
    {{--     assets/js/call_logs/create-edit.js --}}
    {{--     assets/js/custom/phone-number-country-code.js --}}
