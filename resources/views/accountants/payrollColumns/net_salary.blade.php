<div class="d-flex justify-content-end">
{{--    @if(checkValidCurrency())--}}
{{--        {{ moneyFormat($row->net_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}--}}
{{--    @else--}}
{{--        {{ number_format($row->net_salary).''.getCurrencySymbol() }}--}}
{{--    @endif--}}
    {{ checkNumberFormat($row->net_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}    
</div>

