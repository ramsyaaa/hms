<div id="add_blood_issues_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.blood_issue.new_blood_issue') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addBloodIssueForm']) }}
            {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="bloodIssueErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('issue_date', __('messages.blood_issue.issue_date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('issue_date', '', ['id'=>'bloodIssueDate','class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_id', __('messages.blood_issue.doctor_name').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select', 'required', 'id' => 'bloodIssueDoctorName', 'placeholder' => 'Select Doctor Name', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.blood_issue.patient_name').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select', 'required', 'id' => 'bloodIssuePatientName', 'placeholder' => 'Select Patient Name', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('donor_id', __('messages.blood_issue.donor_name').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('donor_id', $donors, null, ['class' => 'form-select', 'required', 'id' => 'donorName', 'placeholder' => 'Select Donor Name', 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('blood_group', __('messages.user.blood_group').(':'),['class' => 'form-label']) }}
                        {{ Form::select('blood_group', [], null, ['class' => 'form-select', 'required', 'id' => 'issuedBloodGroup', 'placeholder' => 'Select Blood Group', 'data-control' => 'select2', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('amount', __('messages.blood_issue.amount').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('amount', '', ['id'=>'bloodIssueAmount','class' => 'form-control price-input price','required', 'maxlength' => '9']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('remarks', __('messages.blood_issue.remarks').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('remarks', '', ['id' => 'bloodIssueRemarks','class' => 'form-control','rows' => 3,'cols' => 3]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-','id' => 'bloodIssueSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
