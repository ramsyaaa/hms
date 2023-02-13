<div class="text-end">
    @if(!empty($row->deductions))
            {{ checkNumberFormat($row->deductions, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>
