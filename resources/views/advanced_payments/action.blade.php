<a title="{{__('messages.common.edit')}}" href="javascript:void(0)" data-id="{{ $row->id }}"
   class="btn px-1 text-primary fs-3 ps-0 advance-payment-edit-btn">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a title="{{__('messages.common.delete')}}" href="javascript:void(0)" data-id="{{ $row->id }}" wire:key="{{$row->id}}"
   class="btn px-1 text-danger fs-3 pe-0 advance-payment-delete-btn">
    <i class="fa-solid fa-trash"></i>
</a>

