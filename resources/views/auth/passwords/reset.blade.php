@extends('layouts.auth_app')

@section('title')
    Reset password
@endsection
@section('content')
    <!--begin::Authentication - Sign-up -->
    @php
        $settingValue = getSettingValue();
        App::setLocale(session('languageName'));
    @endphp

    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('front') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ $settingValue['app_logo']['value'] }}" class="img-fluid logo-fix-size">
            </a>
        </div>
        <div class="width-540">
            @include('flash::message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('auth.reset_password.title')}}</h1>
            <form method="POST" action="{{ url('/password/reset') }}">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <div class="row">
                    <div class="mb-sm-7 mb-4">
                        <label for="email" class="form-label">
                            {{ __('auth.email').':' }}<span class="required"></span>
                        </label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="email"
                               placeholder=" {{ __('auth.email') }}"
                               value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-sm-7 mb-4">
                        <label for="password" class="form-label">
                            {{ __('auth.password').':' }}<span class="required"></span>
                        </label>
                        <div class="mb-3 position-relative">
                            <input type="password" name="password" class="form-control" id="password"
                                   placeholder=" {{ __('auth.password') }}" aria-describedby="password" required
                                   aria-label="Password" data-toggle="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-sm-7 mb-4">
                        <label for="password_confirmation" class="form-label">
                            {{ __('auth.confirm_password').':' }}<span class="required"></span>
                        </label>
                        <div class="mb-3 position-relative">
                            <input name="password_confirmation" type="password" class="form-control"
                                   placeholder=" {{ __('auth.confirm_password') }}" id="password_confirmation"
                                   aria-describedby="confirmPassword" required aria-label="Password"
                                   data-toggle="password">
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit"
                            class="btn btn-primary">{{__('auth.reset_password.reset_pwd_btn')}}</button>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <span class="text-gray-700 me-2">{{__('auth.reset_password.already_reset')}}</span>
                    <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                        {{__('auth.sign_in')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection


{{--@extends('layouts.auth_app')--}}

{{--@section('title')--}}
{{--    Reset password--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <!--begin::Authentication - New password -->--}}
{{--    @php--}}
{{--        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';--}}
{{--        App::setLocale(session('languageName'));--}}
{{--    @endphp--}}
{{--    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>--}}
{{--        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">--}}
{{--            <a href="{{ route('front') }}" class="mb-12">--}}
{{--                <img alt="Logo" src="{{ asset('web/img/logo.jpg') }}" class="h-45px"/>--}}
{{--            </a>--}}
{{--            <div class="w-lg-550px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">--}}
{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul class="mb-0">--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <form method="post" class="form w-100 form-submit" action="{{ url('/password/reset') }}"--}}
{{--                      >--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="token" value="{{$token}}">--}}
{{--                    <div class="text-center mb-10">--}}
{{--                        <h1 class="text-dark mb-3">{{__('auth.reset_password.title')}}</h1>--}}
{{--                        <div class="text-gray-400 fw-bold fs-5">{{__('auth.reset_password.already_reset')}}--}}
{{--                            <a href="{{ route('login') }}" class="link-primary fw-bolder">{{__('auth.sign_in')}}</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="fv-row mb-10">--}}
{{--                        <label class="form-label fw-bolder text-dark fs-6">--}}
{{--                            {{__('auth.email')}}--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <input type="email" class="form-control form-control-lg form-control-solid" name="email"--}}
{{--                               value="{{ old('email') }}" placeholder="" required>--}}
{{--                    </div>--}}
{{--                    <div class="mb-10 fv-row">--}}
{{--                        <label class="form-label fw-bolder text-dark fs-6">--}}
{{--                            {{__('auth.password')}}--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <input type="password" class="form-control form-control-lg form-control-solid" name="password"--}}
{{--                               placeholder="" required>--}}
{{--                    </div>--}}
{{--                    <div class="fv-row mb-10">--}}
{{--                        <label class="form-label fw-bolder text-dark fs-6">--}}
{{--                            {{__('auth.confirm_password')}}--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <input type="password" name="password_confirmation"--}}
{{--                               class="form-control form-control-lg form-control-solid"--}}
{{--                               placeholder="" required>--}}
{{--                    </div>--}}
{{--                    <div class="text-center">--}}
{{--                        <button type="submit"--}}
{{--                                class="btn btn-lg btn-primary fw-bolder indicator">--}}
{{--                            <span class="indicator-label">{{__('auth.reset_password.reset_pwd_btn')}}</span>--}}
{{--                            <span class="indicator-progress">{{__('auth.please_wait')}}--}}
{{--									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--end::Authentication - New password-->--}}
{{--@endsection--}}
