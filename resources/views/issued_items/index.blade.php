@extends('layouts.app')
@section('title')
    {{ __('messages.issued_item.issued_items') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('issuedItemUrl',url('issued-items'),['id'=>'indexIssuedItemUrl'])}}
            {{Form::hidden('returnIssuedItemUrl',url('return-issued-item'),['id'=>'indexReturnIssuedItemUrl'])}}
            {{ Form::hidden('issued_item', __('messages.issued_item.issued_item'), ['id' => 'issuedItem']) }}
            <livewire:issued-item-table/>
            @include('issued_items.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{-- assets/js/issued_items/issued_items.js --}}
@endsection
