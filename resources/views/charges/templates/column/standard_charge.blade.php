<div class="text-end pe-25">
    @if(!empty($row->standard_charge))
        <p class="cur-margin">
            {{ checkNumberFormat($row->standard_charge, $row->currency_symbol ? strtoupper($row->currency_symbol) : strtoupper(getCurrentCurrency())) }}
        </p>
    @else
        {{ __('messages.common.n/a')}}
    @endif    
</div>


