@extends('layouts.app')
@section('title')
    {{ __('messages.account.account_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{__('messages.account.account_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary account-edit-btn"
                   data-id="{{ $account->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('accounts.index') }}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
                @include('accounts.show_fields')
            @include('accounts.edit_modal')
        </div>
    </div>
    {{Form::Hidden('accountUrl',route('accounts.index'),['id'=>'indexAccountUrl'])}}
    {{Form::Hidden('accountShowUrl',Request::fullUrl(),['id'=>'accountShowUrl'])}}

@endsection
@section('scripts')
    {{--    assets/js/accounts/accounts_details_edit.js --}}
    {{--    assets/js/custom/reset_models.js --}}
@endsection
