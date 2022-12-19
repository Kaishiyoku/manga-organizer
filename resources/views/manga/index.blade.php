<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Manga list') }}
        </x-page-heading>
    </x-slot>

    <div class="px-4 sm:px-0">
        @auth
            <x-button.button primary :href="route('mangas.manage')">
                <x-heroicon-s-adjustments class="w-5 h-5"/>
                <span>{{ __('Manage') }}</span>
            </x-button.button>
        @else
            <x-button.button primary :href="route('recommendations.create')">
                <x-heroicon-s-plus-circle class="w-5 h-5"/>
                <span>{{ __('Recommend me a manga') }}</span>
            </x-button.button>
        @endauth
    </div>

    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8 mt-8">
        @forelse ($mangas as $manga)
            <x-manga-details :manga="$manga"/>
        @empty
            <x-empty-info>
                {{ __('No mangas yet.') }}
            </x-empty-info>
        @endforelse
    </div>
</x-app-layout>
