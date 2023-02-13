<div class="d-flex align-items-center">
    <div class="image image-circle image-mini me-3">
        <img src="{{$row->owner->user->image_url}}" alt="user" class="user-img">
    </div>
    <div class="d-flex flex-column">
        {{$row->owner->user->full_name}}
        <span class="fs-6">{{$row->type_string}}</span>
    </div>
</div>

