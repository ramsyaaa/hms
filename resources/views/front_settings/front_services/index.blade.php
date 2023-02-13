@extends('layouts.app')
@section('title')
    {{ __('messages.front_cms_services') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('defaultDocumentImageUrl',asset('web_front/images/services/medicine.png'),['id'=>'indexServiceDefaultDocumentImageUrl'])}}
            {{Form::hidden('fontServicesCreateUrl',route('front.cms.services.store'),['id'=>'indexFrontServicesCreateUrl'])}}
            {{Form::hidden('fontServicesUrl',route('front.cms.services.index'),['id'=>'indexFrontServicesUrl'])}}
            {{ Form::hidden('front_service', __('messages.package.service'), ['id' => 'frontService']) }}
            <livewire:front-cms-service-table/>@include('front_settings.front_services.add_modal')
            @include('front_settings.front_services.edit_modal')
        </div>
    </div>
@endsection
@section('scripts')
    {{-- assets/js/front_settings/front_services/front_services.js --}}
@endsection
