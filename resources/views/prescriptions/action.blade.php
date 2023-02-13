<a href="{{url('prescriptions'.'/'.$row->id.'/view')}}"  title="<?php echo __('messages.common.view') ?>"
   class="btn px-1 text-info fs-3">
    <i class="fas fa-eye"></i>
</a>
<a href="{{url('prescriptions'.'/'.$row->id.'/edit')}}" title="<?php echo __('messages.common.edit') ?>"
   class="btn px-1 text-primary fs-3 ps-0  edit-prescription-btn">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}" wire:key="{{$row->id}}"
   class="delete-prescription-btn btn px-1 text-danger fs-3 ps-0 ">
    <i class="fa-solid fa-trash"></i>
</a>
