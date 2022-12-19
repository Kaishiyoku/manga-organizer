<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Manage mangas') }}
        </x-page-heading>
    </x-slot>

    <div class="px-4 sm:px-0">
        <x-button.button secondary :href="route('mangas.create')">
            <x-heroicon-s-plus/>
            <span>{{ __('Add manga') }}</span>
        </x-button.button>
    </div>

    @if ($mangas->isNotEmpty())
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 gap-x-4 gap-y-8 mt-8">
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
