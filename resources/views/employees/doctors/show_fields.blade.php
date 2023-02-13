<div class="card mb-5 mb-xl-10">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('doctor', __('messages.case.doctor').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{ $doctor->doctorUser->full_name }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('email', __('messages.user.email').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{ $doctor->doctorUser->email }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('doctor', __('messages.user.phone').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span
                        class="fs-5 text-gray-800">{{ !empty($doctor->doctorUser->phone) ? $doctor->doctorUser->phone : __('messages.common.n/a') }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{  $doctor->doctorUser->designation }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('department', __('messages.appointment.doctor_department').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span
                        class="fs-5 text-gray-800">{{  getDoctorDepartment($doctor->doctor_department_id) }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{  $doctor->doctorUser->qualification }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span
                        class="fs-5 text-gray-800">{{ !empty($doctor->doctorUser->blood_group) ? $doctor->doctorUser->blood_group : __('messages.common.n/a') }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span
                        class="fs-5 text-gray-800">{{ !empty($doctor->doctorUser->dob) ? \Carbon\Carbon::parse($doctor->doctorUser->dob)->format('jS M, Y') : __('messages.common.n/a') }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span
                        class="fs-5 text-gray-800">{{ $doctor->doctorUser->gender == 0 ? __('messages.user.male') : __('messages.user.female') }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('specialist', __('messages.doctor.specialist').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{ $doctor->specialist }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('status', __('messages.common.status').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span
                        class="fs-5 text-gray-800"><div
                            class="badge bg-light-{{($doctor->doctorUser->status === 1) ? 'success' : 'danger'}}">{{ ($doctor->doctorUser->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</div></span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($doctor->created_at)) }}">{{ $doctor->created_at->diffForHumans() }}</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 d-flex flex-column">
                {{ Form::label('updated on', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($doctor->updated_at)) }}">{{ $doctor->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('messages.user.address_details') }}</h3>
        </div>
    </div>

    <div>
        <div class="card-body border-top">
            <div class="row mb-7">
                <div class="col-md-4 d-flex flex-column">
                    {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                    <span
                            class="fs-5 text-gray-800">{{ !empty($doctor->address->address1) ? $doctor->address->address1 : __('messages.common.n/a') }}</span>
                </div>
                <div class="col-md-4 d-flex flex-column">
                    {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                    <span
                            class="fs-5 text-gray-800">{{ !empty($doctor->address->address2) ? $doctor->address->address2 : __('messages.common.n/a') }}</span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    {{ Form::label('city', __('messages.user.city').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                    <span
                            class="fs-5 text-gray-800">{{ !empty($doctor->address->city) ? $doctor->address->city : __('messages.common.n/a') }}</span>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                    <span
                            class="fs-5 text-gray-800">{{ !empty($doctor->address->zip) ? $doctor->address->zip : __('messages.common.n/a') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

