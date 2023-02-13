{{--<div class="d-flex align-items-center">--}}
{{--    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">--}}
{{--        <a href="javascript:void(0)" data-id="{{ $row->id }}" class="show-btn">--}}
{{--            <div>--}}
{{--                <img src="{{$row->image_url}}" alt=""--}}
{{--                     class="user-img">--}}
{{--            </div>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="d-flex flex-column">--}}
{{--        <a href="javascript:void(0)" class="mb-1 show-user-btn" data-id="{{ $row->id }}">{{ $row->full_name }}</a>--}}
{{--        <span>{{ $row->email }}</span>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="javascript:void(0)" data-id="{{ $row->id }}" class="show-btn">
            <img src="{{$row->image_url}}" alt="user" class="user-img image rounded-circle object-contain">
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="javascript:void(0)" class="mb-1 show-user-btn text-decoration-none" data-id="{{ $row->id }}">
            {{$row->full_name}}
        </a>
        <span class="fs-6">{{$row->email}}</span>
    </div>
</div>
