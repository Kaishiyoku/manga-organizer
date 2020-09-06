<div class="mb-4">
    {{ Form::label('name', __('validation.attributes.name'), ['class' => 'label-default']) }}

    {{ Form::text('name', old('name', $manga->name), ['class' => 'input-default' . ($errors->has('name') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.name')]) }}

    @if ($errors->has('name'))
        <p class="validation-error">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('mal_id', __('validation.attributes.mal_id'), ['class' => 'label-default']) }}

    {{ Form::number('mal_id', old('mal_id', $manga->mal_id), ['class' => 'input-default' . ($errors->has('mal_id') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.mal_id')]) }}

    @if ($errors->has('mal_id'))
        <p class="validation-error">
            {{ $errors->first('mal_id') }}
        </p>
    @endif
</div>

<div class="mb-4">
    <label class="inline-flex items-center text-sm text-gray-700" for="is_completed">
        {{ Form::checkbox('is_completed', true, old('is_completed', $manga->is_completed), ['id' => 'is_completed']) }}
        <span class="ml-2">{{ __('validation.attributes.is_completed') }}</span>
    </label>

    @if ($errors->has('is_completed'))
        <p class="validation-error">
            {{ $errors->first('') }}
        </p>
    @endif
</div>

{!! Html::decode(Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn-default'])) !!}
