@if($row->is_completed == 3)
    <a data-bs-toggle="tooltip" data-placement="top" data-bs-original-title=" {{__('messages.common.canceled')}} " class="btn px-1 text-danger fs-3 pe-0">
        <i class="fas fa-calendar-times text-danger"></i>
    </a>
@else
    <a data-bs-toggle="tooltip" data-placement="top" data-bs-original-title="{{ __('messages.common.cancel')}}" data-id="{{$row->id}}"
       class="cancel-appointment btn px-1 text-danger fs-3 pe-0 {{$row->is_completed == 1 ? "d-none"  : "" }}">
        <i class="far fa-calendar-times {{$row->is_completed == 1 ? "text-danger"  : "" }}"></i>
    </a>
@endif
@if (!getLoggedinPatient())
    @if ($row->is_completed == 1 || $row->is_completed == 3)
        <a title="{{ __('messages.common.confirm') }}"
           class="btn px-1 text-primary fs-3 pe-0 {{$row->is_completed == 3 ? "d-none"  : "" }}">
            <i class="fas fa-calendar-check text-success {{$row->is_completed == 3 ? "d-none"  : ""}}"></i>
        </a>
    @endif
    @if ($row->is_completed == 0)
        <a title="{{ __('messages.common.confirm') }}" data-id="{{$row->id}}" class="appointment-complete-status btn px-1 text-primary fs-3 pe-0">
            <i class="far fa-calendar-check"></i>
        </a>
    @endif
@endif
<?php if($is_role = getLoggedInUser()->hasRole(['Admin', 'Patient'])) { ?>
<a title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}"
   class="appointment-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
    <i class="fa-solid fa-trash"></i>
</a>
<?php }?>

