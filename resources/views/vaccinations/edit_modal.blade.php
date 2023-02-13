<div id="edit_vaccinations_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.vaccination.edit_vaccination') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="alert alert-danger d-none hide" id="editValidationErrorsBox1"></div>
            {{ Form::hidden('vaccination_id',null,['id'=>'vaccinationId']) }}
            {{ Form::open(['id'=>'edit_vaccinations_form']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.vaccination.name').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['id'=>'editVaccinationName','class' => 'form-control','required']) }}
                    </div>

                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('manufactured_by', __('messages.vaccination.manufactured_by').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('manufactured_by', null, ['id'=>'editVaccinationManufacturedBy','class' => 'form-control','required']) }}
                    </div>

                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('brand', __('messages.vaccination.brand').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('brand', '', ['id'=>'editVaccinationBrand','class' => 'form-control','required']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-5','id' => 'btnEditVaccinationSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
