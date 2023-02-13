<div class="d-flex align-items-center">
    @if(Auth::user()->hasRole('Doctor|Lab Technician|Pharmacist|Accountant'))
        <a href="{{url('employee/doctor',$row->doctor->id)}}">
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->doctor->doctorUser->imageUrl}}" alt="user" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{url('employee/doctor',$row->doctor->id)}}" class="mb-1 text-decoration-none fs-6">
                {{$row->doctor->doctorUser->full_name}}
            </a>
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    @elseif(Auth::user()->hasRole('Admin'))
        <a href="{{url('doctors/',$row->doctor->id)}}">
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->doctor->doctorUser->imageUrl}}" alt="user" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{url('doctors',$row->doctor->id)}}" class="mb-1 text-decoration-none fs-6">
                {{$row->doctor->doctorUser->full_name}}
            </a>
            <span class="fs-6">{{$row->doctor->doctoruser->email}}</span>
        </div>
    @else
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->doctor->doctorUser->imageUrl}}" alt="user" class="user-img">
        </div>
        <div class="d-flex flex-column">
            {{$row->doctor->doctorUser->full_name}}
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    @endif
</div>
