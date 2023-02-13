<div class="text-end pe-8">
    {{ checkNumberFormat($row->deductions, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
</div>

