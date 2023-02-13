<div class="text-end pe-8">
    {{ checkNumberFormat($row->basic_salary, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
</div>

