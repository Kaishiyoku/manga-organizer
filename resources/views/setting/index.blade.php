<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Settings') }}
        </x-page-heading>
    </x-slot>

    <x-button.button primary :href="route('settings.edit_password')">
        {{ __('Change password') }}
    </x-button.button>
</x-app-layout>
