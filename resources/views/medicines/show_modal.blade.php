<div id="showMedicine" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.medicine.medicine_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-6 mb-5">
                        <label for="medicine_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.medicine').(':') }}</label><br>
                        <span id="showMedicineName"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="medicine_brand"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.brand').(':') }}</label><br>
                        <span id="showMedicineBrand"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="medicine_category"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.category').(':') }}</label><br>
                        <span id="showMedicineCategory"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="salt_composition"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.salt_composition').(':') }}</label><br>
                        <span id="showMedicineSaltComposition"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="selling_price"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.selling_price').(':') }}</label><br>
                        <span id="showMedicineSellingPrice"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="buying_price"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.buying_price').(':') }}</label><br>
                        <span id="showMedicineBuyingPrice"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="side_effects"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.side_effects').(':') }}</label><br>
                        <span id="showMedicineSideEffects"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showMedicineCreatedOn"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showMedicineUpdatedOn"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="description"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.description').(':') }}</label><br>
                        <span id="showMedicineDescription"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
