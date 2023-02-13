<div class="d-flex justify-content-end">
{{--    @if(checkValidCurrency($row->currency_symbol ?? getCurrentCurrency()))--}}
{{--        {{ moneyFormat($row->allowance, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}--}}
{{--    @else--}}
{{--        {{ number_format($row->allowance).''.getCurrencySymbol() }}--}}
{{--    @endif--}}
    {{ checkNumberFormat($row->allowance, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
</div>
