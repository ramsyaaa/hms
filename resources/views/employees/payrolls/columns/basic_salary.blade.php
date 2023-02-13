<div class="text-end">
    @if(!empty($row->basic_salary))
            {{ checkNumberFormat($row->basic_salary, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>
