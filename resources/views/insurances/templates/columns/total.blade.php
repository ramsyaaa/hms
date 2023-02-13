<div class="text-end pe-25">
    @if(!empty($row->total))
        @if(checkValidCurrency($row->currency_symbol))
            {{ moneyFormat($row->total, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
        @else
            {{ number_format($row->total) . '' . ($row->currency_symbol ? getSymbols($row->currency_symbol) : getCurrencySymbol()) }}
        @endif
    @else
        {{ __('messages.common.n/a') }}
    @endif    
</div>

