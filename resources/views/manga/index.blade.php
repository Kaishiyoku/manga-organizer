<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manga list') }}
        </h2>
    </x-slot>

    <div>
        <x-button-link :href="route('recommendations.create')">
            <x-heroicon-s-plus-circle class="w-5 h-5"/>
            <span>{{ __('Recommend me a manga') }}</span>
        </x-button-link>
    </div>

    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8 mt-8">
        @forelse ($mangas as $manga)
            <x-manga-details :manga="$manga"/>
        @empty
            <p class="italic text-gray-500 text-xl">{{ __('No mangas yet.') }}</p>
        @endforelse
    </div>
</x-app-layout>
