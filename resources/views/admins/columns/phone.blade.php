<div>
    @if(!empty($row->phone))
{{--        {{ preg_replace('/[^A-Za-z0-9\-]/', '', $row->user->phone) }}--}}
        {{ $row->phone }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>
