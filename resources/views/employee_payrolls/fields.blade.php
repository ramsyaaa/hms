<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('sr_no', __('messages.employee_payroll.sr_no').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('sr_no', $srNo, ['class' => 'form-control', 'required', 'tabindex' => '1']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        @php $currentLang = app()->getLocale() @endphp
        {{ Form::label('payroll_id',__('messages.employee_payroll.payroll_id').':', ['class' => $currentLang == 'ru' ? 'label-display form-label' : 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('payroll_id', $payrollId, ['class' => 'form-control', 'required', 'tabindex' => '2','readonly']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5 myclass">
        {{ Form::label('type',__('messages.employee_payroll.role').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('type', $types, null, ['id' => 'type','class' => 'form-select type', 'required','placeholder' => 'Select Role','data-control' => 'select2']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('owner_id',__('messages.employee_payroll.employee').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('owner_id', [], null, ['id' => 'ownerType','class' => 'form-select','required','disabled','data-control' => 'select2', 'placeholder' => 'Select Employee']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('month',__('messages.employee_payroll.month').':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::selectMonth('month',null, ['id' => 'month','class' => 'form-select','required','data-control' => 'select2']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('year', __('messages.employee_payroll.year').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('year', null, ['class' => 'form-control','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '4','required']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('status', $status, null, ['id' => 'status','class' => 'form-select','required','data-control' => 'select2']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('basic_salary', __('messages.employee_payroll.basic_salary').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
        {{ Form::text('basic_salary', null, ['id' => 'editBasicSalary','class' => 'form-control price-input basicSalary','onkeyup' => 'if (/\D\./g.test(this.value)) this.value = this.value.replace(/\D\./g,"")', 'maxlength' => '7','required']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('allowance', __('messages.employee_payroll.allowance').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('allowance', null, ['id' => 'allowance','class' => 'form-control price-input','onkeyup' => 'if (/\D\./g.test(this.value)) this.value = this.value.replace(/\D\./g,"")', 'maxlength' => '5','required']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
        {{ Form::label('deductions', __('messages.employee_payroll.deductions').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('deductions', null, ['id' => 'deductions','class' => 'form-control price-input','onkeyup' => 'if (/\D\./g.test(this.value)) this.value = this.value.replace(/\D\./g,"")', 'maxlength' => '5','required']) }}
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12">
        {{ Form::label('net_salary', __('messages.employee_payroll.net_salary').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('net_salary', 0, ['id' => 'netSalary','class' => 'form-control price-input','onkeyup' => 'if (/\D\./g.test(this.value)) this.value = this.value.replace(/\D\./g,"")', 'maxlength' => '7','required','readonly']) }}
    </div>
</div>
<div class="d-flex justify-content-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3 btnSave','id' => 'empPayrollSave']) !!}
    <a href="{!! route('employee-payrolls.index') !!}"
       class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
</div>
