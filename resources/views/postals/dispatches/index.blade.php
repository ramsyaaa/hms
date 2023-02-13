@extends('layouts.app')
@section('title')
    {{ __('messages.postal_dispatch') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('add_postal_dispatch_modal','#add_postal_dispatch_modal',['class'=>'add_modal'])}}
            {{Form::hidden('edit_postal_dispatch_modal','#edit_postal_dispatch_modal',['class'=>'edit_modal'])}}

            {{ Form::hidden('postalUrl', route('dispatches.index'), ['class' => 'postalUrl']) }}
            {{ Form::hidden('ispostal', \App\Models\Postal::POSTAL_DISPATCH, ['class' => 'isPostal']) }}
            {{ Form::hidden('name', __('messages.postal.dispatch'), ['class' => 'name']) }}
            {{ Form::hidden('postalCreateUrl', route('dispatches.store'), ['class' => 'postalCreateUrl']) }}
            {{ Form::hidden('defaultDocumentImageUrl', asset('assets/img/default_image.jpg'), ['class' => 'defaultDocumentImageUrl']) }}
            {{ Form::hidden('download', __('messages.expense.download'), ['class' => 'download']) }}
            {{ Form::hidden('documentError', __('messages.expense.document_error'), ['class' => 'documentError']) }}
            {{ Form::hidden('tableName', '#dispatchesTable', ['class' => 'tableName']) }}
            {{ Form::hidden('hiddenId', '#editDispatchId', ['class' => 'hiddenId']) }}
            <livewire:postal-dispaych-table/>
            @include('postals.dispatches.add_modal')
            @include('postals.dispatches.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{-- assets/js/postals/postal.js --}}
@endsection
