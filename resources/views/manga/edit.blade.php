<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('common.edit_manga', ['name' => $manga->name]) }}
        </h2>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($manga, 'put', route('mangas.update', $manga))->open() }}
                @include('manga._form_fields')

                <x-button>
                    {{ __('Save') }}
                </x-button>
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
