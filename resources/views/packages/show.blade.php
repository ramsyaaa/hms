@extends('layouts.app')
@section('title')
    {{ __('messages.package.package_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                @if (!Auth::user()->hasRole('Doctor|Case Manager|Patient'))
                    <a class="btn btn-primary edit-btn"
                       href="{{ route('packages.edit',['package' => $package->id]) }}">{{ __('messages.common.edit') }}</a>
                @endif
                <a href="{{ url()->previous() }}"
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
                @include('packages.show_fields')
        </div>
    </div>
@endsection
