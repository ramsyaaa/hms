<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="doctorDepartmentOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('title', __('messages.appointment.doctor_department').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{{ $doctorDepartment->title }}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('created at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($doctorDepartment->created_at)) }}">{{ $doctorDepartment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-md-4 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('updated at', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800" data-placement="top"  data-bs-original-title="{{ date('jS M, Y', strtotime($doctorDepartment->updated_at)) }}">{{ $doctorDepartment->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-column">
                                {{ Form::label('description', __('messages.doctor_department.description').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span class="fs-5 text-gray-800">{!! (!empty($doctorDepartment->description)) ? nl2br(e($doctorDepartment->description)) : __('messages.common.n/a') !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="fs-5 m-0">{{ __('messages.doctors') }}</h1>
        </div>
        <livewire:department-doctor-table doctorDepartmentId="{{$doctorDepartment->id}}"/>
    </div>
</div>
