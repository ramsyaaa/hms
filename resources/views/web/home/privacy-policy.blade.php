@extends('web.layouts.front')
@section('title')
    {{ __('messages.web_home.privacy_policy') }}
@endsection
@section('content')
    <div class="terms-service-page">
    <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-60 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.privacy_policy') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front') }}">{{ __('messages.web_home.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('messages.web_home.privacy_policy') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/privacy-policy.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->
        
         <!-- Start Privacy Policy Area -->
        <section class="terms-service-section p-t-120 p-b-120">
            <div class="container">
                <p>
                {!! $frontSetting['privacy_policy'] !!}
    
            </div>
        </section>
        <!-- end terms-service section -->
    </div>
@endsection
