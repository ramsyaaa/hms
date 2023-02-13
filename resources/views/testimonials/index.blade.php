@extends('layouts.app')
@section('title')
    {{ __('messages.testimonials') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('testimonialUrl',route('testimonials.index'),['id'=>'indexTestimonialUrl'])}}
            {{Form::hidden('testimonialCreateUrl',route('testimonials.store'),['id'=>'indexTestimonialCreateUrl'])}}
            {{Form::hidden('profileError',__('messages.testimonial.profile_error'),['id'=>'indexTestimonialProfileError'])}}
            {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'indexTestimonialDefaultDocumentImageUrl'])}}
            {{ Form::hidden('testimonial', __('messages.testimonial.testimonial'), ['id' => 'Testimonial']) }}
            <livewire:testimonial-table/>
            @include('testimonials.add_modal')
            @include('testimonials.edit_modal')
            @include('testimonials.show_modal')
            @include('testimonials.templates.templates')
        </div>
    </div>
@endsection
@section('scripts')
    {{-- assets/js/testimonials/testimonial.js --}}
@endsection

