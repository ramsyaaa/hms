<div id="add_new_medicine" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.prescription.new_medicine') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'createMedicineFromPrescription', 'method' => 'POST']) }}
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="medicinePrescriptionErrorBox"></div>
                <div class="row">
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
                        {{ Form::select('category_id', $categories, (isset($medicine)) ? $medicine->category_id : null, ['class' => 'form-select', 'placeholder' => 'Select Category', 'id' => 'prescriptionMedicineCategoryId']) }}
                    </div>

                    <!-- Name Field -->
                    <div class="form-group col-md-6 mb-5">
                        {{ Form::label('brand_id', __('messages.medicine.brand').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('brand_id', $brands,  (isset($medicine)) ? $medicine->brand_id : null, ['class' => 'form-select', 'placeholder' => 'Select Brand', 'id' => 'prescriptionMedicineBrandId']) }}
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
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('side_effects', __('messages.medicine.side_effects').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('side_effects', null, ['class' => 'form-control', 'rows'=>4]) }}
                    </div>

                    <!-- Effect Field -->
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('description', __('messages.medicine.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows'=>4]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'prescriptionMedicineSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
