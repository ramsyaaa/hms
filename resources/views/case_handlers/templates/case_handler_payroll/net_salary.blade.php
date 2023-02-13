<div class="text-end pe-8">
{{--    @if(checkValidCurrency($row->currency_symbol ?? getCurrentCurrency()))--}}
{{--        {{ moneyFormat($row->net_salary, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}--}}
{{--    @else--}}
{{--        {{ number_format($row->net_salary) . '' . ($row->currency_symbol ? getSymbols($row->currency_symbol) : getCurrencySymbol()) }}--}}
{{--    @endif--}}
    {{ checkNumberFormat($row->net_salary, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
</div>

