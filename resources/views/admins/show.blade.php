@extends('layouts.app')
@section('title')
    {{ __('messages.admins') }} {{ __('messages.common.detail') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                @if($admin->id != 1)
                    <a class="btn btn-primary edit-btn" href="{{ url('admins/'.$admin->id.'/edit') }}">
                        {{ __('messages.common.edit') }}
                    </a>
                @endif
                <a href="{{ route('admins.index') }}"
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
            @include('admins.show_fields')
        </div>
    </div>
@endsection
