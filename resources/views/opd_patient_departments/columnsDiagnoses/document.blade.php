@if ($row->opd_diagnosis_document_url != '')
    <a data-turbo="false" href="{{ url('opd-diagnosis-download'.'/'.$row->id)}}" class="text-decoration-none"> Download
    </a>
@else
    N/A
@endif
