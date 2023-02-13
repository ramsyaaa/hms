<div class="mt-4">
    @if(!empty($row->user->phone))
        {{$row->user->phone}}
    @else
        {{ __('messages.common.n/a') }}
    @endif    
</div>

