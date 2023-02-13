@extends('layouts.app')
@section('title')
    {{ __('messages.investigation_report.new_investigation_report') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('investigation-reports.index') }}"
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
                    {{ Form::open(['route' => 'investigation-reports.store', 'files' => 'true', 'id' => 'createInvestigationForm']) }}

                    @include('investigation_reports.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/investigation_reports/create-edit.js --}}
