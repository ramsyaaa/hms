@extends('web.layouts.front')
@section('title')
    {{ __('messages.web_home.testimonials') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/testimonials.css') }}">--}}
@endsection
@section('content')
    <div class="home-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-60 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.testimonials') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front') }}">{{ __('messages.web_home.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('messages.web_home.testimonials') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/Testimonials.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start testimonial-section -->
        <section class="testimonial-section p-t-120 p-b-120">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary pb-2">{{ __('messages.web_home.our_testimonials') }}</h6>
                    <h2 class="mb-4 pb-xl-4 pb-3">{{ __('messages.web_home.what_our_patient_say_about_medical_treatments') }}</h2>
                </div>
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="testimonial-slider">
                            @foreach($testimonials as $testimonial)
                                <div class="justify-content-center">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-sm-4 position-relative">
                                            <div class="testimonial-img">
                                                <img src="{{ $testimonial->document_url }}" class="image" alt="Testimonial Image">
                                            </div>
                                            <div class="quote-img br-5 position-absolute">
                                                <img src="web_front/images/testimonials/quote.png" alt="quote">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 position-relative pb-md-5 mb-md-3">
                                            <div class="testimonial-desc ps-lg-5 pt-sm-0 pt-4">
                                                <h3>{{ \Illuminate\Support\Str::limit($testimonial->name, 46) }}</h3>
                                                <p class="mb-0">
                                                    {{ $testimonial->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end testimonial-section -->
        
    </div>
@endsection
