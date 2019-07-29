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

    @if ($mangas->count() == 0)
        <p><i>{{ __('manga.no_mangas_yet') }}</i></p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>{{ __('validation.attributes.title') }}</th>
                    <th>{{ __('manga.index.mal_score') }}</th>
                    <th>{{ __('validation.attributes.is_completed') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mangas as $manga)
                    <tr>
                        <td>
                            @if ($manga->malItem && $manga->malItem->url)
                                {{ Html::link($manga->malItem->url, $manga->name) }}
                            @else
                                {{ $manga->name }}
                            @endif
                        </td>
                        <td>
                            @if ($manga->malItem && $manga->malItem->url)
                                <div>{{ formatNumber($manga->malItem->score, 2) }}</div>
                            @endif
                        </td>
                        <td>
                            {{ formatBool($manga->is_completed) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table>
                                <tbody>
                                    @foreach ($manga->volumes as $volume)
                                        <tr>
                                            <td>{{ $volume->no }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($manga->specials as $special)
                                        <tr>
                                            <td>{{ $special->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
