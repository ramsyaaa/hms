@if($row->payment_mode!=3)
    <a title="<?php echo __('messages.common.edit') ?>" data-id="{{$row->id}}" class="btn px-1 text-primary fs-3 ps-0 ipdpayment-edit-btn">
    <i class="fa-solid fa-pen-to-square"></i>
    </a>
@endif
<a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}" wire:key="{{$row->id}}"
   class="ipdpayment-delete-btn btn px-1 text-danger fs-3 ps-0">
    <i class="fa-solid fa-trash"></i>
</a>
