@extends('layouts.app')
@section('title')
    {{ __('messages.vaccinations') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('vaccinationCreateUrl',route('vaccinations.store'),['id'=>'vaccination_createUrl'])}}
            {{Form::hidden('vaccinationUrl',route('vaccinations.index'),['id'=>'vaccination_url'])}}
            {{ Form::hidden('vaccination', __('messages.vaccination.vaccinations'), ['id' => 'Vaccination']) }}
                <livewire:vaccination-table/>
                @include('vaccinations.add_modal')
                @include('vaccinations.edit_modal')
                @include('partials.modal.templates.templates')
        </div>
@endsection

{{--JS File :- assets/js/vaccinations/vaccinations.js--}}
