<div class="text-end">
    @if(!empty($row->net_salary))
            {{ checkNumberFormat($row->net_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>
