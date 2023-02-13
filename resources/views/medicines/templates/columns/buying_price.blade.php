<div class="text-end pe-25">
    @if($row->buying_price)
        {{ checkNumberFormat($row->buying_price, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{__('messages.common.n/a')}}
    @endif    
</div>

