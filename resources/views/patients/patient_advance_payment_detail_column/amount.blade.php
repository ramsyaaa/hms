<div class="d-flex justify-content-end pe-25">
    {{ checkNumberFormat($row->amount, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
</div>

