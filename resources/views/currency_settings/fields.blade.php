<!-- Currency Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency_name', 'Currency Name:') !!}
    {!! Form::text('currency_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency_icon', 'Currency Icon:') !!}
    {!! Form::text('currency_icon', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency_code', 'Currency Code:') !!}
    {!! Form::text('currency_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('currencySettings.index') }}" class="btn btn-secondary">Cancel</a>
</div>
