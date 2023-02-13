<div class="d-flex justify-content-end pe-12">
    {{ checkNumberFormat($row->standard_charge, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
</div>

