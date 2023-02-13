<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <a href="javascript:void(0)">
            <img src="{{$row->doctor->doctorUser->image_url}}" alt=""
                 class="user-img object-contain rounded-circle image">
        </a>
    </div>
    <div class="d-flex flex-column">
        <span class="mb-1 text-dark">{{$row->doctor->doctorUser->full_name}}</span>
        <span>{{$row->doctor->doctorUser->email}}</span>
    </div>
</div>
