<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage mangas') }}
        </h2>
    </x-slot>

    <div class="px-4 sm:px-0">
        <x-button-link :href="route('mangas.create')" class="mb-8">
            <x-heroicon-s-plus-circle class="w-5 h-5"/>
            <span>{{ __('Add manga') }}</span>
        </x-button-link>
    </div>

    @if ($mangas->isNotEmpty())
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8">
            @foreach ($mangas as $manga)
                <x-manga-manage-details :manga="$manga"/>
            @endforeach
        </div>
    @else
        <x-empty-info>
            {{ __('No mangas yet.') }}
        </x-empty-info>
    @endif
</x-app-layout>
