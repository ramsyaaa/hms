@extends('layouts.app')
@section('title')
    {{ __('messages.mail') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')  
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['class'=>'defaultDocumentImageUrl'])}}
                <div class="card-body">
                    {{ Form::open(['route' => 'mail.send', 'files' => 'true']) }}
                    @include('mail.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- JS File :-assets/js/mail/mail.js --}}
