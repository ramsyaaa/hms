@extends('layouts.app')
@section('title')
    {{ __('messages.notice_boards') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('noticeBoardUrl',url('notice-boards'),['id'=>'indexNoticeBoardUrl'])}}
            {{Form::hidden('noticeBoardCreateUrl',route('notice-boards.store'),['id'=>'indexNoticeBoardCreateUrl'])}}
            {{ Form::hidden('notice_board', __('messages.notice_board.notice_board'), ['id' => 'noticeBoard']) }}
            <livewire:notice-board-table/>
            @include('notice_boards.create_modal')
            @include('notice_boards.edit_modal')
            @include('notice_boards.show_modal')
            @include('notice_boards.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/notice_boards/notice_boards.js --}}
    {{--  assets/js/notice_boards/create-edit.js --}}
@endsection
