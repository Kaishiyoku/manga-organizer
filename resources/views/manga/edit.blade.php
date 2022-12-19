<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('common.edit_manga', ['name' => $manga->name]) }}
        </x-page-heading>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($manga, 'put', route('mangas.update', $manga))->open() }}
                @include('manga._form_fields')

                <x-button.button primary type="submit" class="mt-2">
                    {{ __('Save') }}
                </x-button.button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>

    <div class="grid md:grid-cols-2 gap-4 mt-8 ">
        @include('manga._volumes')

        @include('manga._specials')
    </div>

    <div class="px-4 sm:px-0 mt-8">
        <x-link :href="route('mangas.manage')">
            {{ __('Back') }}
        </x-link>
    </div>
</x-app-layout>
