<div class="text-end pe-25">
    @if(!empty($row->service_tax))
        {{ checkNumberFormat($row->service_tax, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>


