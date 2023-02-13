<div class="d-flex justify-content-end pe-22">
    @if(!empty($row->net_salary))
            {{ checkNumberFormat($row->net_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>
