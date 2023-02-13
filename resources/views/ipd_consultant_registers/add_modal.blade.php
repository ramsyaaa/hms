<div id="addConsultantInstructionModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl overflow-hidden">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_consultant_register.new_consultant_register') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                </button>
            </div>
            {{ Form::open(['id'=>'addIpdConsultantNewForm']) }}
            <div class="modal-body ipdConsultantModel">
                <div class="alert alert-danger d-none hide" id="ipdConsultantErrorsBox"></div>
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="col-sm-12 overflow-auto">
                        <div class="table-responsive mb-10  scroll-y" style="max-height: 600px">
                            <table class="table table-striped"
                                   id="ipdConsultantInstructionTbl">
                                <thead class="consultant-table-theme sticky-top">
                                <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                    <th class="min-w-50px w-50px text-center">#</th>
                                    <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.applied_date') }}
                                    <span class="required"></span></th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.doctor_id') }}
                                    <span class="required"></span></th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.instruction_date') }}
                                    <span class="required"></span></th>
                                <th class="min-w-200px w-475px">{{ __('messages.ipd_patient_consultant_register.instruction') }}
                                    <span class="required"></span></th>
                                <th class="min-w-75px w-75px text-end">
                                    <button type="button" class="btn btn-sm btn-primary w-100"
                                            id="addIpdConsultantItem">{{ __('messages.common.add') }}</button>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="ipd-consultant-item-container">
                            <tr>
                                <td class="text-center item-number consultant-table-td">1</td>
                                <td class="consultant-table-td position-relative">
                                    {{ Form::text('applied_date[]', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control appliedDate ' : 'bg-white form-control appliedDate'), 'autocomplete' => 'off', 'required']) }}
                                </td>
                                <td class="consultant-table-td">
                                    {{ Form::select('doctor_id[]', $doctors, null, ['class' => 'form-select doctorId select2Selector','required','placeholder'=>'Select Doctor']) }}
                                </td>
                                <td class="consultant-table-td position-relative">
                                    {{ Form::text('instruction_date[]', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control cursor-pointer instructionDate' : 'bg-white form-control cursor-pointer instructionDate'), 'autocomplete' => 'off', 'required']) }}
                                </td>
                                <td class="consultant-table-td">
                                    {{ Form::textarea('instruction[]', null, ['class' => 'form-control', 'onkeypress' => 'return avoidSpace(event);', 'rows' => 1, 'required']) }}
                                </td>
                                <td class="text-center consultant-table-td">
                                    <i class="fa fa-trash text-danger align-items-center deleteIpdConsultantInstruction pointer"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-2','id'=>'btnIpdConsultantSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
