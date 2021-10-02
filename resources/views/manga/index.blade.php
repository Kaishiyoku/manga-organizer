<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manga list') }}
        </h2>
    </x-slot>

    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8">
        @forelse ($mangas as $manga)
            <x-manga-details :manga="$manga"/>
        @empty
            <p class="italic text-gray-500 text-xl">{{ __('No mangas yet.') }}</p>
        @endforelse
    </div>
</x-app-layout>
