<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <a href="{{ route('lab-technicians.show',$row->id) }}">
            <div class="">
                <img src="{{ $row->user->image_url }}" alt="" class="user-img rounded-circle object-contain" height="40" width="40">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ route('lab-technicians.show',$row->id) }}" class="mb-1 text-decoration-none">{{ $row->user->full_name }}</a>
        <span>{{ $row->user->email }}</span>
    </div>
</div>
