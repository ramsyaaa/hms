<div class="ms-auto" wire:ignore>
    <div class="dropdown d-flex align-items-center me-4 me-md-5">
        <button
                class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
                type="button" data-bs-auto-close="outside"
                data-bs-toggle="dropdown" aria-expanded="false"
                id="bedAssignFilterBtn">
            <i class='fas fa-filter'></i>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="bedAssignFilterBtn">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">{{ __('messages.common.filter_options') }}</h3>
            </div>
            <div class="p-5">
                <div class="mb-10">
                    <label class="form-label fs-6 fw-bold">{{ __('messages.common.status').':' }}</label>
                    {{ Form::select('account_status',$component->FilterComponent[1],null, ['id' => 'bed_assigns_filter_status', 'data-control' =>'select2', 'class' => 'form-select role-selector select2-hidden-accessible data-allow-clear="true"']) }}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" id="bedAssignResetFilter" class="btn btn-secondary">{{ __('messages.common.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
