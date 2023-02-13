@extends('layouts.app')
@section('title')
    {{ __('messages.hospital_schedule') }}
@endsection
@section('css')
    <link rel="stylesheet" href="*/{{ asset('assets/css/sub-header.css') }}">
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
                    {{ Form::hidden('save-hospital-schedule', route('checkRecord'), ['id' => 'saveHospitalScheduleUrl']) }}
                    {{ Form::open(['route' => 'hospital-schedules.store', 'method' => 'POST']) }}
                    @include('hospital_schedule.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- JS File :-assets/js/hospital_schedule/create-edit.js' --}}
@section('page_scripts')
{{--    assets/js/hospital_schedule/create-edit.js --}}
@endsection

