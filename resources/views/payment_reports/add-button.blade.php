@if(Auth::user()->hasRole('Admin'))
    <a data-turbo="false" href="{{ route('payment.report.excel') }}" class="btn btn-primary">
        {{__('messages.common.export_to_excel')}}
    </a>
@endif
