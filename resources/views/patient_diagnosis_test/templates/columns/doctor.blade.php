@if(getLoggedinPatient())
    <div class="d-flex align-items-center">
        <div class="image image-mini me-3">
            <a href="javascript:void(0)">
                <img src="{{$row->doctor->doctorUser->image_url}}" alt="user"
                     class="user-img image rounded-circle object-contain">
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="javascript:void(0)" class="mb-1 text-decoration-none fs-6">
                {{$row->doctor->doctorUser->full_name}}
            </a>
            <span class="fs-6">{{$row->doctor->doctoruser->email}}</span>
        </div>
    </div>
    {{--    <div class="d-flex align-items-center">--}}
    {{--        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">--}}
    {{--            <div>--}}
    {{--                <img src="{{$row->doctor->user->image_url}}" alt=""--}}
    {{--                     class="user-img" >--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="d-flex flex-column">--}}
    {{--            <div class="mb-1 text-dark">{{$row->doctor->user->full_name}}</div>--}}
    {{--            <span class="text-dark">{{$row->doctor->user->email}}</span>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@else
    <div class="d-flex align-items-center">
        <div class="image image-mini me-3">
            <a href="{{ (Auth::user()->hasRole('Lab Technician')) ? url('employee/doctor') .'/'. $row->doctor->id : url('doctors') . '/' . $row->doctor->id }}">
                <img src="{{$row->doctor->doctorUser->image_url}}" alt="user" class="user-img rounded-circle object-contain">
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="{{ (Auth::user()->hasRole('Lab Technician')) ? url('employee/doctor') .'/'. $row->doctor->id : url('doctors') . '/' . $row->doctor->id }}"
               class="mb-1 text-decoration-none fs-6">
                {{$row->doctor->doctorUser->full_name}}
            </a>
            <span class="fs-6">{{$row->doctor->doctorUser->email}}</span>
        </div>
    </div>
    {{--    <div class="d-flex align-items-center">--}}
    {{--        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">--}}
    {{--            <a href="{{ (Auth::user()->hasRole('Lab Technician')) ? url('employee/doctor') .'/'. $row->id : url('doctors') . '/' . $row->doctor->id }}">--}}
    {{--                <div>--}}
    {{--                    <img src="{{$row->doctor->user->image_url}}" alt=""--}}
    {{--                         class="user-img" >--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--        <div class="d-flex flex-column">--}}
    {{--            <a href="{{ (Auth::user()->hasRole('Lab Technician')) ? url('employee/doctor') .'/'. $row->id : url('doctors') . '/' . $row->doctor->id }}"--}}
    {{--               class="mb-1">{{$row->doctor->user->full_name}}</a>--}}
    {{--            <span>{{$row->doctor->user->email}}</span>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endif



