@extends('layouts.app')
@section('title')
    {{ __('messages.notice_boards') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('noticeBoardUrl',url('employee/notice-board'),['id'=>'indexNoticeBoardUrl'])}}
            {{Form::hidden('noticeBoardShowUrl',url('employee/notice-board'),['id'=>'employeeNoticeBoardShowUrl'])}}
            <livewire:notice-board-table/>
        </div>
        @include('employees.notice_boards.templates.templates')
        @include('employees.notice_boards.show_modal')
    </div>
@endsection
{{-- JS File :- assets/js/employee/notice_boards.js --}}
