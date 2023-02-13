<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <a href="{{ route('nurses.show',$row->id) }}">
            <div class="">
                <img src="{{ $row->user->image_url }}" alt="" class="user-img rounded-circle object-contain">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ route('nurses.show',$row->id) }}" class="text-decoration-none mb-1">{{ $row->user->full_name }}</a>
        <span>{{ $row->user->email }}</span>
    </div>
</div>
