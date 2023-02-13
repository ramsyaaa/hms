<div class="d-flex align-items-center mt-2">
    @if($row->user->designation)
        {{$row->user->designation}}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

