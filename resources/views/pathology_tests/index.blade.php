@extends('layouts.app')
@section('title')
    {{ __('messages.pathology_tests') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('pathologyTestUrl', url('pathology-tests'), ['id' => 'pathologyTestURL']) }}
            {{ Form::hidden('pathology.test.show.modal', url('pathology-tests-show-modal'), ['id' => 'pathologyTestShowUrl']) }}
            {{ Form::hidden('pathology-test-language', getCurrentLoginUserLanguageName(),['id' => 'pathologyTestLanguage']) }}
            {{ Form::hidden('pathology_test', __('messages.pathology_test.pathology_tests'), ['id' => 'pathologyTest']) }}
            <livewire:pathology-tests-table/>
            @include('partials.page.templates.templates')
            @include('pathology_tests.show_modal')
        </div>
    </div>
@endsection
{{-- JS File :- assets/js/pathology_tests/pathology_tests.js --}}
