<div class="text-end pe-4">
    @if(!empty($row->standard_charge))
        {{ checkNumberFormat($row->standard_charge, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif    
</div>

