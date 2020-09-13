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
        {{ Form::label('mal_id', __('validation.attributes.mal_id'), ['class' => 'label-default']) }}

        {{ Form::number('mal_id', old('mal_id', $manga->mal_id), ['class' => 'input-default' . ($errors->has('mal_id') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.mal_id')]) }}

        @if ($errors->has('mal_id'))
            <p class="validation-error">
                {{ $errors->first('mal_id') }}
            </p>
        @endif

        <button type="button" data-provide-dropdown data-dropdown-target="#manga-search-dropdown" class="link-default hover:underline mt-1">
            {{ __('manga.search_on_mal') }}
        </button>

        <div id="manga-search-dropdown" class="dropdown hidden">
            <div class="flex p-2">
                <input type="text" id="manga-search-input" placeholder="{{ __('validation.attributes.mal_title') }}" class="flex-grow appearance-none rounded-l py-2 px-3 text-gray-700 bg-gray-100 leading-tight"/>
                <button
                    type="button"
                    class="btn-with-input"
                    data-provide-manga-search
                    data-url="{{ route('mangas.search') }}"
                    data-target-input="#mal_id"
                    data-manga-search-input="#manga-search-input"
                    data-manga-search-results-container="#manga-search-results"
                    disabled
                    data-dropdown="#manga-search-dropdown"
                >
                    {{ __('common.search') }}
                </button>
            </div>

            <div id="manga-search-results" class="overflow-auto" style="max-height: 20rem;"></div>
        </div>
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
