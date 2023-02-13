<div class="text-end pe-25">
    @if(!empty($row->total_amount))
        {{ checkNumberFormat($row->total_amount, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>

