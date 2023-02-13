<div class="d-flex align-items-center">
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <a href="{{ route('patients.show',$row->id) }}">
            <div>
                <img src="{{$row->image_url}}" alt=""
                     class="user-img">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{ route('patients.show',$row->id) }}"
           class="mb-1">{{ $row->patient->user->full_name }}</a>
        <span>{{ $row->patient->user->email }}</span>
    </div>
</div>
