@extends('layouts.app')
@section('title')
    {{ __('messages.bed.new_bulk_bed') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('beds.index') }}"
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
                {{ Form::hidden('bedUrl', route('beds.index'), ['id' => 'bulkBedUrl']) }}
                {{ Form::hidden('bulkBedSaveUrl', route('store.bulk.beds'), ['id' => 'bulkBedSaveUrl']) }}
                {{ Form::hidden('bedTypes', json_encode($associateBedTypes), ['id' => 'bedTypes']) }}
                {{ Form::hidden('uniqueId', 2, ['id' => 'uniqueId']) }}
                <div class="card-body">
                    {{ Form::open(['route' => 'store.bulk.beds', 'id' => 'bulkBedsForm']) }}

                    @include('beds.bulk_beds_fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @include('beds.templates.templates')
    </div>
@endsection
@section('scripts')
    {{--    assets/js/custom/input_price_format.js --}}
    {{--    assets/js/beds/bulk_beds.js --}}
    {{--    assets/js/beds/create-edit.js --}}
@endsection
