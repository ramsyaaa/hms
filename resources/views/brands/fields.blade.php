<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {!! Form::label('name', __('messages.medicine.brand').':', ['class' => 'form-label']) !!}
            <span class="required"></span>
            {!! Form::text('name', null, ['id'=>'brandName','class' => 'form-control','required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {!! Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label']) !!}
            <br>
            {!! Form::tel('phone', $brand->phone ?? getCountryCode(), ['class' => 'form-control phoneNumber','id' => 'brandPhoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
            {!! Form::hidden('prefix_code',null,['class'=>'prefix_code']) !!}
            {{ Form::hidden('country_iso',null,['class'=>'country_iso']) }}
            <span class="text-success valid-msg d-none fw-400 fs-small mt-2">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="text-danger error-msg d-none fw-400 fs-small mt-2"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {!! Form::label('email', __('messages.user.email').':', ['class' => 'form-label']) !!}
            {!! Form::email('email', null, ['id'=>'brandEmail','class' => 'form-control']) !!}
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'brandSave']) }}
        <a href="{!! route('brands.index') !!}"
           class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
    </div>
</div>
