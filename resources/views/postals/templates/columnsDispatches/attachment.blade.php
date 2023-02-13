@if ($row->document_url != '')
    <a data-turbo="false" href="{{url('receives'.'/'.$row->id)}}" class="text-decoration-none" target="_blank">Download</a>
@else
    N/A
@endif
