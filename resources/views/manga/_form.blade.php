<div class="form-group row">
    {{ Form::label('name', __('validation.attributes.name'), ['class' => 'col-lg-12 control-label']) }}

    <div class="col-lg-6">
        {{ Form::text('name', old('name', $manga->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3">
        {{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>

    <div class="col-md-3 text-right">
        {{ Html::linkRoute('mangas.manage', __('common.cancel'), [], ['class' => 'btn btn-link']) }}
    </div>
</div>