<div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white">
    @if ($manga->malItem && $manga->malItem->image_url)
        <div class="text-center">
            {{ Html::image($manga->malItem->image_url, $manga->name, ['class' => 'w-full']) }}
        </div>
    @endif

    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">
            {{ $manga->name }}

            @if ($manga->malItem && $manga->malItem->url)
                {!! Html::decode(Html::link($manga->malItem->url, '<i class="fas fa-external-link-alt"></i>', ['title' => __('manga.index.manga_at_myanimelist', ['name' => $manga->name]), 'class' => 'link-default text-sm'])) !!}
            @endif
        </div>

        <div class="text-gray-700 text-base">
            @if ($manga->malItem && $manga->malItem->url)
                <div>{{ __('manga.index.mal_score') }}: {{ formatNumber($manga->malItem->score, 2) }}</div>
            @endif

            <div class="pb-3">
                {{ __('validation.attributes.is_completed') }}: {{ formatBool($manga->is_completed) }}
            </div>

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
