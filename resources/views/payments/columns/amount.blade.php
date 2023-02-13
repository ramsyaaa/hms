<div class="text-end pe-10">
    @if(!empty($row->amount))
        {{ checkNumberFormat($row->amount, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
    @endif    
</div>

