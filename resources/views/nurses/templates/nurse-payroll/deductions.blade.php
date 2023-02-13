<div class="text-end pe-8">
    {{ checkNumberFormat($row->deductions, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
</div>

