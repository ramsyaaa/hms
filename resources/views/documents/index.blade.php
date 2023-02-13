@extends('layouts.app')
@section('title')
    {{ __('messages.documents') }}
@endsection
@section('content')
{{--    @include('flash::message')--}}
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            {{Form::hidden('documentsCreateUrl',route('documents.store'),['id'=>'indexDocumentsCreateUrl','class'=>'documentsCreateUrl'])}}
            {{Form::hidden('documentsUrl',route('documents.index'),['id'=>'indexDocumentsUrl','class'=>'documentsUrl'])}}
            {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'indexDefaultDocumentImageUrl','class'=>'defaultDocumentImageUrl'])}}
            {{Form::hidden('downloadDocumentUrl',url('document-download'),['id'=>'indexDownloadDocumentUrl','class'=>'downloadDocumentUrl'])}}
            {{Form::hidden('patientUrl',route('patients.index'),['id'=>'indexPatientUrl','class'=>'patientUrl'])}}
            {{ Form::hidden('documents', __('messages.document.document'), ['id' => 'Documents']) }}
            <livewire:document-table/>
            @include('documents.add_modal')
            @include('documents.edit_modal')
        </div>
    </div>
@endsection
@section('scripts')
    {{--   assets/js/document/document.js --}}
    {{--   assets/js/custom/new-edit-modal-form.js --}}
@endsection
