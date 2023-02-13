@if($row->attachment_url !== null)
    <a href="{{ url('investigation-download').'/'. $row->id}}" target="_blank" class="text-decoration-none">Download</a>
@else
    <samp>N/A</samp>
@endif
