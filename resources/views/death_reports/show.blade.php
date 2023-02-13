@extends('layouts.app')
@section('title')
    {{ __('messages.death_report.death_report_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            @include('layouts.errors')
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary edit-btn me-2"
                   href="javascript:void(0)" data-id="{{ $deathReport->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('death-reports.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                {{Form::hidden('deathReportUrl',url('death-reports'),['class'=>'deathReportUrl'])}}

                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('death_reports.show_fields')
        </div>
    </div>
    @include('death_reports.edit_modal')
@endsection

@section('scripts')
    {{--    JS :- 
                assets/js/death_reports/death_reports-details-edit.js --}}
@endsection
