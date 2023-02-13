<div id="showSms" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.sms.sms_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mb-5">
                        <label for="send_to"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.sms.send_to').(':') }}</label><br>
                        <span id="showSmsSend_to"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="user_role"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.role').(':') }}</label><br>
                        <span id="showSmsUser_role"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="sms_phone"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone').(':') }}</label><br>
                        <span id="showSms_phone"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="sms_date"
                               class="pb-2 fs-5 text-gray-600">{{  __('messages.sms.date').(':') }}</label><br>
                        <span id="showSms_date"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="send_by"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.sms.send_by').(':') }}</label><br>
                        <span id="showSmsSend_by"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showSmsUpdated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label for="sms_message"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.sms.message').(':') }}</label><br>
                        <span id="showSms_message"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
