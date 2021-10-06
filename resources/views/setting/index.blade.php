<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <x-card.card>
        <x-card.body>
            <x-button-link :href="route('settings.edit_password')">
                {{ __('Change password') }}
            </x-button-link>
        </x-card.body>
    </x-card.card>
</x-app-layout>
