@extends('layouts.app')
@section('title')
    {{ __('messages.issued_item.new_issued_item') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('issued.item.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{Form::hidden('usersUrl',route('users.list'),['id'=>'itemIssuedUsersUrl'])}}
                {{Form::hidden('itemsUrl',route('items.list'),['id'=>'issuedItemsUrl'])}}
                {{Form::hidden('itemAvailableQtyUrl',route('item.available.qty'),['id'=>'issuedItemAvailableQtyUrl'])}}
                <div class="card-body p-12">
                    {{ Form::open(['route' => 'issued.item.store', 'id' => 'createIssuedItemForm']) }}

                    @include('issued_items.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--    <script src="{{ mix('assets/js/issued_items/create.js') }}"></script>--}}
@endsection
