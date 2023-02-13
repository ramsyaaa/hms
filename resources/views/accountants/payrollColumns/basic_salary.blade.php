<div class="d-flex justify-content-end">
{{--    @if(checkValidCurrency($row->currency_symbol ?? getCurrentCurrency()))--}}
{{--        {{ moneyFormat($row->basic_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}--}}
{{--    @else--}}
{{--        {{ number_format($row->basic_salary).''.getCurrencySymbol() }}--}}
{{--    @endif--}}
    {{ checkNumberFormat($row->basic_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}    
</div>

