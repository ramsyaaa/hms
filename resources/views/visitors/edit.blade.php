@extends('layouts.app')
@section('title')
    {{ __('messages.visitor.edit') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{  route('visitors.index') }}"
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
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                {{ Form::hidden('visitorUrl', route('visitors.index'), ['class' => 'visitorUrl']) }}
                {{ Form::hidden('utilsScript', asset('assets/js/int-tel/js/utils.min.js'), ['class' => 'utilsScript']) }}
                {{ Form::hidden('isEdit', true, ['class' => 'isEdit']) }}
                {{ Form::hidden('defaultDocumentImageUrl', asset('assets/img/default_image.jpg'), ['class' => 'defaultDocumentImageUrl']) }}
                <div class="card-body">
                    {{ Form::model($visitor, ['route' => ['visitors.update', $visitor->id], 'files' => 'true', 'method' => 'patch', 'id' => 'editVisitorForm']) }}
                    @include('visitors.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--    assets/js/visitors/create-edit.js --}}
@endsection

