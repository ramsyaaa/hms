<div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body border-top p-9">
                        @foreach($bedTypes as $bedType)
                            <div class="mb-lg-10 mb-5">
                                <h2 class="fs-5 text-gray-600 mb-4">{{$bedType->title}}</h2>
                                <div class="border px-lg-10 px-4 py-lg-6 py-2">
                                    <div class="row">
                                        @if(count($bedType->beds)>0)
                                            @foreach($bedType->beds as $bed)
                                                <div class="col-lg-2 col-md-3 col-6 text-center py-4">
                                                    @if(!$bed->bedAssigns->isEmpty() && !$bed->is_available && $bed->bedAssigns[0]->discharge_date == null)
                                                        <div class="dropdown dropdown-hover">
                                                            <a href="#" class="text-danger text-decoration-none">
                                                                <i class="fas fa-procedures fa-3x text-danger fa-3x"></i>
                                                            </a>
                                                            <div class="dropdown-menu border rounded-10 px-5 py-3 d-block">
                                                                <div class="py-1">
                                                                    <label class="fs-6 text-gray-800">
                                                                        {{__('messages.bed_status.bed_name')}}:
                                                                    </label>
                                                                    <span class="fs-6 text-gray-600">{{$bed->name}}</span>
                                                                </div>
                                                                <div class="py-1">
                                                                    <label class="fs-6 text-gray-800">{{__('messages.case.patient')}}
                                                                        :</label>
                                                                    <span class="fs-6 text-gray-600">{{$bed->bedAssigns[0]->patient->patientUser->full_name}}</span>
                                                                </div>
                                                                <div class="py-1">
                                                                    <label class="fs-6 text-gray-800">{{__('messages.bed_status.phone')}}
                                                                        :</label>
                                                                    <span class="fs-6 text-gray-600">{{!empty($bed->bedAssigns[0]->patient->patientUser->phone)?$bed->bedAssigns[0]->patient->patientUser->phone:'N/A'}}</span>
                                                                </div>
                                                                <div class="py-1">
                                                                    <label class="fs-6 text-gray-800">{{__('messages.bed_status.admission_date')}}
                                                                        :</label>
                                                                    <span class="fs-6 text-gray-600">{{date('jS M, Y h:i:s A', strtotime($bed->bedAssigns[0]->assign_date))}}</span>
                                                                </div>
                                                                <div class="py-1">
                                                                    <label class="fs-6 text-gray-800">{{__('messages.bed_status.gender')}}
                                                                        :</label>
                                                                    <span class="fs-6 text-gray-600">{{($bed->bedAssigns[0]->patient->patientUser->gender === 0)? 'Male' : 'Female' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pt-1">
                                                            <label
                                                                    class="text-danger">{{$bed->bedAssigns[0]->patient->patientUser->full_name}}</label>
                                                        </div>
                                                    @else
                                                        @php
                                                            $isTrue = true;
                                                        @endphp
                                                        @foreach($patientAdmissions as $patientAdmission)
                                                            @if($patientAdmission->bed->id == $bed->id && !$patientAdmission->bed->is_available && ($patientAdmission->discharge_date == null))
                                                                @php
                                                                    $isTrue = false;
                                                                @endphp
                                                                <div class="dropdown dropdown-hover">
                                                                    <a href="javascript:void(0)" class="text-danger text-decoration-none">
                                                                        <i class="fas fa-procedures fa-3x text-danger"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu border rounded-10 px-5 py-3 d-block">
                                                                        <div class="py-1">
                                                                            <label class="fs-6 text-gray-800">{{__('messages.bed_status.bed_name')}}
                                                                                :</label>
                                                                            <span class="fs-6 text-gray-600">{{$bed->name}}</span>
                                                                        </div>
                                                                        <div class="py-1">
                                                                            <label class="fs-6 text-gray-800">{{__('messages.case.patient')}}
                                                                                :</label>
                                                                            <span class="fs-6 text-gray-600">{{$patientAdmission->patient->patientUser->full_name}}</span>
                                                                        </div>
                                                                        <div class="py-1">
                                                                            <label class="fs-6 text-gray-800">{{__('messages.bed_status.phone')}}
                                                                                :</label>
                                                                            <span class="fs-6 text-gray-600">
                                                                                {{!empty($patientAdmission->patient->patientUser->phone)?$patientAdmission->patient->patientUser->phone:'N/A'}}
                                                                        </span>
                                                                        </div>
                                                                        <div class="py-1">
                                                                            <label class="fs-6 text-gray-800">{{__('messages.bed_status.admission_date')}}
                                                                                :</label>
                                                                            <span class="fs-6 text-gray-600">{{date('jS M, Y h:i:s A', strtotime($patientAdmission->admission_date))}}</span>
                                                                        </div>
                                                                        <div class="py-1">
                                                                            <label class="fs-6 text-gray-800">{{__('messages.bed_status.gender')}}
                                                                                :</label>
                                                                            <span class="fs-6 text-gray-600">
                                                                                {{($patientAdmission->patient->patientUser->gender === 0)? 'Male' : 'Female' }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="pt-1">
                                                                    <label
                                                                            class="text-danger">{{$patientAdmission->patient->patientUser->full_name}}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if($isTrue == true)
                                                            <a href="{{route('bed-assigns.create', ['bed_id' => $bed->id])}}" class="text-decoration-none">
                                                                <i class="fas fa-bed fa-3x text-success"></i>
                                                                <div>
                                                                    <span class="text-success">{{$bed->name}} </span>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="no-bed-available">
                                                <span class="fs-6 text-gray-800er fs-7">No bed available.</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

