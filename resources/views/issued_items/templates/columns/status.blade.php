<a title="{{($row->status == 0) ? 'Return Item' : 'Returned'}}" href="javascript:void(0)" class="badge action-btn bg-{{($row->status == 0)
                    ? 'light-info'
                    : 'light-primary'}} btn-sm changes-status-btn text-decoration-none" data-id="{{$row->id}}"
   data-status="{{$row->status}}">
    {{($row->status == 0) ? 'Return Item' : 'Returned'}}
</a>
