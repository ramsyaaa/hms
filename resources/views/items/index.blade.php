@extends('layouts.app')
@section('title')
    {{ __('messages.item.items') }}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('itemUrl',url('items'),['id'=>'indexItemUrl'])}}
            {{ Form::hidden('items', __('messages.item.item'), ['id' => 'Items']) }}
            <livewire:item-table/>
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/items/items.js --}}
    {{--  assets/js/custom/delete.js --}}
@endsection
