{{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
<!-- Name Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('name', __('messages.medicine.medicine').(':'), ['class' => 'form-label']) }}
    <span class="required"></span>
    {{ Form::text('name', null, ['class' => 'form-control','minlength' => 2, 'id' => 'medicineNameId']) }}
</div>

<!-- Category Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('category_id', __('messages.medicine.category').(':'), ['class' => 'form-label']) }}
    <span class="required"></span>
    {{ Form::select('category_id', $categories, (isset($medicine)) ? $medicine->category_id : null, ['class' => 'form-select', 'placeholder' => 'Select Category', 'id' => 'medicineCategoryId']) }}
</div>

<!-- Name Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('brand_id', __('messages.medicine.brand').(':'), ['class' => 'form-label']) }}
    <span class="required"></span>
    {{ Form::select('brand_id', $brands,  (isset($medicine)) ? $medicine->brand_id : null, ['class' => 'form-select', 'placeholder' => 'Select Brand', 'id' => 'medicineBrandId']) }}
</div>

<!-- Salt Composition Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('salt_composition', __('messages.medicine.salt_composition').(':'), ['class' => 'form-label']) }}
    <span
        class="required"></span>
    {{ Form::text('salt_composition', null, ['class' => 'form-control','required']) }}
</div>

<!-- Buying Price Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('buying_price', __('messages.medicine.buying_price').(':'), ['class' => 'form-label']) }}
    <span class="required"></span>
    {{ Form::text('buying_price', null, ['class' => 'form-control price-input']) }}
</div>

<!-- Selling Price Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('selling_price', __('messages.medicine.selling_price').(':'), ['class' => 'form-label']) }}
    <span class="required"></span>
    {{ Form::text('selling_price', null, ['class' => 'form-control price-input']) }}
</div>

<!-- Effect Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('side_effects', __('messages.medicine.side_effects').(':'), ['class' => 'form-label']) }}
    {{ Form::textarea('side_effects', null, ['class' => 'form-control', 'rows'=>4]) }}
</div>

<!-- Effect Field -->
<div class="form-group col-md-6 mb-5">
    {{ Form::label('description', __('messages.medicine.description').(':'), ['class' => 'form-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows'=>4]) }}
</div>

<!-- Submit Field -->
<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'medicineSave']) }}
    <a href="{{ route('medicines.index') }}"
       class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
</div>
