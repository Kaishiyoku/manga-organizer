<div class="flex">
    @if ($manga->malItem)
        <img src="{{ $manga->malItem->image_url }}" alt="{{ $manga->name }}" class="h-48 inline-block mr-5" id="manga-image-lg-{{ $manga->id }}"/>
    @endif

    <div class="flex-grow">
        <div class="mb-4">
            <x-label for="name" :value="__('validation.attributes.name')" required/>

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $manga->name)" required/>

            <x-validation-error for="name"/>
        </div>

        <div class="mb-4">
            <x-label for="mal_id" :value="__('validation.attributes.mal_id')"/>

            <x-input id="mal_id" class="block mt-1 w-full" type="number" name="mal_id" :value="old('mal_id', $manga->mal_id)"/>

            <x-validation-error for="mal_id"/>
        </div>

        <div class="mb-4">
            <label for="is_completed" class="inline-flex items-center">
                <input id="is_completed" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-50-200 focus:ring-opacity-50" name="is_completed">
                <span class="ml-2 text-sm text-gray-600">{{ __('Completed') }}</span>
            </label>

            <x-validation-error for="is_completed"/>
        </div>
    </div>
</div>
