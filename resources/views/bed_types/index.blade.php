@extends('layouts.app')
@section('title')
    {{ __('messages.bed_type.bed_types') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('bedTypesCreateUrl', route('bed-types.store'), ['id' => 'bedTypesCreateUrl']) }}
            {{ Form::hidden('bedTypesUrl', url('bed-types'), ['id' => 'bedTypesUrl']) }}
            {{ Form::hidden('bed_type', __('messages.bed.bed_type'), ['id' => 'bedType']) }}
            <livewire:bed-type-table/>
            {{--            @include('accountants.table')--}}
            @include('bed_types.modal')
            @include('bed_types.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/bed_types/bed_types.js--}}
@endsection
