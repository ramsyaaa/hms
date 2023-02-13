<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="{{ route('admins.show',$row->id) }}">
            <div class="">
                <img src="{{ $row->image_url }}" alt="" class="user-img rounded-circle object-contain image" >
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ route('admins.show',$row->id) }}" class="mb-1 text-decoration-none">{{$row->full_name}}</a>
        <span>{{$row->email}}</span>
    </div>
</div>
