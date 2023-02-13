<a href="{{ route('bills.edit',$row->id) }}" title="<?php echo __('messages.common.edit') ?>"
   class="btn px-1 text-primary fs-3 ps-0 bill-edit-btn">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}"
   class="bill-delete-btn  btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
    <i class="fa-solid fa-trash"></i>
</a>
