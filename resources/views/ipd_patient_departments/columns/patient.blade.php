<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <a href="{{ route('patients.show',$row->patient->id) }}">
            <img src="{{ $row->patient->patientUser->image_url }}" alt=""
                 class="user-img object-contain image rounded-circle">
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ route('patients.show',$row->patient->id) }}"
           class="text-decoration-none mb-1">{{ $row->patient->patientUser->full_name }}</a>
        <span>{{ $row->patient->patientUser->email}}</span>
    </div>
</div>
