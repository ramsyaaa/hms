@extends('layouts.auth_app')

@section('title')
    Password Reset
@endsection
@section('content')
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
        $settingValue = getSettingValue();
        App::setLocale(session('languageName'));
    @endphp
    <div class="d-flex flex-column flex-column-fluid align-items-center mt-12 p-4">
        <div class="col-12 text-center mt-0">
            <a href="{{ route('front') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ $settingValue['app_logo']['value'] }}" class="img-fluid logo-fix-size">
            </a>
        </div>
        <div class="width-540">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('auth.login.forgot_password').' ?'}}</h1>
            <div class="fs-5 mb-5 text-center">{{__('auth.forgot_password.title')}}</div>
            <form class="form w-100" method="POST" action="{{ url('/password/email') }}">
                @csrf
                <div class="row">
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            {{ __('auth.email').':' }}<span class="required"></span>
                        </label>
                        <input id="email" class="form-control" type="email"
                               value="{{ old('email') }}"
                               required autofocus name="email" autocomplete="off" placeholder="{{__('auth.email')}}"/>
                    </div>
                </div>
                <div class="row">
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12 d-flex text-start align-items-center">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label"> {{ __('auth.forgot_password.send_pwd_reset') }}</span>
                        </button>
                        <a href="{{ route('login') }}"
                           class="btn btn-secondary my-0 ms-5 me-0">{{__('messages.common.cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


{{--@extends('layouts.auth_app')--}}

{{--@section('title')--}}
{{--    Password Reset--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    @include('flash::message')--}}
{{--    @php--}}
{{--        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';--}}
{{--        $settingValue = getSettingValue();--}}
{{--        App::setLocale(session('languageName'));--}}
{{--    @endphp--}}
{{--    <!--begin::Authentication - Password reset -->--}}
{{--    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>--}}
{{--        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">--}}
{{--            <a href="{{ route('front') }}" class="mb-12">--}}
{{--                <img alt="Logo" src="{{ $settingValue['favicon']['value'] }}" class="h-45px"/>--}}
{{--            </a>--}}
{{--            <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">--}}
{{--                <form method="post" class="form w-100 form-submit" action="{{ url('/password/email') }}">--}}
{{--                    @csrf--}}
{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul class="mb-0">--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <div class="text-center mb-10">--}}
{{--                        <h1 class="text-dark mb-3">{{__('auth.login.forgot_password')}} ?</h1>--}}
{{--                        <div class="text-gray-400 fw-bold fs-5">{{__('auth.forgot_password.title')}}</div>--}}
{{--                    </div>--}}
{{--                    <div class="fv-row mb-10">--}}
{{--                        <label class="form-label fw-bolder text-gray-900 fs-6">--}}
{{--                            {{__('auth.email')}}--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <input type="email" class="form-control form-control-solid" name="email"--}}
{{--                               value="{{ old('email') }}"--}}
{{--                               placeholder="" required>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-center pb-lg-0">--}}
{{--                        <button type="submit"--}}
{{--                                class="btn btn-lg btn-primary fw-bolder me-4 indicator">--}}
{{--                            <span class="indicator-label">{{__('auth.forgot_password.send_pwd_reset')}}</span>--}}
{{--                            <span class="indicator-progress">{{__('auth.please_wait')}}--}}
{{--                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--end::Authentication - Password reset-->--}}
{{--@endsection--}}

