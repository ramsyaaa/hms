{{ ($row->available_from == '00:00:00') ? __('messages.common.n/a') : date('H:i A', strtotime($row->available_from)) }}
