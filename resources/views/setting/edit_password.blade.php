<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Change password') }}
        </x-page-heading>
    </x-slot>

    <x-card.card>
        <x-card.body>
            {{ html()->form('put', route('settings.update_password'))->open() }}
                <div class="mb-4">
                    <x-input.label for="old_password" :value="__('validation.attributes.old_password')" required/>

                    <x-input.input id="old_password" class="block mt-1 w-full" type="password" name="old_password" required/>

                    <x-input.validation-error for="old_password"/>
                </div>

                <div class="mb-4">
                    <x-input.label for="new_password" :value="__('validation.attributes.new_password')" required/>

                    <x-input.input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required/>

                    <x-input.validation-error for="new_password"/>
                </div>

                <div class="mb-4">
                    <x-input.label for="new_password_confirmation" :value="__('validation.attributes.new_password_confirmation')" required/>

                    <x-input.input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation" required/>

                    <x-input.validation-error for="new_password_confirmation"/>
                </div>

                <x-button.button primary type="submit">
                    {{ __('Save') }}
                </x-button.button>
            {{ html()->closeModelForm() }}
        </x-card.body>
    </x-card.card>
</x-app-layout>
