<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Statistics') }}
        </x-page-heading>
    </x-slot>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
        <x-card.card class="pb-4">
            <x-card.header>
                {{ __('General') }}
            </x-card.header>

            <div>
                <x-list-item :label="trans_choice('common.mangas', $mangas->count())" :value="$mangas->count()"/>
                <x-list-item :label="trans_choice('common.volumes', $volumes->count())" :value="$volumes->count()"/>
                <x-list-item :label="trans_choice('common.specials', $specials->count())" :value="$specials->count()"/>
            </div>
        </x-card.card>

        <x-card.card class="pb-4">
            <x-card.header>
                {{ __('Latest volumes and specials') }}
            </x-card.header>

            <div>
                @foreach ($latestVolumesAndSpecials as $entry)
                    <x-list-item>
                        {{ $entry->name }}
                    </x-list-item>
                @endforeach
            </div>
        </x-card.card>

        @if ($topFiveGenres->isNotEmpty())
            <x-card.card class="pb-4">
                <x-card.header>
                    {{ __('Favorite genres') }}
                </x-card.header>

                <div>
                    @foreach ($topFiveGenres as $genre)
                        <x-list-item>
                            {{ $genre->name }}
                        </x-list-item>
                    @endforeach
                </div>
            </x-card.card>
        @endif
    </div>
</x-app-layout>
