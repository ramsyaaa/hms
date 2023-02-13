<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('department_id', __('messages.issued_item.department_id').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {{ Form::select('department_id', $data['userTypes'], null, ['id' => 'issueUserType','class' => 'form-select','required','placeholder' => 'Select User Type', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('user_id', __('messages.issued_item.user_id').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {{ Form::select('user_id', [null], null, ['id' => 'issueTo','class' => 'form-select','required','disabled', 'data-control' => 'select2', 'placeholder' => 'Select User']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('issued_by', __('messages.issued_item.issued_by').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {!! Form::text('issued_by', null, ['id'=>'issuedBy', 'class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('issued_date', __('messages.issued_item.issued_date').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {!! Form::text('issued_date', null, ['id'=>'issueDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'required', 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('return_date', __('messages.issued_item.return_date').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {!! Form::text('return_date', null, ['id'=>'issueReturnDate', 'class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('item_category_id', __('messages.issued_item.item_category').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {{ Form::select('item_category_id', $data['itemCategories'], null, ['id' => 'issueItemCategory','class' => 'form-select','required','placeholder' => 'Select Item Category', 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::label('item_id', __('messages.issued_item.item').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {{ Form::select('item_id', [null], null, ['id' => 'issueItems','class' => 'form-select','required','disabled', 'data-control' => 'select2', 'placeholder' => 'Select Item']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-5 col-sm-12">
        <div class="form-group mb-5">
            {!! Form::hidden('available_quantity', null, ['id'=>'itemAvailableQuantity']) !!}
            {!! Form::label('quantity', __('messages.issued_item.quantity').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            (<span class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.item.available_quantity') . ':' }} <span id="showAvailableQuantity">0</span></span>)
            {!! Form::number('quantity', null, ['id'=>'itemQuantity','class' => 'form-control', 'required', 'min' => 1, 'disabled']) !!}
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.item_stock.description').(':'), ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'issuedItemSave']) !!}
        <a href="{!! route('issued.item.index') !!}"
           class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
    </div>
</div>
