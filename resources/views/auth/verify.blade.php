<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{config('app.name')}}">

    <meta name="keywords" content="{{getCompanyName()}}"/>

    <meta name="description" content="{{getAppName()}}"/>
    <meta name="author" content="{{getCompanyName()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $settingValue = getSettingValue();
        App::setLocale(session('languageName'));
    @endphp
    <link rel="icon" href="{{ $settingValue['favicon']['value'] }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Email Verification | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('web_front/css/bootstrap.css') }}">
    @yield('page_css')
</head>
<body>
    <div class="container con-404 vh-100 d-flex justify-content-center">
        <div class="row justify-content-md-center d-block">
            <div class="col-md-12 mt-5">
                <img src="{{ asset('web/img/verification.png') }}" class="img-fluid img-404 mx-auto d-block">
            </div>
            <div class="col-md-12 text-center mt-5">
                <h2>{{ __('messages.verification.verify_your_email_address') }}</h2>
                <p class="not-found-subtitle">
                    {{ __('messages.verification.verify_message') }}
                </p>
                {{--            <a class="btn btn-success back-btn mt-3" href="{{ url()->previous() }}" >Back to Previous Page</a>--}}
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('messages.verification.another_verify_request') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
