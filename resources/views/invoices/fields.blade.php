<div class="container-fluid">
    <div class="d-flex flex-column align-items-start flex-xxl-row">
        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
            <h4>Invoice # <span class="text-gray-500">{{ $invoiceId = (isset($invoice) ? $invoice->invoice_id : \App\Models\Invoice::generateUniqueInvoiceId()) }}</span>
                @if(!isset($invoice))
                    <input type="hidden" value="{{ $invoiceId }}" name="invoice_id"/>
                @endif
                {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            </h4>
        </div>
        <div class="col-lg-8 col-12">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="mb-sm-0 mb-6">
                        {{ Form::label('patient_id', __('messages.invoice.patient').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('patient_id', $patients, isset($invoice) ? $invoice->patient_id : null, ['class' => 'form-select', 'id' => 'patient_id', 'placeholder' => 'Select Patient','required','data-control' =>'select2']) }}
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    @if(isset($invoice))
                        <div class="">
                            {{ Form::label('invoice_date', __('messages.invoice.invoice_date').(':'),['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('invoice_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'id' => 'editInvoiceDate', 'autocomplete' => 'off','required']) }}
                        </div>
                    @else
                        <div class="">
                            {{ Form::label('invoice_date', __('messages.invoice.invoice_date').(':'),['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('invoice_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'), 'id' => 'invoice_date', 'autocomplete' => 'off','required']) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="separator separator-dashed my-10"></div>
    <div class="mb-0">
        <div class="row gx-10 mb-5">
            <div class="col-lg-6 col-sm-12">
                <div class="mb-5">
                    {{ Form::label('discount', __('messages.invoice.discount').(':'), ['class' => 'form-label']) }}
                    (%)
                    <span class="required"></span>
                    {{ Form::number('discount',  isset($invoice) ? $invoice->discount : null, ['id'=>'discount','class' => 'form-control','placeholder' => 'In percentage','required', 'min' => 0, 'max' => 100, 'step' => '.01']) }}
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="mb-5">
                    {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::select('status', $statusArr, isset($invoice) ? $invoice->status : null, ['class' => 'form-select', 'id' => 'status','required','data-control' => 'select2']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
            <button type="button" class="btn btn-primary text-star addInvoiceItem" id="addInvoiceItem"> {{ __('messages.invoice.add') }}</button>
        </div>
        <div class="table-responsive">
            <table class="table g-5 gs-0 mt-2" id="billTbl">
                <thead>
                <tr class="border-bottom fs-7 text-gray-700 text-uppercase">
                    <th class="text-center">#</th>
                    <th>{{ __('messages.account.account') }}</th>
                    <th>{{ __('messages.invoice.description') }}</th>
                    <th>{{ __('messages.invoice.qty') }}<span class="required"></span></th>
                    <th>{{ __('messages.invoice.price') }}<span class="required"></span></th>
                    <th class="text-end">{{ __('messages.invoice.amount') }}<span class="required"></span></th>
                    <th class="text-end">{{ __('messages.common.action') }}</th>
                </tr>
                </thead>
                <tbody class="invoice-item-container">
                @if(isset($invoice))
                    @php
                        $indexNumber = 1;
                    @endphp
                    @foreach($invoice->invoiceItems as $invoiceItem)
                        <tr class="border-bottom">
                            <td class="text-center pt-6 item-number">{{ $indexNumber++ }}</td>
                            <td class="table__item-desc">
                                {{ Form::select('account_id[]', $accounts, $invoiceItem->account_id, ['class' => 'form-select accountId', 'required', 'placeholder'=>'Select Account', 'data-control' => 'select2']) }}
                                {{ Form::hidden('id[]', $invoiceItem->id) }}
                            </td>
                            <td class="text-center">
                                {{ Form::text('description[]', $invoiceItem->description, ['class' => 'form-control']) }}
                            </td>
                            <td class="table__qty text-center">
                                {{ Form::number('quantity[]', $invoiceItem->quantity, ['class' => 'form-control qty','required', 'type' => 'number', "min" => 1]) }}
                            </td>
                            <td class="text-center">
                                {{ Form::text('price[]', number_format($invoiceItem->price), ['class' => 'form-control price-input price','required']) }}
                            </td>
                            <td class="amount text-center item-total pt-5 ms-2 text-nowrap">
{{--                                <span>{{ getCurrencySymbol() }}</span>--}}
                                <span class="amount item-total">{{ number_format($invoiceItem->total) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                                   class="deleteInvoiceItem btn px-1 text-danger fs-3 pe-0">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-bottom border-bottom-dashed">
                        <td class="text-center pt-5 item-number">1</td>
                        <td class="table__item-desc">
                            {{ Form::select('account_id[]', $accounts, null, ['class' => 'form-select accountId ','required','placeholder'=>'Select Account','data-control' => 'select2']) }}
                        </td>
                        <td>
                            {{ Form::text('description[]', null, ['class' => 'form-control']) }}
                        </td>
                        <td class="table__qty">
                            {{ Form::number('quantity[]', null, ['class' => 'form-control qty','required', 'type' => 'number', "min" => 1]) }}
                        </td>
                        <td>
                            {{ Form::text('price[]', null, ['class' => 'form-control price-input price','required']) }}
                        </td>
                        <td class="amount text-center item-total pt-5 text-nowrap">
                            0.00
                        </td>
                        <td class="text-end">
                            <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                               class="deleteInvoiceItem btn px-1 text-danger fs-3 pe-0">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="separator separator-dashed"></div>
        <div class="row justify-content-end">
            <div class="col-lg-4 col-md-4 col-sm-6 end justify-content-end">
                <table class="table table-responsive-sm table-row-dashed g-5 gs-0 mb-0  text-gray-700 mr-3">
                    <tbody>
                    <tr class="text-start text-muted fs-7 text-uppercase gs-0">
                        <td class="font-weight-bold ">{{ __('messages.invoice.sub_total').(':') }}</td>
                        <td class="font-weight-bold  text-end">
                            <span>{{ getCurrencySymbol() }}</span> <span id="total" class="price">
                                    {{ isset($invoice) ? number_format($invoice->amount,2) : 0 }}
                                </span>
                        </td>
                    </tr>
                    <tr class="text-start text-muted  fs-7 text-uppercase gs-0">
                        <td class="font-weight-bold ">{{ __('messages.invoice.discount').(':') }}</td>
                        <td class="font-weight-bold  text-end">
                            <span>{{ getCurrencySymbol() }}</span> <span id="discountAmount">
                                    {{ isset($invoice) ? number_format($invoice->amount * $invoice->discount / 100,2) : 0 }}
                                </span>
                        </td>
                    </tr>
                    <tr class="text-start text-muted  fs-7 text-uppercase gs-0">
                        <td class="font-weight-bold ">{{ __('messages.invoice.total').(':') }}</td>
                        <td class="font-weight-bold  text-end">
                            <span>{{ getCurrencySymbol() }}</span> <span id="finalAmount">
                                    {{ isset($invoice) ? number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100),2) : 0 }}
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Total Amount Field -->
{{ Form::hidden('amount', isset($invoice) ? number_format($invoice->amount - ($invoice->amount * $invoice->discount / 100),2) : 0, ['class' => 'form-control', 'id' => 'total_amount']) }}

<!-- Submit Field -->
<div class="d-flex justify-content-end mt-3">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3','id' => 'btnSave']) }}
    <a href="{{ route('invoices.index') }}"
       class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
</div>
