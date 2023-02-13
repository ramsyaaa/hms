<div class="text-end pe-8">
    {{ checkNumberFormat($row->allowance, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
</div>

