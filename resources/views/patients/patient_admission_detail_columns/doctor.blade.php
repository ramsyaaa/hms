<div class="d-flex align-items-center">
    @if(Auth::user()->hasRole('Patient|Nurse|Case Manager'))
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->doctor->doctorUser->imageUrl}}" alt="user" class="user-img">
        </div>
        <div class="d-flex flex-column">
            {{$row->doctor->doctorUser->full_name}}
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    @else
        <a href="{{url('doctors',$row->doctor->id)}}">
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->doctor->doctorUser->imageUrl}}" alt="user" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{url('doctors',$row->doctor->id)}}" class="mb-1 text-decoration-none fs-6">
                {{$row->doctor->doctorUser->full_name}}
            </a>
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    @endif
</div>
