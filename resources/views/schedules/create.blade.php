@extends('layouts.app')
@section('title')
    {{ __('messages.schedule.new') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('schedules.index') }}"
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
                    @include('flash::message')
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{Form::hidden('hospitalSchedule',json_encode($data['hospitalSchedule']),['id'=>'createHospitalSchedule','class'=>'hospitalSchedule'])}}

                    {{ Form::open(['route' => 'schedules.store', 'files' => 'true', 'id' => 'createScheduleForm','class'=>'scheduleForm']) }}
                    @include('schedules.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--  assets/js/schedules/create-edit.js --}}
@endsection
