<div id="addIpdPrescriptionModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl overflow-hidden">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_prescription.new_prescription') }}</h2>
                <button type="button" aria-label="Close" class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal">
                </button>
            </div>
            {{ Form::open(['id'=>'addIpdPrescriptionForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="ipdPrescriptionErrorsBox"></div>
                {{ Form::hidden('ipd_patient_department_id',$ipdPatientDepartment->id) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('header_note', __('messages.ipd_patient_prescription.header_note').':',['class' => 'form-label']) }}
                        {{ Form::textarea('header_note', null, ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 overflow-auto">
                        <div class="table-responsive mb-10 scroll-y" style="max-height: 225px">
                            <table class="table table-striped" id="ipdPrescriptionTbl">
                                <thead class="thead-dark sticky-top">
                                <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                    <th class="text-center">#</th>
                                    <th class="ipdMedicineCategory">{{ __('messages.ipd_patient_prescription.category_id') }}
                                        <span class="required"></span></th>
                                    <th class="ipdMedicineId">{{ __('messages.ipd_patient_prescription.medicine_id') }}</th>
                                    <th class="ipdDosage">{{ __('messages.ipd_patient_prescription.dosage') }}<span
                                                class="required"></span></th>
                                    <th class="ipdPrescriptionInstruction">{{ __('messages.ipd_patient_prescription.instruction') }}
                                        <span class="required"></span></th>
                                    <th class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary w-100"
                                                id="addPrescriptionItem"
                                                data-edit="0">{{ __('messages.common.add') }}</button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="ipd-prescription-item-container">
                                <tr>
                                    <td class="text-center prescription-item-number" data-item-number="1">1</td>
                                    <td>
                                        {{ Form::select('category_id[]', $medicineCategories, null, ['class' => 'form-select ipdCategoryId select2Selector','required','placeholder'=>'Select Category', 'data-id' => '1']) }}
                                    </td>
                                    <td>
                                        {{ Form::select('medicine_id[]', [null], null, ['class' => 'form-select medicineId select2Selector custom-selector', 'disabled', 'data-medicine-id' => '1','required','placeholder'=>'Select Medicine']) }}
                                    </td>
                                    <td>
                                        {{ Form::text('dosage[]', null, ['class' => 'form-control dosage', 'required', 'onkeypress' => 'return avoidSpace(event);']) }}
                                    </td>
                                    <td>
                                        {{ Form::textarea('instruction[]', null, ['class' => 'form-control instruction', 'rows' => 1,'required', 'onkeypress' => 'return avoidSpace(event);']) }}
                                    </td>
                                    <td class="text-center">
                                        <i class="fa fa-trash text-danger deleteIpdPrescription cursor-pointer"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr class="py-0 my-0 mb-3">
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('footer_note', __('messages.ipd_patient_prescription.footer_note').':',['class' => 'form-label']) }}
                        {{ Form::textarea('footer_note', null, ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnIpdPrescriptionSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
