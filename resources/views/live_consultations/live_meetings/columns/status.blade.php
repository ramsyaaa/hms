<?php
$colours = ['warning', 'danger', 'success',];
$adminRole = getLoggedInUser()->hasRole('Admin') ? true : false;
$doctorRole = getLoggedInUser()->hasRole('Patient') ? true : false;
?>

@if ($adminRole || $doctorRole)
    <div class="w-150px d-flex align-items-center">
        <span class="slot-color-dot badge bg-{{$colours[$row->status]}} badge-circle me-2"></span>
        <select class="change-meeting-status" data-id="{{ $row->id }}" data-control="select2">
            <option value="0" {{ $row->status == 0 ? 'selected' : '' }}{{ ($row->status == 1 || $row->status == 2)  ? 'disabled' : '' }}>Awaited</option>
            <option value="1" {{$row->status == 1 ? 'selected' : ''}}{{ ($row->status == 2)  ? 'disabled' : '' }}>Cancelled</option>
            <option value="2" {{ $row->status == 2 ? 'selected' : '' }}{{ ($row->status  == 1)  ? 'disabled' : '' }}>Finished</option>
        </select>
    </div>
@else
    <div class="mt-3">
        {{$row->status_text}}
    </div>
@endif
