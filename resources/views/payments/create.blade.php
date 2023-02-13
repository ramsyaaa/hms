@extends('layouts.app')
@section('title')
    {{ __('messages.payment.new_payment') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('payments.index') }}"
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
                <div class="card-body">
                    {{ Form::open(['route' => 'payments.store']) }}
                    @include('payments.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    {{--   assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{-- assets/js/custom/input_price_format.js --}}
    {{-- assets/js/payments/create-edit.js --}}
@endsection
