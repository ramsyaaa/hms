<?php $checkLabTechnicianRole = (Auth::user()->hasRole('Lab Technician')) ? true : false; ?>
<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="{{route('patients.show', $row->patient->id)}}">
            <img src="{{$row->patient->patientUser->image_url}}" alt="user"
                 class="user-img rounded-circle object-contain">
        </a>
    </div>
    @if ($checkLabTechnicianRole)
        <div class="d-flex flex-column">
            <a href="javascript:void(0)" class="mb-1 text-decoration-none fs-6">
                {{$row->patient->patientUser->full_name}}
            </a>
            <span class="fs-6">{{$row->patient->patientUser->email}}</span>
        </div>
    @else
        <div class="d-flex flex-column">
            <a href="{{ route('patients.show',$row->patient->id) }}" class="mb-1 text-decoration-none fs-6">
                {{$row->patient->patientUser->full_name}}
            </a>
            <span class="fs-6">{{$row->patient->patientUser->email}}</span>
        </div>
    @endif
</div>
