@if(Auth::user()->hasRole('Admin|Patient'))
    <div class="badge bg-light-info">
        <div class="mb-2">{{ \Carbon\Carbon::parse($row->invoice_date)->format('g:i A') }}</div>
        <div>{{ \Carbon\Carbon::parse($row->invoice_date)->translatedFormat('jS M, Y') }}</div>
    </div>
@elseif(Auth::user()->hasRole('Accountant'))
    <div class="badge bg-light-info">
        <div class="mb-2">{{ \Carbon\Carbon::parse($row->invoice_date)->format('g:i A') }}</div>
        <div>{{ \Carbon\Carbon::parse($row->invoice_date)->translatedFormat('jS M, Y') }}</div>
    </div>
@else
    <div class="badge bg-light-info">
        <div class="mb-2">{{ \Carbon\Carbon::parse($row->invoice_date)->format('g:i A') }}</div>
        <div>{{ \Carbon\Carbon::parse($row->invoice_date)->translatedFormat('jS M, Y') }}</div>
    </div>
@endif
