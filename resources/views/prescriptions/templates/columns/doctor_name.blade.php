<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="{{url('doctors'.'/'.$row->doctor->id)}}">
            <div>
                <img src="{{$row->doctor->doctorUser->image_url}}" alt=""
                     class="user-img image rounded-circle object-contain">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{route('doctors_show',$row->doctor->id)}}"
           class="mb-1 text-decoration-none">{{$row->doctor->doctorUser->full_name}}</a>
        <span>{{$row->doctor->doctorUser->email}}</span>
    </div>
</div>
