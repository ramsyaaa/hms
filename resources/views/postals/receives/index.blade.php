@extends('layouts.app')
@section('title')
    {{ __('messages.postal_receive') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('add_postal_receives_modal','#add_postal_receives_modal',['class'=>'add_modal'])}}
            {{Form::hidden('edit_postal_receives_modal','#edit_postal_receives_modal',['class'=>'edit_modal'])}}

            {{ Form::hidden('postalUrl', route('receives.index'), ['class' => 'postalUrl']) }}
            {{ Form::hidden('ispostal', \App\Models\Postal::POSTAL_RECEIVE, ['class' => 'isPostal']) }}
            {{ Form::hidden('name', __('messages.postal.receive'), ['class' => 'name']) }}
            {{ Form::hidden('postalCreateUrl', route('receives.store'), ['class' => 'postalCreateUrl']) }}
            {{ Form::hidden('defaultDocumentImageUrl', asset('assets/img/default_image.jpg'), ['class' => 'defaultDocumentImageUrl']) }}
            {{ Form::hidden('download', __('messages.expense.download'), ['class' => 'download']) }}
            {{ Form::hidden('documentError', __('messages.expense.document_error'), ['class' => 'documentError']) }}
            {{ Form::hidden('tableName', '#receivesTable', ['class' => 'tableName'] ) }}
            {{ Form::hidden('hiddenId', '#editReceiveId', ['class' => 'hiddenId']) }}
            <livewire:postal-receive-table/>
            @include('postals.receives.add_modal')
            @include('postals.receives.edit_modal')
            @include('partials.modal.templates.templates')
        </div>
@endsection
@section('scripts')
    {{--  assets/js/postals/postal.js --}}
@endsection
