<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="scheduleOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{$schedule->doctor->doctorUser->full_name}}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('per_patient_time', __('messages.schedule.per_patient_time').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ date('H:i', strtotime($schedule->per_patient_time))}}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('created_on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($schedule->created_at)) }}">{{ $schedule->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('last_updated', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($schedule->updated_at)) }}">{{ $schedule->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.schedule_label') }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="showAccountInvoice"
                       class="table table-striped">
                    <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th>{{ __('messages.schedule.available_on') }}</th>
                        <th>{{ __('messages.schedule.available_from') }}</th>
                        <th>{{ __('messages.schedule.available_to') }}</th>
                    </tr>
                    </thead>
                    <tbody class="fw-bold">
                    @forelse($scheduleDays as $scheduleDay)
                        <tr>
                            <td>{{ $scheduleDay->available_on }}</td>
                            <td>{{ ($scheduleDay->available_from == '00:00:00') ? __('messages.common.n/a') : date('H:i A', strtotime($scheduleDay->available_from)) }}</td>
                            <td>{{ ($scheduleDay->available_to == '00:00:00') ? __('messages.common.n/a') : date('H:i A', strtotime($scheduleDay->available_to)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center"
                                colspan="3">{{__('messages.common.no_data_available')}}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
