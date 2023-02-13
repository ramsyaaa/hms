<div class="mt-2">
    @if ($row->accounts->type == 1)
        <span class="badge bg-light-danger">{{ __('messages.account.debit') }}</span>
    @else
        <span class="badge bg-light-success">{{ __('messages.account.credit') }}</span>
    @endif    
</div>

