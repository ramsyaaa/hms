<div class="text-end pe-16">
    @if(!empty($row->selling_price))
        {{ checkNumberFormat($row->selling_price, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
    @else
    {{ __('messages.common.n/a') }}
    @endif
</div>

