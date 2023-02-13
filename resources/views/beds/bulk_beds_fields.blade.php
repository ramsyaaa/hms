<div class="col-sm-12">
    <div class="table-responsive-sm">
        <table class="table table-striped" id="bulkBedsTbl">
            <thead class="thead-dark">
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="text-center">#</th>
                <th>{{ __('messages.bed_assign.bed')}}<span class="required"></span></th>
            <th>{{ __('messages.bed.bed_type') }}<span class="required"></span></th>
            <th>{{ __('messages.bed.charge') }}<span class="required"></span></th>
            <th>{{ __('messages.bed.description') }}</th>
                <th class="table__add-btn-heading text-center">
                    <button type="button" class="btn btn-sm btn-primary w-100"
                            id="addNewBedItem">{{ __('messages.bed.add') }}</button>
                </th>
            </tr>
            </thead>
            <tbody class="bulk-beds-item-container text-gray-600 fw-bold">
            <tr>
                <td class="text-center item-number">1</td>
                <td class="name">
                    {{ Form::text('name[]', null, ['class' => 'form-control bedName', 'required']) }}
            </td>
            <td class="bed_type">
                {{ Form::select('bed_type[]', $bedTypes, null, ['class' => 'form-select bedType', 'id' => 'BulkBedType', 'required', 'placeholder'=>'Select Bed Type', 'data-control' => 'select2']) }}
            </td>
            <td class="rate">
                {{ Form::text('charge[]', null, ['class' => 'form-control charge price-input','required']) }}
            </td>
            <td>
                {{ Form::textarea('description[]', null, ['class' => 'form-control description','rows' => 1]) }}
            </td>
                <td class="text-center">
                    <a href="javascript:void(0)" title="{{__('messages.common.delete')}}"
                       class="delete-invoice-item btn px-2 text-danger fs-3">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-end mt-5">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2 bulk-button']) }}
    <a href="{{ route('beds.index') }}"
       class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
</div>
