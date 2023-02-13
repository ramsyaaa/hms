@extends('layouts.app')
@section('title')
    {{ __('messages.item_stock.edit_item_stock') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">@yield('title')</h1>
            <a href="{{ route('item.stock.index') }}"
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
                {{Form::hidden('itemsUrl',route('items.list'),['id'=>'editStockItemsUrl','class'=>'itemsUrl'])}}
                {{Form::hidden('itemId',$itemStock->item_id,['id'=>'editStockItemId'])}}
                {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
                {{Form::hidden('defaultDocumentImageUrl',asset('assets/img/default_image.jpg'),['id'=>'editStockDefaultDocumentImageUrl'])}}
                <div class="card-body p-12">
                    {{ Form::model($itemStock, ['route' => ['item.stock.update', $itemStock->id], 'method' => 'post','id' => 'editItemStockForm', 'files' => 'true']) }}

                    @include('item_stocks.edit_fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/item_stocks/create-edit.js --}}
@endsection
