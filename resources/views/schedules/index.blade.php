@extends('layouts.app')
@section('title')
    {{ __('messages.schedules') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('scheduleUrl',url('schedules'),['id'=>'indexScheduleUrl'])}}
            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexScheduleDoctorUrl'])}}
            {{ Form::hidden('schedule', __('messages.schedule_label'), ['id' => 'Schedule']) }}
            <livewire:schedule-table/>
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/schedules/schedules.js --}}
