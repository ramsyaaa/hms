@extends('layouts.app')
@section('title')
    {{__('messages.incomes.incomes')}}
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:income-table/>
            @include('partials.modal.templates.templates')
            @include('incomes.create_modal')
            @include('incomes.edit_modal')
            {{Form::hidden('incomeUrl',url('incomes'),['id'=>'indexIncomeUrl'])}}
            {{Form::hidden('incomeCreateUrl',route('incomes.store'),['id'=>'indexIncomeCreateUrl'])}}
            {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'indexIncomeDefaultDocumentImageUrl'])}}
            {{Form::hidden('incomeHeadArray',json_encode($incomeHeads),['id'=>'indexIncomeHeadArray'])}}
            {{Form::hidden('download',__('messages.incomes.download'),['id'=>'indexIncomeDownload'])}}
            {{Form::hidden('documentError',__('messages.incomes.document_error'),['id'=>'indexIncomeDocumentError'])}}
            {{Form::hidden('downloadDocumentUrl',url('income-download'),['id'=>'indexIncomeDownloadDocumentUrl'])}}
            {{ Form::hidden('income', __('messages.income'), ['id' => 'Income']) }}
        </div>
    </div>
@endsection
@section('scripts')
    {{--    assets/js/incomes/incomes.js --}}
    {{--    assets/js/custom/new-edit-modal-form.js --}}
@endsection
