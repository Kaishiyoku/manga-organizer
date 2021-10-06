<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add manga') }}
        </h2>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($manga, 'post', route('mangas.store'))->open() }}
                @include('manga._form_fields')

                <x-button>
                    {{ __('Save') }}
                </x-button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>

    <div class="px-4 sm:px-0 mt-8">
        <x-link :href="route('mangas.manage')">
            {{ __('Back') }}
        </x-link>
    </div>
</x-app-layout>
