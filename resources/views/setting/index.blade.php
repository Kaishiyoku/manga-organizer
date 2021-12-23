<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Settings') }}
        </x-page-heading>
    </x-slot>

    <x-button-link :href="route('settings.edit_password')">
        {{ __('Change password') }}
    </x-button-link>
</x-app-layout>
