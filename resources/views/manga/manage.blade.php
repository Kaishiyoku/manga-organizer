@extends('layouts.app')

@section('title', __('manga.manage.title'))

@section('content')
    <h1 class="headline-1">{{ __('manga.manage.title') }}</h1>

    <div class="mb-8 mt-4">
        {!! Html::decode(Html::linkRoute('mangas.create', '<i class="fas fa-plus"></i> ' . __('manga.manage.new'), [], ['class' => 'btn-default'])) !!}
    </div>

    @if ($mangas->count() == 0)
        <p class="italic text-gray-500 text-xl">{{ __('manga.no_mangas_yet') }}</p>
    @else
        <div class="grid sm:grid-cols-2 lg:hidden gap-4">
            @foreach ($mangas as $manga)
                <div class="rounded overflow-hidden shadow-lg border border-gray-200 mb-4 bg-white">
                    <div class="px-6 py-4">
                        <div class="text-xl font-medium pb-2">
                            {{ $manga->name }}
                        </div>

                        <div class="flex">
                            <div class="pr-4">{{ __('manga.manage.number_of_volumes') }}:</div>
                            <div>{{ $manga->volumes->count() }}</div>
                        </div>

                        <div class="flex">
                            <div class="pr-4">{{ __('manga.manage.number_of_specials') }}:</div>
                            <div>{{ $manga->specials->count() }}</div>
                        </div>

                        <div class="flex">
                            <div class="pr-4">{{ __('validation.attributes.mal_id') }}:</div>
                            <div>{{ $manga->mal_id }}</div>
                        </div>

                        <div class="flex">
                            <div class="pr-4">{{ __('validation.attributes.is_completed') }}:</div>
                            <div>{{ formatBool($manga->is_completed) }}</div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 bg-gray-100 px-6 py-4">
                        {!! Html::decode(Html::linkRoute('mangas.edit', '<i class="fas fa-pencil-alt"></i> ' . __('common.edit'), [$manga->id], ['class' => 'link-default mr-4'])) !!}

                        @include('shared._delete_link', ['route' => ['mangas.destroy', $manga]])
                    </div>
                </div>
            @endforeach
        </div>

        <div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white hidden lg:block">
            <table class="table table-hover">
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
        <p class="italic text-gray-500 text-xl">{{ __('manga.no_recommendations') }}</p>
    @else
        <div class="grid sm:grid-cols-2 lg:hidden gap-4">
            @foreach ($recommendations as $recommendation)
                <div class="rounded overflow-hidden shadow-lg border border-gray-200 mb-4 bg-white">
                    <div class="px-6 py-4">
                        <div class="text-xl font-medium pb-2">
                            {{ $recommendation->manga }}
                        </div>

                        <div>
                            {{ $recommendation->created_at->format(__('date.datetime')) }}
                        </div>
                    </div>

                    <div class="border-t border-gray-200 bg-gray-100 px-6 py-4">
                        @include('shared._delete_link', ['route' => ['recommendations.destroy', $recommendation]])
                    </div>
                </div>
            @endforeach
        </div>

        <div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white hidden lg:block">
            <table class="table table-hover">
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
