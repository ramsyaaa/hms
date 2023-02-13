<div class="w-100px">
    <a title="<?php echo __('messages.common.edit') ?>" href="{{url('opds'.'/'.$value['data-id'].'/edit')}}"
       class="btn px-1 text-primary fs-3 ps-0 edit-opd-patient-btn">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    @if($value['visitors_id'] != $value['data-id'])
        <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$value['data-id']}}"
           wire:key="{{$value['data-id']}}"
           class="delete-visit-btn btn px-1 text-danger fs-3 ps-0">
            <i class="fa-solid fa-trash"></i>
        </a>
    @endif
</div>
