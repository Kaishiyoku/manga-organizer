<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-page-heading>
                {{ __('Edit social link') }}
            </x-page-heading>

            <x-delete-button :action="route('social_links.destroy', $socialLink)" class="px-2 py-1"/>
        </div>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($socialLink, 'put', route('social_links.update', $socialLink))->open() }}
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
