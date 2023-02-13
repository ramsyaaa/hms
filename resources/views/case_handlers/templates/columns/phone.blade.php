@if ($row->user->phone != '')
    <span>{{$row->user->phone}}</span>
@else
    {{__('messages.common.n/a')}}
@endif
