<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recommend manga') }}
        </h2>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->modelForm($recommendation, 'post', route('recommendations.store'))->open() }}
                <div class="mb-4">
                    <x-label for="manga" :value="__('validation.attributes.manga')" required/>

                    <x-input id="manga" class="block mt-1 w-full" type="text" name="manga" :value="old('manga', $recommendation->manga)" required/>

                    <x-validation-error for="manga"/>
                </div>

                <x-button>
                    {{ __('Send') }}
                </x-button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>
</x-app-layout>
