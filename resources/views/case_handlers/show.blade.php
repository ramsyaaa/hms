@extends('layouts.app')
@section('title')
    {{ __('messages.case_handler.case_handler_detail') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary edit-btn me-2"
                   href="{{ url('case-handlers/'.$caseHandler->id.'/edit') }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('case-handlers.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('case_handlers.show_fields')
        </div>
    </div>
@endsection
