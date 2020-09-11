<div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white px-6 py-4 mb-8">
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
        {{ Form::label('mal_title', __('validation.attributes.mal_title'), ['class' => 'label-default']) }}

        {{ Form::text('mal_title', optional($manga->malItem)->title_english, [
            'data-provide-typeahead' => true,
            'data-url' => route('mangas.search'),
            'data-target' => 'input[name="mal_id"]',
            'data-loading-indicator' => '#manga-search-loading-indicator',
            'data-target-property' => 'malId',
            'data-min-length' => 3,
            'class' => 'input-default',
        ]) }}

        <div id="manga-search-loading-indicator" class="absolute ml-3 hidden" style="margin-top: -1.8rem;">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-purple-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
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
</div>

{!! Html::decode(Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn-default'])) !!}
