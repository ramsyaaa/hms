@if(getLoggedinPatient())
    <div class="d-flex align-items-center">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->doctor->doctorUser->image_url}}" alt="user"
                 class="user-img image rounded-circle object-contain">
        </div>
        <div class="d-flex flex-column">
            {{$row->doctor->doctorUser->full_name}}
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    </div>
@elseif(getLoggedInUser()->hasRole('Case Manager'))
    <div class="d-flex align-items-center">
        <div class="image image-circle image-mini me-3">
            <a href="{{url('employee/doctor') . '/' .$row->doctor->id}}">
                <img src="{{$row->doctor->doctorUser->image_url}}" alt=""
                     class="user-img rounded-circle object-contain" height="35" width="35">
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="{{url('employee/doctor') . '/' . $row->doctor->id}}"
               class="text-decoration-none mb-1">{{$row->doctor->doctorUser->full_name}}</a>
            <span>{{$row->doctor->doctorUser->email}}</span>
        </div>
    </div>
@else
    <div class="d-flex align-items-center">
        <div class="image image-circle image-mini me-3">
            <a href="{{route('doctors_show',$row->doctor->id)}}">
                <img src="{{$row->doctor->doctorUser->image_url}}" alt="user"
                     class="user-img image rounded-circle object-contain">
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="{{route('doctors_show',$row->doctor->id)}}" class="mb-1 text-decoration-none fs-6">
                {{$row->doctor->doctorUser->full_name}}
            </a>
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    </div>

@endif


