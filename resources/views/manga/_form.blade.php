<div class="row">
    <div class="col-md-10">
        <div class="form-group row">
            {{ Form::label('name', __('validation.attributes.name'), ['class' => 'col-lg-12 control-label']) }}

            <div class="col-lg-12">
                {{ Form::text('name', old('name', $manga->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group row">
            {{ Form::label('mal_id', __('validation.attributes.mal_id'), ['class' => 'col-lg-12 control-label']) }}

            <div class="col-lg-12">
                {{ Form::number('mal_id', old('mal_id', $manga->mal_id), ['class' => 'form-control' . ($errors->has('mal_id') ? ' is-invalid' : '')]) }}

                @if ($errors->has('mal_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mal_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group form-check">
        {{ Form::checkbox('is_completed', true, old('is_completed', $manga->is_completed), ['id' => 'is_completed', 'class' => 'form-check-input']) }}

        {{ Form::label('is_completed', __('validation.attributes.is_completed'), ['class' => 'form-check-label']) }}

        @if ($errors->has('is_completed'))
            <div class="invalid-feedback">
                {{ $errors->first('') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-12">
        {!! Html::decode(Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary'])) !!}
    </div>
</div>