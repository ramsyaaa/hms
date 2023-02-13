@if ($row->ipd_payment_document_url != '')
    <a data-turbo="false" href="{{ url('ipd-payment-download').'/'.$row->id }}" class="text-decoration-none">Download</a>
@else
    {{__('messages.common.n/a') }}
@endif
