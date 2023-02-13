<div class="text-end pe-25">
    {{ checkNumberFormat($row->standard_charge, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
</div>

