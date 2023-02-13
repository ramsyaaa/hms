<div id="showRadiologyTest" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.radiology_test.radiology_test_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mb-5">
                        <label for="test_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.test_name').(':') }}</label><br>
                        <span id="showRtTest_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="short_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.short_name').(':') }}</label><br>
                        <span id="showRtShort_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="test_type"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.test_type').(':') }}</label><br>
                        <span id="showRtTest_type"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="category_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.category_name').(':') }}</label><br>
                        <span id="showRadiologyCategories"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="subcategory"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.subcategory').(':') }}</label><br>
                        <span id="showRtSubcategory"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="report_days"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.report_days').(':') }}</label><br>
                        <span id="showRtReport_days"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="charge_category"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.charge_category').(':') }}</label><br>
                        <span id="showCharge_categories"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="standard_charge"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.standard_charge').(':') }}</label><br>
                        <span id="showRtStandard_charge"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showRtCreated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showRtUpdated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
