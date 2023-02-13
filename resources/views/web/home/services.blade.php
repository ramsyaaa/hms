@extends('web.layouts.front')
@section('title')
    {{ __('messages.services') }}
@endsection
@section('content')
    <div class="services-page">
        <!-- start hero section -->
        <section class="hero-section position-relative p-t-60 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                               {{ __('messages.web_home.services') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">
                                            {{ __('messages.web_home.home') }}
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ __('messages.web_home.services') }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ asset('web_front/images/page-banner/Services.png') }}" alt="Infy Care" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start service-section -->
        <section class="service-section p-t-120 p-b-120">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary mb-3">{{ __('messages.web_home.our_services') }}</h6>
                    <h2 class="mb-4 pb-xl-4">
                        {{ __('messages.web_home.we_offer_different_services_to_improve_your_health') }}
                    </h2>
                </div>
                <div class="our-service">
                    <div class="row justify-content-center">
                        @foreach($frontServices as $frontService)
                        <div class="col-xl-3 col-lg-4 col-md-6 py-lg-2 card-hover d-flex align-items-stretch">
                            <div class="card p-c-4 my-lg-2 mx-lg-1 my-md-3 my-2 flex-fill">
                                <img src="{{ isset($frontService->icon_url) ? $frontService->icon_url : asset('web_front/images/services/medicine.png') }}" class="card-img-top img-wh mx-auto " alt="Cardiology">
                                <div class="card-body p-0 text-center d-flex flex-column">
                                    <h4 class="card-title mt-4">{{ \Illuminate\Support\Str::limit($frontService->name, 16) }}</h4>
                                    <p class="card-text">
                                        {{ \Illuminate\Support\Str::limit($frontService->short_description, 123) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    {{ $frontServices->links() }}
                </nav>
            </div>
        </section>
        <!-- end service-section -->
    </div>
@endsection
