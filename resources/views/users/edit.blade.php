@extends('layouts.app')
@section('title')
    {{ __('messages.user.edit_user') }}
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
                    {{Form::hidden('userUrl',route('users.index'),['id'=>'editUserUrl'])}}
                    {{Form::hidden('utilsScript',asset('assets/js/int-tel/js/utils.min.js'),['class'=>'utilsScript'])}}
                    {{Form::hidden('phoneNo',old('prefix_code').old('phone'),['class'=>'phoneNo'])}}
                    {{Form::hidden('defaultAvatarImageUrl',asset('assets/img/avatar.png'),['class'=>'defaultAvatarImageUrl'])}}
                    {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}

                    {{ Form::model($user, ['route' => ['users.update', $user->id], 'files' => 'true', 'method' => 'patch', 'id' => 'editUserForm']) }}
                    @include('users.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- JS File :-assets/js/users/create-edit.js --}}
