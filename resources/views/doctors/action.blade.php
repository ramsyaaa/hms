<a href="{{url('doctors'. '/'.$row->id.'/edit')}}" title="{{__('messages.common.edit') }}"
   class="btn px-1 text-primary fs-3 ps-0 doctor-edit-btn">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" title="{{__('messages.common.delete')}}" data-id="{{ $row->id }}" wire:key="{{$row->id}}"
   class="doctor-delete-btn btn px-1 text-danger fs-3 ps-0">
    <i class="fa-solid fa-trash"></i>
</a>
