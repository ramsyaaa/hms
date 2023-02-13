<div class="text-end pe-25">
    @if($row->rate)
        {{ checkNumberFormat($row->rate, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>

