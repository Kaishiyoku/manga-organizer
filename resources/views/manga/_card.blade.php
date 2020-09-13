<div class="card transition-shadow duration-300 hover:shadow-xl">
    @if ($manga->malItem && $manga->malItem->image_url)
        <div class="text-center">
            {{ Html::image($manga->malItem->image_url, $manga->name, ['class' => 'w-full']) }}
        </div>
    @endif

    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">
            {{ $manga->name }}

            @if ($manga->malItem && $manga->malItem->url)
                <a href="{{ $manga->malItem->url }}" class="link-default text-sm" data-tooltip-content="{{ __('manga.index.manga_at_myanimelist', ['name' => $manga->name]) }}">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            @endif
        </div>

        <div class="text-gray-700 text-base">
            @if ($manga->malItem && $manga->malItem->url)
                <div>{{ __('manga.index.mal_score') }}: {{ formatNumber($manga->malItem->score, 2) }}</div>
            @endif

            <div>
                {{ __('validation.attributes.is_completed') }}: {{ formatBool($manga->is_completed) }}
            </div>

            @if ($manga->malItem)
                <div class="pt-2">
                    @foreach ($manga->malItem->genres as $genre)
                        <span class="inline-block rounded-full bg-gray-200 text-gray-800 px-2 py-1 text-xs mb-2">
                            {{ $genre->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            @if ($manga->volumes->isNotEmpty())
                <div class="font-bold">
                    {{ trans_choice('manga.volumes', $manga->volumes) }}:
                </div>
                <div class="break-all">
                    {{ intRangeToStr($manga->volumes->pluck('no')) }}
                </div>
            @endif

            @if ($manga->specials->isNotEmpty())
                <div class="font-bold mt-2">
                    {{ trans_choice('manga.specials', $manga->specials) }}:
                </div>
                <div class="break-all">
                    {{ $manga->specials->implode('name', ', ') }}
                </div>
            @endif
        </div>
    </div>
</div>
