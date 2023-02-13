<div class="row">
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('name', __('messages.insurance.insurance').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('name', null, ['class' => 'form-control ', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('service_tax', __('messages.insurance.service_tax').(':'), ['class' => 'form-label fs-6']) }}
        <span class="required"></span>
        {{ Form::text('service_tax', null, ['class' => 'form-control  service-tax price-input', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('discount', __('messages.insurance.discount').(': '), ['class' => 'form-label']) }}
        (In percentage (%))
        {{ Form::number('discount',  null, ['id'=>'insuranceDiscountId','class' => 'form-control discount', 'min' => 0, 'max' => 100, 'step' => '.01']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('insurance_no', __('messages.insurance.insurance_no').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('insurance_no', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('insurance_code', __('messages.insurance.insurance_code').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('insurance_code', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('hospital_rate', __('messages.insurance.hospital_rate').(':'), ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('hospital_rate', null, ['class' => 'form-control hospital-rate price-input', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('remark', __('messages.insurance.remark').(':'), ['class' => 'form-label']) }}
        {{ Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 4]) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label fs-6 fw-']) }}
        <div class="form-check form-switch">
            <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox" value="1"
                   tabindex="8" {{(!isset($insurance)) ? 'checked':(($insurance->status) ? 'checked' : '')}}>
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="row">
            <div class="col-lg-8 mb-3 h5">
                {{ __('messages.insurance.disease_details') }}    
            </div>
            <div class="col-lg-4">
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary text-star" id="addInsuranceItem">{{ __('messages.common.add') }}</button>
                </div>
            </div>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-striped" id="insuranceBillTbl">
                <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="text-center">#</th>
                    <th class="insurance-name form-label fs-6 fw-bolder text-gray-700 mb-3'">{{ __('messages.insurance.diseases_name') }}
                        <span
                            class="required"></span></th>
                    <th class="insurance-name form-label fs-6 fw-bolder text-gray-700 mb-3'">{{ __('messages.insurance.diseases_charge') }}
                        <span
                            class="required"></span></th>
                    <th class="table__add-btn-heading text-center form-label fs-6 fw-bolder text-gray-700 mb-3">
                        {{ __('messages.common.action') }}
                    </th>
                </tr>
                </thead>
                <tbody class="disease-item-container">
                @if(isset($diseases))
                    @foreach($diseases as $disease)
                        <tr>
                            <td class="text-center item-number">{{ $loop->iteration }}</td>
                            <td>
                                {{ Form::text('disease_name[]', $disease->disease_name, ['class' => 'form-control disease-name ','required']) }}
                            </td>
                            <td>
                                {{ Form::text('disease_charge[]', $disease->disease_charge,
                                                        ['class' => 'form-control  disease-charge  price-input','required']) }}
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                                   class="delete-disease btn px-1 text-danger fs-3 pe-0">
                                    <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center item-number">1</td>
                    <td>
                        {{ Form::text('disease_name[]', null, ['class' => 'form-control  disease-name','required']) }}
                    </td>
                    <td>
                        {{ Form::text('disease_charge[]', null, ['class' => 'form-control      disease-charge price-input','required']) }}
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                           class="delete-disease btn px-1 text-danger fs-3 pe-0">
                                <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endif
                </tbody>
            </table>
            <div class="float-end p-0 mb-3">
                <table>
                    <tbody>
                    <tr>
                        <td class="font-weight-bold form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.insurance.total_amount').(':') }}</td>
                        <td class="text-right">
                            <span id="insuranceTotal" class="totalAmount ms-2">{{ isset($insurance) ? getCurrencySymbol() . '' . number_format($insurance->total,2) : getCurrencySymbol() . '' . 0 }}
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Total Amount Field -->
    {{ Form::hidden('total', null, ['class' => 'form-control', 'id' => 'insuranceTotal_amount']) }}
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id'=>'insuranceSaveBtn']) }}
        <a href="{{ route('insurances.index') }}"
           class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
