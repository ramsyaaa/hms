<div id="showEmployeePayrolls" class="modal fade side-fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.employee_payroll.employee_payroll_details') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6 mb-5">
                        <label for="sr_no"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.sr_no').(':') }}</label><br>
                        <span id="sr_no"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="payroll_id"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.payroll_id').(':') }}</label><br>
                        <span id="payroll_id"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="payroll_role"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.role').(':') }}</label><br>
                        <span id="payroll_role"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="employee_full_name"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.employee').(':') }}</label><br>
                        <span id="employee_full_name"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="payroll_month"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.month').(':') }}</label><br>
                        <span id="payroll_month"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="payroll_year"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.year').(':') }}</label><br>
                        <span id="payroll_year"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="employee_status"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.status').(':') }}</label><br>
                        <span id="employee_status"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="salary"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.basic_salary').(':') }}</label><br>
                        <span id="salary"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="allowance"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.allowance').(':') }}</label><br>
                        <span id="allowance"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="deductions"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.deductions').(':') }}</label><br>
                        <span id="deductions"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="net_salary"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.employee_payroll.net_salary').(':') }}</label><br>
                        <span id="net_salary"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="created_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="created_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-6 mb-5">
                        <label for="updated_on"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="updated_on"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
