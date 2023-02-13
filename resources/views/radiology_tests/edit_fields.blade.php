<div class="row">
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('test_name', __('messages.radiology_test.test_name').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('test_name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('short_name', __('messages.radiology_test.short_name').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('short_name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('test_type', __('messages.radiology_test.test_type').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('test_type', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('category_id', __('messages.radiology_test.category_name').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('category_id',$data['radiologyCategories'], null, ['class' => 'form-select radiologyCategories','required','id' => 'editRadiologyCategories','placeholder'=>'Select Category','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('subcategory', __('messages.radiology_test.subcategory').':',['class' => 'form-label']) }}
            {{ Form::text('subcategory', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('report_days', __('messages.radiology_test.report_days').':',['class' => 'form-label']) }}
            {{ Form::number('report_days', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('charge_category_id', __('messages.radiology_test.charge_category').':',['class' => 'form-label ']) }}
            <span class="required"></span>
            {{ Form::select('charge_category_id',$data['chargeCategories'], null, ['class' => 'form-select chargeCategories','required','id' => 'editChargeCategories','placeholder'=>'Select Charge Category','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('standard_charge', __('messages.radiology_test.standard_charge').':',['class' => 'form-label']) }}
            <span class="required"></span>
            (<b>{{ getCurrencySymbol() }}</b>)
            {{ Form::text('standard_charge', null, ['class' => 'form-control price-input rtStandardCharge', 'id' => 'editRTStandardCharge', 'readonly', 'required']) }}
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="form-group">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
            <a href="{{ route('radiology.test.index') }}"
               class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
        </div>
    </div>
</div>
