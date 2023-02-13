<div class="d-flex align-items-center">
    <a href="javascript:void(0)" title="{{__('messages.common.edit') }}" data-id="{{ $row->id }}"
       class="edit-vaccination-btn btn px-1 text-primary fs-3 ps-0">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    @include('partials.modal.delete_action_component_for_modal', ['id' => $row->id, 'deleteUrl' => route('vaccinated-patients.index'), 'message' => __('messages.vaccination.vaccinations')])
</div>
