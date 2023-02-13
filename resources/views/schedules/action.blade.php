<a href="{{url('schedules'. '/' . $row->id)}}" title="<?php echo __('messages.common.view') ?>"
   class="btn px-1 text-info fs-3 ps-0">
    <i class="fas fa-eye"></i>
</a>
<a href="{{url('schedules'. '/' . $row->id . '/edit')}}" title="<?php echo __('messages.common.edit') ?>"
   class="btn px-1 text-primary fs-3 ps-0">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}" wire:key="{{$row->id}}"
   class="delete-schedule-btn btn px-1 text-danger fs-3 ps-0">
    <i class="fa-solid fa-trash"></i>
</a>
