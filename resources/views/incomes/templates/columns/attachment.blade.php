<div class="d-flex align-items-center mt-2">
    @if($row->document_url !== '')
        <a data-turbo="false" href="{{ url('income-download').'/'.$row->id }}" class="text-decoration-none">Download</a>
    @else
        <samp>N/A</samp>
    @endif    
</div>

