<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <a href="{{ url('doctors') . '/' . $row->doctor->id }}">
            <img src="{{$row->doctor->doctorUser->image_url}}" alt=""
                 class="user-img object-contain image rounded-circle">
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ url('doctors') . '/' . $row->doctor->id }}"
           class="text-decoration-none mb-1">{{$row->doctor->doctorUser->full_name}}</a>
        <span>{{ $row->doctor->doctorUser->email}}</span>
    </div>
</div>
