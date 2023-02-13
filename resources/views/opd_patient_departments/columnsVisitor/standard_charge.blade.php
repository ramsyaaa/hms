<div class="text-end pe-16">
    {{ checkNumberFormat($row->standard_charge, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
</div>
