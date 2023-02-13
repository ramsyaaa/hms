<div class="d-flex justify-content-end pe-25">
    @if(!empty($row->amount))
        {{ checkNumberFormat($row->amount, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @endif      
</div>

