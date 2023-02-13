@if ($row->opd_diagnosis_document_url)
    <a data-turbo="false" href="{{ url('opd-diagnosis-download'.'/'.$row->id)}}"> Download
    </a>
@else
    N/A
@endif
