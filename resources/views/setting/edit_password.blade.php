<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Change password') }}
        </h2>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->form('put', route('settings.update_password'))->open() }}
                <div class="mb-4">
                    <x-label for="old_password" :value="__('validation.attributes.old_password')" required/>

                    <x-input id="old_password" class="block mt-1 w-full" type="password" name="old_password" required/>

                    <x-validation-error for="old_password"/>
                </div>

                <div class="mb-4">
                    <x-label for="new_password" :value="__('validation.attributes.new_password')" required/>

                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required/>

                    <x-validation-error for="new_password"/>
                </div>

                <div class="mb-4">
                    <x-label for="new_password_confirmation" :value="__('validation.attributes.new_password_confirmation')" required/>

                    <x-input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation" required/>

                    <x-validation-error for="new_password_confirmation"/>
                </div>

                <x-button>
                    {{ __('Save') }}
                </x-button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>
</x-app-layout>
