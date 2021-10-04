<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics') }}
        </h2>
    </x-slot>

    <div class="grid lg:grid-cols-2 gap-4">
        <x-card.card>
            <x-card.header>
                {{ __('General') }}
            </x-card.header>
            <x-card.body>
                <div>{{ trans_choice('common.mangas', $mangas->count()) }}: {{ $mangas->count() }}</div>
                <div>{{ trans_choice('common.volumes', $volumes->count()) }}: {{ $volumes->count() }}</div>
                <div>{{ trans_choice('common.specials', $specials->count()) }}: {{ $specials->count() }}</div>
            </x-card.body>
        </x-card.card>

        <x-card.card>
            <x-card.header>
                {{ __('Latest volumes and specials') }}
            </x-card.header>
            <x-card.body>
                @foreach ($latestVolumesAndSpecials as $entry)
                    <div>{{ Arr::get($entry, 'name') }}</div>
                @endforeach
            </x-card.body>
        </x-card.card>
    </div>
</x-app-layout>
