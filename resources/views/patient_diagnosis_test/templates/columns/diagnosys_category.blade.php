<div class="d-flex align-items-center mt-2">
    @if(getLoggedinPatient())
        {{ $row->category->name}}
    @else
        <a href="{{ route('diagnosis.category.show',$row->category->id) }}" class="text-decoration-none">{{ $row->category->name}} </a>
    @endif    
</div>

