@extends('layouts.app')
@section('title')
    {{ __('messages.prescription.prescription_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('employee_prescription_list.show_fields')
            </div>
        </div>
    </div>
@endsection
