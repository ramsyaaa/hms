@extends('layouts.app')
@section('title')
    {{ __('messages.document_types') }}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/livewire-table.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('docTypeCreateUrl',route('document-types.store'),['id'=>'indexDocTypeCreateUrl','class'=>'docTypeCreateUrl'])}}
            {{Form::hidden('docTypeUrl',route('document-types.index'),['id'=>'indexDocTypeUrl','class'=>'docTypeUrl'])}}
            {{ Form::hidden('document_type', __('messages.document.document_type'), ['id' => 'documentType']) }}
            <livewire:document-type-table/>
            @include('document_types.add_modal')
            @include('document_types.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection

@section('scripts')
    {{--    assets/js/document_type/doc_type.js --}}
    {{--    assets/js/custom/new-edit-modal-form.js --}}
@endsection

