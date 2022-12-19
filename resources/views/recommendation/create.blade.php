<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Recommend manga') }}
        </x-page-heading>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($recommendation, 'post', route('recommendations.store'))->open() }}
                <div class="mb-4">
                    <x-label for="manga" :value="__('validation.attributes.manga')" required/>

                    <x-input.input id="manga" class="block mt-1 w-full" type="text" name="manga" :value="old('manga', $recommendation->manga)" required/>

                    <x-validation-error for="manga"/>
                </div>

                <x-button.button primary type="submit">
                    {{ __('Send') }}
                </x-button.button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>
</x-app-layout>
