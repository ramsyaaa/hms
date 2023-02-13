<div id="edit_doctor_departments_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.doctor_department.edit_doctor_department') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editDoctorDepartmentForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editDoctorDepartmentErrorsBox"></div>
                <div class="row">
                    {{ Form::hidden('doctor_department_id',null,['id'=>'doctorDepartmentId']) }}
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('title', __('messages.appointment.doctor_department').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('title', null, ['class' => 'form-control','required','id' =>'editDoctorDepartmentTitle']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.doctor_department.description').(':'),['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control' ,'rows' => '5','id' =>'editDoctorDepartmentDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editDoctorDepartmentSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
