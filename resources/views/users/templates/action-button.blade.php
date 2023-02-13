<a  href="{{route('users.edit',$row->id)}}" title="{{ __('messages.common.edit')}} "
    class="btn px-1 text-primary fs-3 user-edit-btn" data-id="{{$row->id}}">
    <i class="fa-solid fa-pen-to-square"></i>
</a>

@if ($row->department->name != 'Admin')
<a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}" wire:key="{{$row->id}}"
   class="btn px-1 text-danger fs-3 user-delete-btn">
    <i class="fa-solid fa-trash"></i>
</a>
@endif
