<a href="javascript:void(0)" title="<?php echo __('messages.common.view') ?>" data-id="{{ $row->id }}"
   class="notice-view-btn btn text-info px-1 fs-3 ps-0">
    <i class="fas fa-eye"></i>
</a>
@if (Auth::user()->hasRole('Admin'))
    <a href="javascript:void(0)" title="{{__('messages.common.edit') }}" data-id="{{ $row->id }}"
       class="notice-edit-btn btn px-1 text-primary fs-3 ps-0">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" title="{{__('messages.common.delete')}}" data-id="{{ $row->id }}"
       class="notice-board-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
        <i class="fa-solid fa-trash"></i>
    </a>
@endif
