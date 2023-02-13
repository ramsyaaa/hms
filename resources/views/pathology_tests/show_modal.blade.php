<div id="showPathologyTest" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"
                    id="exampleModalLabel">{{ __('messages.pathology_test.pathology_test_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mb-5">
                        <label for="test_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.test_name').(':') }}</label><br>
                        <span id="showPathologyTestName"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="short_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.short_name').(':') }}</label><br>
                        <span id="showPathologyTestShortName"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="test_type"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.test_type').(':') }}</label><br>
                        <span id="showPathologyTestType"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="category_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.category_name').(':') }}</label><br>
                        <span id="showPathologyCategories"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="test_unit"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.pathology_test.unit').(':') }}</label><br>
                        <span id="showPathologyTestUnit"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="subcategory"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.subcategory').(':') }}</label><br>
                        <span id="showPathologyTestSubcategory"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="test_method"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.pathology_test.method').(':') }}</label><br>
                        <span id="showPathologyTestMethod"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="report_days"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.report_days').(':') }}</label><br>
                        <span id="showPathologyTestReportDays"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="charge_category"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.charge_category').(':') }}</label><br>
                        <span id="showPathologyChargeCategories"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="standard_charge"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.radiology_test.standard_charge').(':') }}</label><br>
                        <span id="showPTestStandardCharge"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showPathologyTestCreatedOn"
                              class="fs-5 text-grßß ay-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showPathologyTestUpdatedOn"
                              class="ffs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
