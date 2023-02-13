@extends('web.layouts.front')
@section('title')
    {{ __('messages.about_us') }}
@endsection
@section('page_css')
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/about.css') }}">--}}
@endsection
@section('content')

    <div class="about-page">
        <!-- start hero section -->
        <section
                class="hero-section position-relative p-t-60 border-bottom-right-rounded border-bottom-left-rounded bg-gray overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero-content">
                            <h1 class="mb-3 pb-1">
                                {{ __('messages.web_home.about_us') }}
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-start justify-content-center mb-lg-0 mb-5">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.web_home.about_us') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-end text-center">
                        <img src="{{ !empty($frontSetting['about_us_image']) ? $frontSetting['about_us_image'] : asset('web_front/images/page-banner/About.png') }}" alt="Infy Care" class="img-fluid" />
{{--                        <img src="{{ asset('web_front/images/page-banner/About.png') }}" alt="Infy Care" class="img-fluid" />--}}
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!--start about-section -->
        <section class="about-section p-t-120 p-b-120">
            <div class="container">
                <div class="row align-items-stretch flex-column-reverse flex-lg-row">
                    <div class="col-lg-6 col-md-12">
                        <div class="row h-100">
                            <div class="col-lg-7 col-md-7 about-count-block">
                                <div
                                        class="about-count h-100 br-2 text-center d-flex align-items-center justify-content-center py-lg-3 py-5 px-3">
                                    <div>
                                        <h3 class="text-green">{{ $totalbeds }}</h3>
                                        <h4 class="fw-normal mb-0">{{ __('messages.web_home.patients_beds') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-5 col-md-5 about-count-block">
                                <div
                                        class="about-count h-100 br-2 text-center d-flex align-items-center justify-content-center py-lg-3 py-5 px-3">
                                    <div>
                                        <h3 class="text-pink">{{ $totalDoctorNurses }}</h3>
                                        <h4 class="fw-normal mb-0">{{ __('messages.web_home.doctors_nurses') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 about-count-block">
                                <div
                                        class="about-count h-100 br-2 text-center d-flex align-items-center justify-content-center py-lg-3 py-5 px-3">
                                    <div>
                                        <h3 class="text-primary">{{ $totalPatient }}</h3>
                                        <h4 class="fw-normal mb-0">{{ __('messages.web_home.happy_patients') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 about-count-block">
                                <div
                                        class="about-count h-100 br-2 text-center d-flex align-items-center justify-content-center py-lg-3 py-5 px-3">
                                    <div>
                                        <h3 class="text-blue">
                                            {{ getFrontSettingValue(\App\Models\FrontSetting::HOME_PAGE,'home_page_experience') }}
                                        </h3>
                                        <h4 class="fw-normal mb-0">{{ __('messages.web_home.years_experience') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right pb-5 pt-lg-5 text-lg-start text-center">
                            <h2 class="mt-md-3">{{ \Illuminate\Support\Str::limit($frontSetting['about_us_title'], 50)  }}</h2>
                            <p class="mt-4">{!! \Illuminate\Support\Str::limit($frontSetting['about_us_description'], 615)  !!}</p>
                            <a href="{{ route('appointment') }}" class="btn btn-primary mt-4">
                                {{ __('messages.web_home.book_appointment') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- end about-section -->

        <!-- start quality-and-testimonial-section -->
        <section class="testimonial-section p-t-120">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary pb-2">{{ __('messages.web_home.our_testimonials') }}</h6>
                    <h2 class="mb-2 pb-xl-2">
                        {{ __('messages.web_home.what_our_patient_say_about_medical_treatments') }}
                    </h2>
                    <p class="mb-4 pb-xl-4">
                        {!!  \Illuminate\Support\Str::limit(getFrontSettingValue(\App\Models\FrontSetting::HOME_PAGE, 'home_page_certified_doctor_description'), 130)  !!}
                    </p>
                </div>
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="testimonial-slider">
                            @foreach($testimonials as $testimonial)
                                <div class="justify-content-center">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-sm-4 position-relative">
                                            <div class="testimonial-img">
                                                <img src="{{ $testimonial->document_url }}" alt="testimonial image"
                                                     class="img-fluid">
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
        <!-- end quality-and-testimonial-section -->

        <!-- start professional-doctors section -->
        <section class="professional-doctors-section position-relative p-t-120 p-b-100 bg-white">
            <div class="container">
                <div class="col-lg-6 text-center mx-auto">
                    <h6 class="text-primary mb-3">{{ __('messages.web_home.professional_doctors') }}</h6>
                    <h2 class="mb-5 pb-xl-3">
                        {{ __('messages.web_home.we_are_experienced_healthcare_professionals') }}
                    </h2>
                </div>
                <div class="row justify-content-center">
                    @foreach($doctors as $index => $doctor)
                        <div class="col-xxl-3 col-lg-4 col-md-6 text-center doctors-block my-lg-1">
                            <div class="px-lg-2 py-3">
                                <img src="{{ $doctor->doctorUser->image_url }}" alt="Doctor" class="mx-auto card-image">
                                <div class="card text-center p-20">
                                    <h4>{{ \Illuminate\Support\Str::limit($doctor->doctorUser->full_name, 23) }}</h4>
                                        <p class="mb-2">({{ \Illuminate\Support\Str::limit($doctor->doctorUser->qualification, 25) }})</p>
                                        <h5 class="text-success mb-0 fs-6 fw-normal">
                                            {{ \Illuminate\Support\Str::limit($doctor->specialist, 15) }} {{ __('messages.doctor.specialist') }}
                                        </h5>
                                        <h5 class="text-success mb-0 fs-6 fw-normal">
                                            {{ $doctor->patients_count }}{{ $doctor->patients_count > 0 ? '+' : ''}}
                                            {{ __('messages.web_home.patients') }}
                                        </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end professional-doctors section -->
    </div>
    
@endsection
