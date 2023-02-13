@extends('layouts.app')
@section('title')
    {{ __('messages.call_log.edit') }}
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
                <div class="card-body p-12">
                    {{ Form::hidden('id', null,['id' => 'editCallLogId']) }}
                    {{ Form::hidden('isEdit', true, ['class' => 'isEdit']) }}
                    {{ Form::hidden('utilsScript', asset('assets/js/int-tel/js/utils.min.js'), ['class' => 'utilsScript']) }}
                    {{ Form::model($callLog, ['route' => ['call_logs.update', $callLog->id], 'method' => 'patch', 'id' => 'editCallLogForm']) }}
                    @include('call_logs.edit_field')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    {{--     assets/js/int-tel/js/intlTelInput.min.js --}}
    {{--     assets/js/int-tel/js/utils.min.js --}}
@endsection
@section('scripts')
    {{--  assets/js/call_logs/create-edit.js --}}
    {{--  assets/js/custom/phone-number-country-code.js --}}
@endsection
