<div class="d-flex justify-content-center">
    <a title="{{__('messages.common.edit')}}" data-id="{{ $row->id }}"
       class="btn px-1 text-primary fs-3 ps-0 currency-edit-btn">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a title="{{__('messages.common.delete')}}" href="javascript:void(0)" data-id="{{ $row->id }}" wire:key="{{$row->id}}"
       class="btn px-1 text-danger fs-3 ps-0 currency-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>

