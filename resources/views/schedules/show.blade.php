@extends('layouts.app')
@section('title')
    {{ __('messages.schedule.details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.schedule.details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary me-2"
                   href="{{ route('schedules.edit',['schedule' => $schedule->id])}}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('schedules.index') }}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
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
            @include('schedules.show_fields')
        </div>
    </div>
@endsection
