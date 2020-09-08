@extends('text.app')

@section('title', __('manga.index.title'))

@section('content')
    <h1>{{ __('manga.index.title') }}</h1>

    <p>
        @auth
            {{ Html::linkRoute('mangas.manage', __('manga.index.manage')) }}
        @endauth

        @guest
            {{ Html::linkRoute('recommendations.create', __('manga.index.recommend_me_a_manga')) }}
        @endguest
    </p>

    @if ($mangas->count() === 0)
        <p><i>{{ __('manga.no_mangas_yet') }}</i></p>
    @else
        @foreach ($mangas as $manga)
            <table border="1" cellpadding="5" width="500" style="margin-bottom: 1rem;">
                <tbody>
                    <tr>
                        <td colspan="2">
                            @if ($manga->malItem && $manga->malItem->url)
                                {{ Html::link($manga->malItem->url, \Illuminate\Support\Str::upper($manga->name)) }}
                            @else
                                {{ \Illuminate\Support\Str::upper($manga->name) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="120">{{ __('manga.index.mal_score') }}</td>
                        <td width="380">
                            @if ($manga->malItem && $manga->malItem->url)
                                <div>{{ formatNumber($manga->malItem->score, 2) }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="120">{{ formatBool($manga->is_completed) }}</td>
                        <td width="380">
                            {{ __('validation.attributes.is_completed') }}
                        </td>
                    </tr>
                    <tr>
                        <td width="120">{{ trans_choice('manga.volumes', $manga->volumes) }}:</td>
                        <td width="380">
                            {{ intRangeToStr($manga->volumes->pluck('no')) }}
                        </td>
                    </tr>
                    <tr>
                        <td width="120">{{ trans_choice('manga.specials', $manga->specials) }}:</td>
                        <td width="380">
                            {{ $manga->specials->implode('name', ', ') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    @endif
@endsection
