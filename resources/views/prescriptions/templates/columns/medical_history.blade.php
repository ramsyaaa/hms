<div class="d-flex align-items-center mt-2">
    @if($row->medical_history)
        {{$row->medical_history}}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

