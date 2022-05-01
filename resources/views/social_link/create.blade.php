<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Add social link') }}
        </x-page-heading>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($socialLink, 'post', route('social_links.store'))->open() }}
                @include('social_link._form_fields')

                <x-button>
                    {{ __('Save') }}
                </x-button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>

    <div class="px-4 sm:px-0 mt-8">
        <x-link :href="route('social_links.index')">
            {{ __('Back') }}
        </x-link>
    </div>
</x-app-layout>
