@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="card">
        <div class="card-header pb-0">
            <div class="card-title m-0">
                <h3>{{ __('messages.front_setting.terms_condition_details') }}</h3>
            </div>
        </div>
        <div class="card-body pt-3">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'termsAndCondition']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger d-none hide" id="t&cErrorsBox"></div>
            <div class="row mt-3 mb-5">
                <!-- Term condition Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('term_condition', __('messages.front_setting.terms_conditions').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    <div id="termConditionId" class="editor-height" style="height: 100px"></div>
                    {{ Form::hidden('terms_conditions', null, ['id' => 'termData']) }}
                </div>

                <!-- Privacy policy Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('privacy_policy', __('messages.front_setting.privacy_policy').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    <div id="privacyPolicyId" class="editor-height" style="height: 100px"></div>
                    {{ Form::hidden('privacy_policy', null, ['id' => 'privacyData']) }}
                </div>
            </div>
            <div class="row">
            {{Form::hidden('termConditionData',$frontSettings['terms_conditions'],['class'=>'termConditionData'])}}
            {{Form::hidden('privacyPolicyData',$frontSettings['privacy_policy'],['class'=>'privacyPolicyData'])}}
            {{Form::hidden('termConditionPrivacyPolicy',true,['id'=>'termConditionPrivacyPolicy'])}}
            <!-- Submit Field -->
                <div class="form-group col-sm-12 mb-5 d-flex justify-content-end">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
@section('scripts')
{{--  assets/js/front_settings/cms/create-edit.js --}}
@endsection
