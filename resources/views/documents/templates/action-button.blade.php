<div class="d-flex align-items-center">
    @if(!empty($row->media[0]))
        <a title="{{ __('messages.common.save')}}" class="btn px-1 fs-3 ps-0 text-info" href="{{url('document-download').'/'.$row->id}}" target="_blank">
            <i class="fa fa-download"></i>
        </a>
    @endif
    <a href="javascript:void(0)" title="{{__('messages.common.edit') }}" class="document-edit-btn btn px-1 text-primary fs-3 ps-0" data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" title="{{__('messages.common.delete')}}" data-id="{{ $row->id }}"
       class="document-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>

