<div class="d-flex justify-content-center pe-20">
    @if(!Empty($row->charge))
        {{ checkNumberFormat($row->charge, strtoupper($row->currency_symbol ?? getCurrentCurrency())) }}
    @else
        {{ __('messages.common.n/a') }}
    @endif
</div>

