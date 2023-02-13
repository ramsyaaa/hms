<div id="showPayment" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.payment.payment_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payment_account"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.account.account').(':') }}</label><br>
                        <span id="payment_account"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payment_date"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.payment.payment_date').(':') }}</label><br>
                        <span id="payment_date"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="pay_to"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.payment.pay_to').(':') }}</label><br>
                        <span id="pay_to"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="payment_amount"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.payment.amount').(':') }}</label><br>
                        <span id="payment_amount"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="created_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-4 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="updated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label for="description"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.description').(':') }}</label><br>
                        <span id="description"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
