<div class="flex">
    @if ($manga->malItem)
        <img src="{{ $manga->malItem->image_url }}" alt="{{ $manga->name }}" class="h-48 inline-block mr-5" id="manga-image-lg-{{ $manga->id }}"/>
    @endif

    <div class="grow">
        <div class="mb-4">
            <x-input.label for="name" :value="__('validation.attributes.name')" required/>

            <x-input.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $manga->name)"/>

            <x-input.validation-error for="name"/>
        </div>

        <div class="mb-4">
            <x-input.label for="mal_id" :value="__('validation.attributes.mal_id')"/>

            <x-input.input id="mal_id" class="block mt-1 w-full" type="number" name="mal_id" :value="old('mal_id', $manga->mal_id)"/>

            <x-input.validation-error for="mal_id"/>
        </div>

        <div class="mb-4">
            <x-input.checkbox-with-label
                for="is_completed"
                name="is_completed"
                id="is_completed"
                :label="__('Completed')"
                :checked="old('is_completed', $manga->is_completed)"
            />

            <x-input.validation-error for="is_completed"/>
        </div>
    </div>
</div>
