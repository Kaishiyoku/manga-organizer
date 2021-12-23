@props(['manga'])

<x-card.card hoverable class="overflow-hidden">
    @if ($manga->malItem && $manga->malItem->image_url)
        <div class="sm:hidden relative overflow-hidden h-80 sm:rounded-t-md flex items-center">
            <div class="absolute w-full h-full object-cover blur-xl" style="background-image: url('{{ $manga->malItem->image_url }}')"></div>
            <img src="{{ $manga->malItem->image_url }}" alt="{{ $manga->name }}" class="relative h-72 mx-auto"/>
        </div>

        <img src="{{ $manga->malItem->image_url }}" alt="{{ $manga->name }}" class="hidden sm:block w-full sm:h-[450px] lg:h-[375px] md:object-cover md:object-top"/>
    @else
        <x-card.header>
            {{ $manga->name }}
        </x-card.header>
    @endif

    <x-card.body>
        @if ($manga->malItem && $manga->malItem->url)
            <div class="font-bold text-xl mb-2">
                {{ $manga->name }}

                <a href="{{ $manga->malItem->url }}" class="link-default text-sm" data-tooltip-content="{{ __('manga_at_myanimelist', ['name' => $manga->name]) }}">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        @endif

        <div class="text-gray-700 dark:text-gray-500 text-base">
            @if ($manga->malItem && $manga->malItem->url)
                <div>{{ __('MAL score') }}: {{ formatNumber($manga->malItem->score, 2) }}</div>
            @endif

            <div>
                {{ __('validation.attributes.is_completed') }}: {{ formatBool($manga->is_completed) }}
            </div>

            @if ($manga->malItem)
                <div class="pt-2">
                    @foreach ($manga->malItem->genres as $genre)
                        <x-badge>
                            {{ $genre->name }}
                        </x-badge>
                    @endforeach
                </div>
            @endif

            @if ($manga->volumes->isNotEmpty())
                <div class="font-bold">
                    {{ trans_choice('common.volumes', $manga->volumes) }}:
                </div>
                <div class="break-all">
                    {{ intRangeToStr($manga->volumes->pluck('no')) }}
                </div>
            @endif

            @if ($manga->specials->isNotEmpty())
                <div class="font-bold mt-2">
                    {{ trans_choice('common.specials', $manga->specials) }}:
                </div>
                <div class="break-all">
                    {{ $manga->specials->implode('name', ', ') }}
                </div>
            @endif
        </div>
    </x-card.body>
</x-card.card>
