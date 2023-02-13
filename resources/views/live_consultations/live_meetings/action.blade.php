<?php $patientRole = getLoggedInUser()->hasRole('Patient') ? true : false;
$doctorRole = getLoggedInUser()->hasRole('Doctor') ? true : false;
$adminRole = getLoggedInUser()->hasRole('Admin') ? true : false;
?>

@if($row->status==0)
    <a title="{{!($adminRole || $doctorRole) ? 'Join Meeting' : 'Start Meeting'}}"
       class="btn px-1 text-info fs-3 pe-0 startMeetingBtn" data-id="{{$row->id}}">
        <i class="fas fa-record-vinyl"></i>
    </a>
@endif
@if($doctorRole || $adminRole)
    @if(!($row->status == 2 ? true : false))
        <a href="javascript:void(0)" title="<?php echo __('messages.common.edit') ?>"
           class="btn px-1 text-primary fs-3 pe-0 editMeetingBtn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    @endif
    <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}"
       class="deleteMeetingBtn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
        <i class="fa-solid fa-trash"></i>
    </a>
@endif
