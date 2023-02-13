<div class="mt-3">
    @if(!getLoggedInUser()->hasRole('Admin'))
        <div class="badge bg-light-info">
            <div class="mb-2">{{ \Carbon\Carbon::parse($row->created_at)->isoFormat('LT')}}</div>
            <div>{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('jS M,Y')}}</div>
        </div>
    @else
        <div class="badge bg-light-info">
            {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('jS M,Y')}}
        </div>
    @endif    
</div>

