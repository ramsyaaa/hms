<div class="text-end pe-25">
    {{ checkNumberFormat($row->fee, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
</div>
