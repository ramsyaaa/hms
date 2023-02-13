@if($row->ipd_diagnosis_document_url != '')
    <a data-turbo="false" href="{{ url('ipd-diagnosis-download').'/'.$row->id }}">Download</a>
@else
    {{ __('messages.common.n/a') }}
@endif
