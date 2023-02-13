@if(!$row->bill_status)
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('messages.ipd_charges') }}</h3>
        </div>
        <div class="card-title">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
               data-bs-target="#addIpdChargesModal">
                {{ __('messages.ipd_patient_charges.new_charge') }}
            </a>
        </div>
    </div>
@endif
