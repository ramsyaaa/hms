<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="{{ url('doctors',$row->doctor_id) }}">
            <img src="{{ $row->doctor->doctorUser->image_url }}" alt="user"
                 class="user-img object-contain image rounded-circle">
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ url('doctors',$row->doctor_id) }}" class="mb-1 text-decoration-none fs-6">
            {{ $row->doctor->doctorUser->full_name }}
        </a>
        <span class="fs-6">{{ $row->doctor->doctorUser->email }}</span>
    </div>
</div>
