<div class="form-group row">
    <div class="col-lg-6">
        {{ Form::text('name', old('name', $manga->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true, 'placeholder' => 'Name']) }}

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
        {{ Html::linkRoute('mangas.index', 'Cancel', [], ['class' => 'btn btn-link']) }}
    </div>
</div>