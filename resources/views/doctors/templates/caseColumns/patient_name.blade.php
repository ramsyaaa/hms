<div class="d-flex align-items-center">
    <a href="{{route('patients.show',$row->patient->id)}}">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->patient->patientUser->image_url}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{route('patients.show',$row->patient->id)}}" class="mb-1 text-decoration-none fs-6">
            {{$row->patient->patientUser->full_name}}
        </a>
        <span class="fs-6">{{$row->patient->patientUser->email}}</span>
    </div>
</div>
