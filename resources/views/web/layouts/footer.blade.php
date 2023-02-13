<!-- Start Footer Area -->
@php
    $settingValue = getSettingValue();
@endphp

<footer class="footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="row justify-content-between">
                    <div class="col-lg-2 mb-lg-0 mb-4">
                        <img src="{{ getLogoUrl() }}" alt="Infy HMS" class="img-fluid" />
                    </div>
                    <div class="col-lg-10">
                        <p class="d-block text-white">
                            {!! $settingValue['about_us']['value'] !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-3">
                <h3 class="mb-4 pb-1 text-white">{{ __('messages.web_menu.useful_link') }}</h3>
                <ul class="ps-0">
                    <li class="">
                        <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'footer-active' : '' }} text-decoration-none mb-3 d-block text-white">
                            {{ __('messages.web_home.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('our-services') }}" class="{{ Request::is('our-services') ? 'footer-active' : '' }} text-decoration-none mb-3 d-block text-white">
                            {{ __('messages.web_home.services') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('our-doctors') }}" class="{{ Request::is('our-doctors') ? 'footer-active' : '' }} text-decoration-none mb-3 d-block text-white">
                            {{ __('messages.web_home.doctors') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('aboutUs') }}" class="{{ Request::is('about-us') ? 'footer-active' : '' }} text-decoration-none mb-3 d-block text-white">
                            {{ __('messages.web_menu.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="{{ Request::is('contact-us') ? 'footer-active' : '' }} text-decoration-none mb-3 d-block text-white">
                            {{ __('messages.web_home.contact') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <h3 class="mb-4 pb-1 text-white">{{ __('messages.web_menu.contact_information') }}</h3>
                <div class="footer-info">

                    <div class="d-flex align-items-center footer-info__block mb-3 pb-1">
                        <i class="fa-solid fa-phone text-white fs-5 me-3"></i>
                        <a href="tel:{{ $settingValue['hospital_phone']['value'] }}" class="text-decoration-none text-white fs-6">
                            {{ $settingValue['hospital_phone']['value'] }}
                        </a>
                    </div>
                    <div class="d-flex align-items-center footer-info__block mb-3 pb-1">
                        <i class="fa-solid fa-clock fs-5 me-3 text-white"></i>
                        <p class="text-white fs-6 mb-0">
                            {{ $settingValue['hospital_from_time']['value'] }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center footer-info__block mb-3 pb-1">
                        <i class="fa-solid fa-location-dot fs-5 me-3 text-white"></i>
                        <p class="text-white fs-6 mb-0">
                            {{ $settingValue['hospital_address']['value'] }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-lg-5 mt-4 copy-right">
                <p class="pt-4 pb-4 mb-0 text-white">
                    {{ __('messages.web_menu.copyright') }} © {{ date('Y') }} {{ __('messages.web_menu.all_rights_reserved_by') }}
                    {{ getAppName() }}  
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- end footer section -->
