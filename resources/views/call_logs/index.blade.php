@extends('layouts.app')
@section('title')
    {{ __('messages.call_logs') }}
@endsection
@section('page_css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">--}}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('callLogUrl', route('call_logs.index'), ['class' => 'callLogUrl']) }}
            {{ Form::hidden('utilsScript', asset('assets/js/int-tel/js/utils.min.js'), ['class' => 'utilsScript']) }}
            {{ Form::hidden('incoming', __('messages.call_log.incoming'), ['id' => 'incoming']) }}
            {{ Form::hidden('outgoing', __('messages.call_log.outgoing'), ['id' => 'outgoing']) }}
            {{ Form::hidden('callTypeIncoming', \App\Models\CallLog::INCOMING, ['id' => 'callTypeIncoming']) }}
            {{ Form::hidden('call_logs', __('messages.call_log.call_log'), ['id' => 'callLogs']) }}
            <livewire:call-log-table/>
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection
{{--   assets/js/call_logs/call_log.js --}}
