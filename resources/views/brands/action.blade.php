<div class="d-flex justify-content-center">
    <a href="{{url('brands'.'/'. $row->id .'/edit')}}" title="<?php echo __('messages.common.edit') ?>"
       class="btn px-1 text-primary fs-3 ps-0 brand-edit-btn">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}" wire:key="{{$row->id}}"
       class="brand-delete-btn btn px-1 text-danger fs-3 ps-0">
        <i class="fa-solid fa-trash"></i>
    </a>    
</div>

