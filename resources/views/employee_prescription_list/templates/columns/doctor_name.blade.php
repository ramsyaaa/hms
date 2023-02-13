<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <a href="javascript:void(0)">
            <img src="{{$row->doctor->doctorUser->image_url}}" alt="user" class="user-img object-contain rounded-circle image">
        </a>
    </div>
    <div class="d-flex flex-column">
        {{$row->doctor->doctorUser->full_name}}
        <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
    </div>
</div>
