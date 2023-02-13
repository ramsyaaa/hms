@if($row->document_url)
    <a data-turbo="false" href="{{ url('document-download'.'/'.$row->id) }}" target="_blank" class="text-decoration-none">Download</a>
@else
    {{__('messages.common.n/a')}}
@endif
