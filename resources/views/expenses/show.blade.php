@extends('layouts.app')
@section('title')
    {{ __('messages.expense.expense_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a class="btn btn-primary edit-Btn me-2"
                   data-id="{{ $incomes->id }}">{{ __('messages.common.edit') }}</a>
                <a href="{{route('incomes.index')}}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('expenses.show_fields')
            </div>
        </div>
    </div>
    @include('expenses.edit_modal')
    {{Form::hidden('expenseUrl',url('expenses'),['id'=>'showExpenseUrl'])}}
    {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'showExpenseDefaultDocumentImageUrl'])}}
    {{Form::hidden('download',__('messages.expense.download'),['id'=>'showExpenseDownload'])}}
    {{Form::hidden('documentError',__('messages.expense.document_error'),['id'=>'showExpenseDocumentError'])}}
@endsection
@section('page_scripts')
{{--  assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{--  assets/js/custom/input_price_format.js --}}
    {{--  assets/js/expenses/expenses-details-edit.js --}}
@endsection
