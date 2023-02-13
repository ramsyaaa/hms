<div class="row">
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('test_name', __('messages.pathology_test.test_name').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('test_name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('short_name', __('messages.pathology_test.short_name').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('short_name', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('test_type', __('messages.pathology_test.test_type').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('test_type', null, ['class' => 'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('category_id', __('messages.pathology_test.category_name').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('category_id',$data['pathologyCategories'], null, ['class' => 'form-select pathologyCategories','required','id' => 'editPathologyCategories','placeholder'=>'Select Category','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('unit', __('messages.pathology_test.unit').':',['class' => 'form-label']) }}
            {{ Form::number('unit', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('subcategory', __('messages.pathology_test.subcategory').':',['class' => 'form-label']) }}
            {{ Form::text('subcategory', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('method', __('messages.pathology_test.method').':',['class' => 'form-label']) }}
            {{ Form::text('method', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('report_days', __('messages.pathology_test.report_days').':',['class' => 'form-label']) }}
            {{ Form::number('report_days', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('charge_category_id', __('messages.pathology_test.charge_category').':',['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('charge_category_id',$data['chargeCategories'], null, ['class' => 'form-select pChargeCategories','required','id' => 'editPathologyChargeCategories','placeholder'=>'Select Charge Category','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('standard_charge', __('messages.pathology_test.standard_charge').':',['class' => 'form-label ']) }}
            <span class="required"></span>
            (<b>{{ getCurrencySymbol() }}</b>)
            {{ Form::text('standard_charge', null, ['class' => 'form-control price-input pathologyStandardCharge', 'id' => 'editPTestStandardCharge', 'readonly', 'required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
            <a href="{{ route('pathology.test.index') }}"
               class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
        </div>
    </div>
</div>
