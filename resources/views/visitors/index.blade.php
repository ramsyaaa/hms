@extends('layouts.app')
@section('title')
    {{ __('messages.visitors') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{ Form::hidden('visitorUrl',true, ['id' => 'indexOfVisitor']) }}
            {{ Form::hidden('visitorUrl', route('visitors.index'), ['class' => 'visitorUrl']) }}
            {{ Form::hidden('downloadDocumentUrl', url('visitors-download'), ['class' => 'downloadDocumentUrl']) }}
            {{ Form::hidden('utilsScript', asset('assets/js/int-tel/js/utils.min.js'), ['class' => 'utilsScript']) }}
            {{ Form::hidden('isEdit', true, ['class' => 'isEdit']) }}
            {{ Form::hidden('visitor', __('messages.visitor.visitor'), ['id' => 'Visitor']) }}
            <livewire:visitor-table/>
            @include('partials.page.templates.templates')
        </div>
    </div>
@endsection

@section('scripts')
  
    {{--   assets/js/visitors/visitor.js --}}
@endsection
