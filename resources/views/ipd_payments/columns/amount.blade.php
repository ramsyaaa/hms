<div class="d-flex justify-content-end pe-25">
    @if($row->amount)
        {{ checkNumberFormat($row->amount, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
    {{ __('messages.common.n/a') }}
    @endif
</div>
