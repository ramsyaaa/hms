@if(empty($row->visits))
    {{ __('messages.common.n/a')}}
@else
    <span class="badge bg-light-info">{{$row->visits}}</span>
@endif

