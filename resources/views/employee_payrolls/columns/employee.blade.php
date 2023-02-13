<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="javascript:void(0)">
            <div>
                @if($row->owner->table == 'doctors')
                    <img src="{{ $row->owner->doctorUser->image_url }}" alt=""
                         class="user-img image image-circle object-contain" height="35" width="30">
                @else
                    <img src="{{ $row->owner->user->image_url }}" alt=""
                         class="user-img image image-circle object-contain" height="35" width="30">
                @endif
{{--                <img src="{{ $row->owner->user->image_url }}" alt=""--}}
{{--                     class="user-img image image-circle object-contain" height="35" width="30">--}}
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        @if($row->owner->table == 'doctors')
            <a href="javascript:void(0)" class="mb-1 text-dark cursor-move text-decoration-none"> {{$row->owner->doctorUser->full_name}}</a>
        @else
            <a href="javascript:void(0)" class="mb-1 text-dark cursor-move text-decoration-none"> {{$row->owner->user->full_name}}</a>
        @endif
{{--            <a href="javascript:void(0)" class="mb-1 text-dark cursor-move text-decoration-none"> {{$row->owner->user->full_name}}</a>--}}
        <span class="text-gray-600">{{$row->type_string}}</span>
    </div>
</div>
