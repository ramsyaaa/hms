@if ($row->purpose == 1)
    Enquiry
@elseif ($row->purpose == 2)
    Seminar
@else
    Visit
@endif
