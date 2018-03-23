@extends('app')

@section('title', __('manga.index.title'))

@section('content')
    <h1>{{ __('manga.index.title') }}</h1>

    <p>
        @auth
            {!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-wrench"></i> ' . __('manga.index.manage'), [], ['class' => 'btn btn-secondary btn-sm'])) !!}
        @endauth

        @guest
            {!! Html::decode(Html::linkRoute('recommendations.create', '<i class="far fa-envelope-open"></i> ' . __('manga.index.recommend_me_a_manga'), [], ['class' => 'btn btn-primary btn-sm'])) !!}
        @endguest
    </p>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @if ($mangas->count() == 0)
                <p class="lead"><i>{{ __('manga.no_mangas_yet') }}</i></p>
            @else
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('manga.index.mal_score') }}</th>
                        <th>{{ __('validation.attributes.is_completed') }}</th>
                        <th>{{ __('validation.attributes.volume') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($mangas as $manga)
                        @foreach ($manga['manga']->volumes as $i => $volume)
                            <tr class="{{ $i == $manga['manga']->volumes->count() - 1  ? 'bordered-bold' : ''}}">
                                <td>
                                    @if ($i == 0)
                                        <strong>{{ $manga['manga']->name }}</strong>

                                        @if ($manga['malData'] != null)
                                            {!! Html::decode(Html::link($manga['malData']['link_canonical'], '<i class="fas fa-external-link"></i>', ['title' => __('manga.index.manga_at_myanimelist', ['name' => $manga['manga']->name])])) !!}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($i == 0 && $manga['malData'] != null)
                                        {{ formatNumber($manga['malData']['score'], 2) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($i == 0)
                                        {{ formatBool($manga['manga']->is_completed) }}
                                    @endif
                                </td>
                                <td>{{ $volume->no }}</td>
                            </tr>
                        @endforeach

                        @foreach ($manga['manga']->specials as $i => $special)
                            <tr class="{{ $i == $manga['manga']->specials->count() - 1  ? 'bordered-bold' : ''}}">
                                <td>
                                    @if ($i == 0)
                                        <strong>{{ $manga['manga']->name }}</strong>
                                    @endif
                                </td>
                                <td>
                                    @if ($i == 0 && $manga['malData'] != null)
                                        {{ formatNumber($manga['malData']['score'], 2) }}
                                    @endif
                                </td>
                                <td></td>
                                <td>{{ $special->name }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection