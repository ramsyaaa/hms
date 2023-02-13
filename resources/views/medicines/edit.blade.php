@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.edit_medicine') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('medicines.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::model($medicine, ['route' => ['medicines.update', $medicine->id], 'method' => 'patch', 'id' => 'editMedicine']) }}
                    <div class="row">
                        @include('medicines.fields')
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/custom/input_price_format.js --}}
    {{--    assets/js/medicines/new.js --}}
@endsection
