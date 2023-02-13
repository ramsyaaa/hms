<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('sr no', __('messages.employee_payroll.sr_no').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->sr_no}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('payroll id', __('messages.employee_payroll.payroll_id').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->payroll_id}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('payroll role', __('messages.employee_payroll.role').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->type_string}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('full name', __('messages.employee_payroll.employee').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            @if($employeePayroll->owner->table == 'doctors')
                                <span class="fs-5 text-gray-800">{{$employeePayroll->owner->doctorUser->full_name}}</span>
                            @else
                                <span class="fs-5 text-gray-800">{{$employeePayroll->owner->user->full_name}}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('month', __('messages.employee_payroll.month').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->month}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('year', __('messages.employee_payroll.year').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->year}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <p class="m-0"><span
                                        class="badge bg-light-{{$employeePayroll->status == 0 ? 'danger' : 'success'}}">{{ ($employeePayroll->status == 0) ? 'Unpaid' : 'Paid' }}</span>
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('salary', __('messages.employee_payroll.basic_salary').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800"> 
{{--                                {{ number_format($employeePayroll->basic_salary, 2) }}--}}
                                {{ checkValidCurrency($employeePayroll->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($employeePayroll->basic_salary, strtoupper($employeePayroll->currency_symbol ?? getCurrentCurrency())) : number_format($employeePayroll->basic_salary) . '' . ($employeePayroll->currency_symbol ? getSymbols($employeePayroll->currency_symbol) : getCurrencySymbol()) }}
                            </span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('allowance', __('messages.employee_payroll.allowance').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">
{{--                                {{ number_format($employeePayroll->allowance, 2) }}--}}
                                {{ checkValidCurrency($employeePayroll->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($employeePayroll->allowance, strtoupper($employeePayroll->currency_symbol ?? getCurrentCurrency())) : number_format($employeePayroll->allowance, 2) . '' . ($employeePayroll->currency_symbol ? getSymbols($employeePayroll->currency_symbol) : getCurrencySymbol()) }}
                            </span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('deductions', __('messages.employee_payroll.deductions').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">
{{--                                {{ number_format($employeePayroll->deductions, 2)}}--}}
                                {{ checkValidCurrency($employeePayroll->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($employeePayroll->deductions, strtoupper($employeePayroll->currency_symbol ?? getCurrentCurrency())) : number_format($employeePayroll->deductions, 2) . '' . ($employeePayroll->currency_symbol ? getSymbols($employeePayroll->currency_symbol) : getCurrencySymbol()) }}
                            </span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('net salary', __('messages.employee_payroll.net_salary').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">
{{--                                {{ number_format($employeePayroll->net_salary, 2)}}--}}
                                {{ checkValidCurrency($employeePayroll->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($employeePayroll->net_salary, strtoupper($employeePayroll->currency_symbol ?? getCurrentCurrency())) : number_format($employeePayroll->net_salary, 2) . '' . ($employeePayroll->currency_symbol ? getSymbols($employeePayroll->currency_symbol) : getCurrencySymbol()) }}
                            </span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{ $employeePayroll->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-2 d-flex flex-column">
                            {{ Form::label('updated at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{ $employeePayroll->updated_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
