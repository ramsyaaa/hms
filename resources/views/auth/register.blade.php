@extends('layouts.auth_app')

@php
    App::setLocale(session('languageName'));
@endphp
@section('title')
    {{ __('web.register') }}
@endsection
@section('content')
    <!--begin::Authentication - Sign-up -->
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
        $settingValue = getSettingValue();
        App::setLocale(session('languageName'));
    @endphp

    <ul class="nav nav-pills" style="justify-content: flex-end; cursor: pointer">
        <li class="nav-item dropdown">
            <a class="btn btn-primary w-150px mb-5 indicator m-3"
               data-bs-toggle="dropdown" href="javascript:void(0)" role="button"
               aria-expanded="false">{{ __('messages.language.'.getCurrentLanguageName()) }}</a>
            <ul class="dropdown-menu w-150px">
                @foreach(getLanguages() as $key => $value)
                    <li class="{{(checkLanguageSession() == $key) ? 'active' : '' }}"><a
                                class="dropdown-item  px-5 language-select {{(checkLanguageSession() == $key) ? 'bg-primary text-white' : 'text-dark' }}"
                                data-id="{{$key}}">{{$value}}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>

    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('front') }}" class="image mb-7 mb-sm-10" data-turbo="false">
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
            <h1 class="text-center mb-7">{{__('auth.registration.patient_registration')}}</h1>
            <form method="POST" action="{{ url('/register') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="formInputFirstName" class="form-label">
                            {{ __('messages.profile.first_name') .':' }}<span class="required"></span>
                        </label>
                        <input name="first_name" type="text" class="form-control" id="first_name"
                               placeholder=" {{ __('messages.profile.first_name') }}"
                               aria-describedby="firstName" value="{{ old('first_name') }}"
                               onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                               required>
                    </div>
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="last_name" class="form-label">
                            {{ __('messages.profile.last_name').':' }}<span class="required"></span>
                        </label>
                        <input name="last_name" type="text" class="form-control" id="last_name"
                               placeholder=" {{ __('messages.profile.last_name') }}"
                               aria-describedby="lastName"
                               onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                               required value="{{ old('last_name') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="email" class="form-label">
                            {{ __('auth.email').':' }}<span class="required"></span>
                        </label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="email"
                               placeholder=" {{ __('auth.email') }}"
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label class="form-label">{{__('messages.web_contact.phone_number')}}
                            <span class="required"></span>
                        </label>
                        <input type="phone" class="form-control"
                               name="phone" value="{{ old('phone') }}"
                               placeholder="{{__('messages.web_contact.phone_number')}}"
                               minlength="10"
                               maxlength="10"
                               onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'
                               onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                               required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="password" class="form-label">
                            {{ __('auth.password').':' }}<span class="required"></span>
                        </label>
                        <div class="mb-3 position-relative">
                            <input type="password" name="password" class="form-control" id="password"
                                   onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                   placeholder=" {{ __('auth.password') }}" aria-describedby="password" required
                                   aria-label="Password" data-toggle="password">
                        </div>
                    </div>
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="password_confirmation" class="form-label">
                            {{ __('auth.confirm_password').':' }}<span class="required"></span>
                        </label>
                        <div class="mb-3 position-relative">
                            <input name="password_confirmation" type="password" class="form-control"
                                   placeholder=" {{ __('auth.confirm_password') }}" id="password_confirmation"
                                   aria-describedby="confirmPassword" required aria-label="Password"
                                   onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                   data-toggle="password">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-sm-7 mb-4">
                    <div class="form-group mb-5">
                        <label class="form-label">{{__('messages.user.gender')}}
                            <span class="required"></span> &nbsp;<br>
                        </label>
                        <br>
                        <div class="d-flex align-items-center">

                            <div class="form-check me-5">
                                <input class="form-check-input" type="radio" name="gender" value="0" checked id="male"/>
                                <label class="form-check-label" for="male">
                                    {{__('messages.user.male')}}
                                </label>
                            </div>

                            <div class="form-check me-10">
                                <input class="form-check-input" type="radio" name="gender" value="1" id="female"/>
                                <label class="form-check-label" for="female">
                                    {{__('messages.user.female')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{__('auth.submit')}}</button>
                </div>

                <div class="d-flex align-items-center mt-4">
                    <span class="text-gray-700 me-2">{{__('auth.already_user')}}</span>
                    <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                        {{__('auth.sign_in')}}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

