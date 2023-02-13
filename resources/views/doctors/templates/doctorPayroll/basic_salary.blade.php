<div class="text-end pe-8">
    {{ checkNumberFormat($row->basic_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
</div>

