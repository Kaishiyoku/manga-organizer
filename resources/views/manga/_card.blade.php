<div class="rounded overflow-hidden shadow-lg border border-gray-200">
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

            <button data-toggle="expand" data-target="#volumes-and-specials-{{ $manga->id }}" data-duration="500" class="border border-purple-400 rounded py-1 px-3 text-purple-900 hover:bg-purple-500 hover:text-white transition-all duration-150 w-full text-left flex justify-between items-center">
                {{ __('manga.index.volumes_and_specials') }}
                <i class="fas fa-chevron-circle-down"></i>
            </button>

            <div class="simple-list mt-4 hidden" id="volumes-and-specials-{{ $manga->id }}">
                @foreach ($manga->volumes as $volume)
                    <div>{{ $volume->no }}</div>
                @endforeach

                @foreach ($manga->specials as $special)
                    <div>{{ $special->name }}</div>
                @endforeach
            </div>
        </div>
    </div>
</div>
