<div class="d-flex justify-content-end">
{{--    @if(checkValidCurrency($row->currency_symbol ?? getCurrentCurrency()))--}}
{{--        {{ moneyFormat($row->deductions, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}--}}
{{--    @else--}}
{{--        {{ number_format($row->deductions).''.getCurrencySymbol() }}--}}
{{--    @endif--}}
    {{ checkNumberFormat($row->deductions, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}    
</div>

