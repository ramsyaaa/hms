<div class="row">
    {{ Form::hidden('currency_symbol', getCurrentCurrency(), ['class' => 'currencySymbol']) }}
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('name', __('messages.package.service').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('name', null, ['class' => 'form-control ','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('quantity', __('messages.service.quantity').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('quantity', null, ['class' => 'form-control ', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '5','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-5">
            {{ Form::label('rate', __('messages.service.rate').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('rate', null, ['class' => 'form-control price-input ', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '7','required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control ']) }}
        </div>
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'form-label']) }}
        <div class="form-check form-switch">
            <input class="form-check-input w-35px h-20px is-active" name="status" type="checkbox"
                   value="1" {{(!isset($service)) ? 'checked':(($service->status) ? 'checked' : '')}}>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2', 'id' => 'serviceBtnSave']) }}
        <a href="{{ route('services.index') }}"
           class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
