@if($row->created_at !== null )
    <div class="badge bg-light-info">
        {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('jS M,Y')}}
    </div>
@else
    {{__('messages.common.n/a')}}
@endif
