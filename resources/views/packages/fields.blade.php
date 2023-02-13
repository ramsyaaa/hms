<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="form-group mb-5">
            {{ Form::label('name', __('messages.package.package').(':'),['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group mb-5">
            {{ Form::label('discount', __('messages.package.discount').(':'),['class' => 'form-label']) }}
            <span class="required"></span>
            (%)
                {{ Form::number('discount',  null, ['id'=>'packageDiscountId','class' => 'form-control package-discount', 'min' => 0, 'max' => 100, 'step' => '.01', 'placeholder' => 'In percentage', 'required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.package.description').(':'),['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
        </div>
    </div>

    {{-- Package Service Dynamic Table layout start --}}

    <div class="col-sm-12">
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end mb-4">
            <button type="button" class="btn btn-primary text-star" id="addPackageItem">{{ __('messages.common.add') }}</button>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-striped" id="packageBillTbl">
                <thead class="thead-dark">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="text-center">#</th>
                    <th class="">{{ __('messages.package.service') }} <span class="required"></span></th>
                    <th class="">{{ __('messages.package.qty') }} <span class="required"></span></th>
                    <th class="">{{ __('messages.package.rate') }} <span class="required"></span></th>
                    <th class="">{{ __('messages.package.amount') }}</th>
                    <th class="table__add-btn-heading text-center form-label fw-bolder text-gray-700 mb-3">
                        {{ __('messages.common.action') }}
                    </th>
                </tr>
                </thead>
                <tbody class="package-service-item-container">
                @if(isset($package))
                    @foreach($package->packageServicesItems as $packageServiceItem)
                        <tr>
                            <td class="text-center text-gray-700 item-number">{{ $loop->iteration }}</td>
                            <td class="table__item-desc">
                                {{ Form::select('service_id[]', $servicesList, $packageServiceItem->service_id, ['class' => 'form-select select2Selector serviceId','data-control' => 'select2','required', 'placeholder' => __('messages.package.select_service')]) }}
                                {{ Form::hidden('id[]', $packageServiceItem->id) }}
                            </td>
                            <td class="table__qty service-qty">
                                {{ Form::number('quantity[]', $packageServiceItem->quantity, ['class' => 'form-control text-gray-700 qty','required']) }}
                            </td>
                            <td class="service-price">
                                {{ Form::text('rate[]', number_format($packageServiceItem->rate), ['class' => 'form-control text-gray-700 price-input price','required']) }}
                            </td>
                            <td class="amount text-right item-total text-gray-700">
                                {{ number_format($packageServiceItem->amount) }}
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                               class="delete-service-package-item btn px-1 text-danger fs-3 pe-0">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center item-number">1</td>
                    <td class="table__item-desc">
                        {{ Form::select('service_id[]', $servicesList, null, ['class' => 'form-select serviceId','required','data-control' => 'select2', 'placeholder' => __('messages.package.select_service')]) }}
                    </td>
                    <td class="table__qty service-qty">
                        {{ Form::number('quantity[]', null, ['class' => 'form-control qty','required']) }}
                    </td>
                    <td class="service-price">
                        {{ Form::text('rate[]', null, ['class' => 'form-control price-input price','required']) }}
                    </td>
                    <td class="amount text-right item-total">
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                           class="delete-service-package-item btn px-1 text-danger fs-3 pe-0">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="float-end p-0 mb-3">
            <table>
                <tbody>
                <tr>
                    <td class="font-weight-bold form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.package.total_amount').(':') }}</td>
                    <td class="text-right">
                        <span id="packageTotal" class="packagePrice ms-2">
                            {{ isset($package) ? getCurrencySymbol() . '' . number_format($package->total_amount,2) : getCurrencySymbol() . '' . 0 }}
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Package Service Dynamic Table layout end --}}

<!-- Total Amount Field -->
    {{ Form::hidden('total_amount', null, ['class' => 'form-control', 'id' => 'packageTotal_amount']) }}

    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id'=>'packageSaveBtn']) }}
        <a href="{{ route('packages.index') }}"
           class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
