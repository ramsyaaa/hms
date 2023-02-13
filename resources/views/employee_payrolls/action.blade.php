<a href="{{ route('employee-payrolls.edit',$row->id) }}" title="<?php echo __('messages.common.edit') ?>"
   class="btn px-1 text-primary fs-3 ps-0">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}" wire:key="{{$row->id}}"
   class="deleteEmpPayrollBtn btn px-1 text-danger fs-3 pe-0">
    <i class="fa-solid fa-trash"></i>
</a>
