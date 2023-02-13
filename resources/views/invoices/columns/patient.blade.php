<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="{{ route('patients.show',$row->patient->id) }}">
            <div>
                <img src="{{ $row->patient->patientUser->image_url }}" alt=""
                     class="user-img image image-circle object-contain" width="40" height="40">
            </div>
        </a>
    </div>
    <div class="d-inline-block align-top">
        <a href="{{ route('patients.show',$row->patient->id) }}"
           class="text-primary-800 mb-1 d-block  text-decoration-none">{{ $row->patient->patientUser->full_name }}</a>
        <span class="d-block">{{ $row->patient->patientUser->email }}</span>
    </div>
</div>
