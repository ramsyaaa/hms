<div class="d-flex justify-content-center mt-2">
    @if(!empty($row->policy_no))
        {{ $row->policy_no}}
    @else
        {{ __('messages.common.n/a')}}
    @endif    
</div>

