<div class="badge bg-light-info">
    {{ \Carbon\Carbon::parse($row->issued_date)->translatedFormat('jS M,Y')}}
</div>
