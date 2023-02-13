<?php $patientRole = getLoggedInUser()->hasRole('Patient') ? true : false;
$doctorRole = getLoggedInUser()->hasRole('Doctor') ? true : false;
$adminRole = getLoggedInUser()->hasRole('Admin') ? true : false;
?>

@if ($row->status == 0)
    <a title="{{ ($patientRole) ? 'Join Meeting' : 'Start Meeting' }}"
       class="btn px-2 text-info fs-3 ps-0 startConsultationBtn"
       data-id="{{ $row->id }}">
        <i class="fas fa-record-vinyl"></i>
    </a>
@endif

@if ($doctorRole || $adminRole)
    @if (!($row->status == 2 ? true : false))
        <a href="javascript:void(0)" title="<?php echo __('messages.common.edit') ?>"
           class="btn px-1 text-primary fs-3 pe-0 editConsultationBtn"
           data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    @endif
    <a href="javascript:void(0)" title="<?php echo __('messages.common.delete') ?>" data-id="{{$row->id}}" class=" deleteConsultationBtn btn px-1 text-danger fs-3 pe-0 " wire:key="{{$row->id}}">
        <i class="fa-solid fa-trash"></i>
    </a>
@endif
