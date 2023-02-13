@extends('layouts.app')
@section('title')
    {{ __('messages.user.new_user') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{ route('users.index') }}">{{ __('messages.common.back') }}</a>
                </div>

                <div class="col-12">
                    @include('layouts.errors')
                </div>
                <div class="card">
                    <div class="card-body">
                        {{Form::hidden('user_url',route('users.index'),['id'=>'createUserUrl'])}}
                        {{Form::hidden('utilsScript',asset('assets/js/int-tel/js/utils.min.js'),['class'=>'utilsScript'])}}
                        {{Form::hidden('phoneNo',old('prefix_code').old('phone'),['class'=>'phoneNo'])}}
                        {{Form::hidden('defaultAvatarImageUrl',asset('assets/img/avatar.png'),['class'=>'defaultAvatarImageUrl'])}}
                        {{Form::hidden('isEdit',false,['class'=>'isEdit'])}}
                        {{Form::hidden('downloadDocument_url',url('visitor-download'),['id'=>'userDownloadDocumentUrl'])}}
                        {{Form::hidden('doctorRole',array_search('Doctor', $role),['id'=>'userDoctorRole'])}}

                        {{ Form::open(['route' => ['users.index'], 'method'=>'post', 'files' => true, 'id' => 'createUserForm']) }}
                        @include('users.fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- JS File :-assets/js/users/create-edit.js --}}
