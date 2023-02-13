@extends('layouts.app')
@section('title')
    {{ __('messages.document.document_detail') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary edit-btn"
                   href="javascript:void(0)" data-id="{{ $documents->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{route('documents.index')}}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('documents.show_fields')
        </div>
    </div>
    @include('documents.edit_modal')
    {{Form::hidden('documentsUrl',route('documents.index'),['id'=>'showDocumentsUrl','class'=>'documentsUrl'])}}
    {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'showDefaultDocumentImageUrl','class'=>'defaultDocumentImageUrl'])}}
@endsection
@section('scripts')
    {{--   assets/js/document/document-details-edit.js --}}
@endsection
