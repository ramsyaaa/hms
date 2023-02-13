<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{config('app.name')}}">

    <meta name="keywords" content="Hospital Management System"/>

    <meta name="description" content="Hospital Management System | HMS"/>
    <meta name="author" content="{{getAppName()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbo-cache-control" content="no-cache">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @php
        $settingValue = getSettingValue();
    @endphp
    <link rel="icon" href="{{ $settingValue['favicon']['value'] }}" type="image/png">
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/slick.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/slick-theme.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/bootstrap.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/home.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/layout.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ mix('web_front/css/layout.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/remixicon.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/jquery-ui.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/selectize.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/style.css') }}">--}}
    <link rel="stylesheet" href="{{mix('css/front-third-party.css')}}">
    <link rel="stylesheet" href="{{mix('css/front-pages.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    @yield('page_css')
    @yield('css')
<!-- Links of JS files -->
{{--    @livewireScripts--}}
    <script src="{{ asset('livewire/livewire.js') }}" data-turbolinks-eval="false" data-turbo-eval="false"></script> 
    @include('livewire.livewire-turbo') 
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
    <script src="{{ asset('js/turbo.js')}}" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script src="{{ mix('js/front-third-party.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('messages.js') }}"></script>
{{--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>--}}
    <script src="{{ mix('js/front-pages.js') }}"></script>
    @yield('page_scripts')
    <script>
        $(document).ready(function () {
            $(this).scrollTop(0);
            $('.alert').delay(5000).slideUp(300)
            // $('.selectize-dropdown').addClass('d-none');
        })

        $(document).on('click','.doctor-name-filter',function (){
            $('.selectize-dropdown').removeClass('d-none');
        })
        $(document).on('click', '.languageSelection', function () {
            let languageName = $(this).data('prefix-value')

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'POST',
                url: '/change-language',
                data: {languageName: languageName},
                success: function () {
                    location.reload();
                },
            });
        });
    </script>
    @yield('scripts')
</head>
<body>
{{--@include('web.layouts.web_loader')--}}
@include('web.layouts.header')
{{Form::hidden('userCurrentLanguage',checkLanguageSession(),['class'=>'userCurrentLanguage'])}}
@yield('content')
@include('web.layouts.footer')

<!-- Start Go Top Area -->
<div class="go-top bg-success d-flex align-items-center justify-content-center">
    <i class="fas fa-chevron-up next-arrow"></i>
</div>
</body>
</html>
