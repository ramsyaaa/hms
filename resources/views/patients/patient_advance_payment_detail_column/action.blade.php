@if(!Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist'))
    <a href="javascript:void(0)" title="{{__('messages.common.edit') }}" data-id="{{ $row->id }}"
       class="edit-advancedPayment-btn btn px-1 text-primary fs-3 ps-0">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
        @include('partials.modal.delete_action_component_for_modal', ['id' => $row->id, 'deleteUrl' => route('advanced-payments.index'), 'message' => __('messages.advanced_payment.advanced_payment')])
@endif
