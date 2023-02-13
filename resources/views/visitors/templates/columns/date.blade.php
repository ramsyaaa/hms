@if ($row->date === null) 
N/A
@else
<div class="badge bg-light-info">
    {{ \Carbon\Carbon::parse($row->date)->translatedFormat('jS M,Y')}}
</div>
@endif
