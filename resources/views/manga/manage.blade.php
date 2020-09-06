@extends('layouts.app')

@section('title', __('manga.manage.title'))

@section('content')
    <h1 class="text-5xl mb-4">{{ __('manga.manage.title') }}</h1>

    @auth
        <p class="mb-4">
            {!! Html::decode(Html::linkRoute('mangas.create', '<i class="fas fa-plus"></i> ' . __('manga.manage.new'), [], ['class' => 'btn-default'])) !!}
        </p>
    @endauth

    @if ($mangas->count() == 0)
        <p class="lead"><i>{{ __('manga.no_mangas_yet') }}</i></p>
    @else
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('manga.manage.number_of_volumes') }}</th>
                        <th>{{ __('manga.manage.number_of_specials') }}</th>
                        <th>{{ __('validation.attributes.mal_id') }}</th>
                        <th>{{ __('validation.attributes.is_completed') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($mangas as $manga)
                        <tr>
                            <td>{{ $manga->name }}</td>
                            <td>{{ $manga->volumes->count() }}</td>
                            <td>{{ $manga->specials->count() }}</td>
                            <td>{{ $manga->mal_id }}</td>
                            <td>{{ formatBool($manga->is_completed) }}</td>
                            <td class="text-right">
                                {!! Html::decode(Html::linkRoute('mangas.edit', '<i class="fas fa-pencil-alt"></i> ' . __('common.edit'), [$manga->id], ['class' => 'link-default'])) !!}
                            </td>
                            <td class="text-right">
                                @include('shared._delete_link', ['route' => ['mangas.destroy', $manga]])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h2 class="text-4xl mt-4 mb-2">{{ __('manga.manage.recommendations') }}</h2>

    @if ($recommendations->count() == 0)
        <p class="lead"><i>{{ __('manga.no_recommendations') }}</i></p>
    @else
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('validation.attributes.manga') }}</th>
                    <th>{{ __('validation.attributes.created_at') }}</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($recommendations as $recommendation)
                    <tr>
                        <td>{{ $recommendation->manga }}</td>
                        <td>{{ $recommendation->created_at->format(__('date.datetime')) }}</td>
                        <td class="text-right">
                            @include('shared._delete_link', ['route' => ['recommendations.destroy', $recommendation]])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
