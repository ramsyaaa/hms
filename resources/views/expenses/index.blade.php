@extends('layouts.app')
@section('title')
    {{ __('messages.expenses') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:expense-table/>
        </div>
        @include('partials.modal.templates.templates')
        @include('expenses.create_modal')
        @include('expenses.edit_modal')
        {{Form::hidden('expenseUrl',url('expenses'),['id'=>'indexExpenseUrl'])}}
        {{Form::hidden('expenseCreateUrl',route('expenses.store'),['id'=>'indexExpenseCreateUrl'])}}
        {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'indexExpenseDefaultDocumentImageUrl'])}}
        {{Form::hidden('expenseHeadArray',json_encode($expenseHeads),['id'=>'indexExpenseHeadArray'])}}
        {{Form::hidden('download',__('messages.expense.download'),['id'=>'indexExpenseDownload'])}}
        {{Form::hidden('documentError',__('messages.expense.document_error'),['id'=>'indexExpenseDocumentError'])}}
        {{Form::hidden('downloadDocumentUrl',url('expense-download'),['id'=>'indexExpenseDownloadDocumentUrl'])}}
        {{ Form::hidden('expenses', __('messages.expense.expense'), ['id' => 'Expenses']) }}
    </div>
@endsection
@section('scripts')
    {{--    assets/js/expenses/expenses.js --}}
    {{--    assets/js/custom/new-edit-modal-form.js --}}
@endsection
