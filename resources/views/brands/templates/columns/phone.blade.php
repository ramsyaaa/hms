<div class="d-flex align-items-center mt-2">
    @if($row->phone)
        {{$row->phone}}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

