<div class="d-flex align-items-center mt-2">
    @if($row->email)
        {{$row->email}}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

