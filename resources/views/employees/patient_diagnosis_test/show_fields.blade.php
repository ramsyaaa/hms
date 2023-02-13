<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ePatientDiagnosisOverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body">
                        <div class="row mb-7">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('patient_id', __('messages.patients').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{$patientDiagnosisTest->patient->patientUser->full_name}}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('doctor_id', __('messages.doctors').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <sapn
                                    class="fs-5 text-gray-800">{{$patientDiagnosisTest->doctor->doctorUser->full_name}}</sapn>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('category_id',__('messages.diagnosis_category.diagnosis_categories').':', ['class' => 'pb-2 fs-5 text-gray-600']) }} 
                                <span
                                    class="fs-5 text-gray-800">{{$patientDiagnosisTest->category->name}}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('report_number', __('messages.patient_diagnosis_test.report_number').':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                <span
                                    class="fs-5 text-gray-800">{{$patientDiagnosisTest->report_number}}</span>
                            </div>

                            @if(isset($patientDiagnosisTests))
                                @foreach($patientDiagnosisTests as $patientDiagnosisTest)
                                    <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                        {{ Form::label($patientDiagnosisTest->property_name, str_replace("_"," ",Str::title($patientDiagnosisTest->property_name)).':', ['class' => 'pb-2 fs-5 text-gray-600']) }}
                                        <span
                                            class="fs-5 text-gray-800">{{!empty($patientDiagnosisTest->property_value)?$patientDiagnosisTest->property_value:'N/A'}}</span>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('created_at', __('messages.common.created_on').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientDiagnosisTest->created_at)) }}"
                                      class="fs-6 text-gray-800">{{ $patientDiagnosisTest->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                {{ Form::label('updated_at', __('messages.common.last_updated').':',['class'=>'pb-2 fs-5 text-gray-600']) }}
                                <span data-toggle="tooltip" data-placement="right"
                                      title="{{ date('jS M, Y', strtotime($patientDiagnosisTest->updated_at)) }}"
                                      class="fs-6 text-gray-800">{{ $patientDiagnosisTest->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
