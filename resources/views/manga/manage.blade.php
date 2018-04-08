@extends('app')

@section('title', __('manga.manage.title'))

@section('content')
    <h1>{{ __('manga.manage.title') }}</h1>

    @auth
        <p>
            {!! Html::decode(Html::linkRoute('mangas.create', '<i class="fas fa-plus"></i> ' . __('manga.manage.new'), [], ['class' => 'btn btn-secondary btn-sm'])) !!}
        </p>
    @endauth

    @if ($mangas->count() == 0)
        <p class="lead"><i>{{ __('manga.no_mangas_yet') }}</i></p>
    @else
        <div class="card-columns d-block d-md-none">
            @foreach ($mangas as $manga)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $manga->name }}</h5>

                        <div class="row">
                            <div class="col-4 col-sm-6">{{ __('manga.manage.number_of_volumes') }}:</div>
                            <div class="col-8 col-sm-6">{{ $manga->volumes->count() }}</div>
                        </div>

                        <div class="row">
                            <div class="col-4 col-sm-6">{{ __('manga.manage.number_of_specials') }}:</div>
                            <div class="col-8 col-sm-6">{{ $manga->specials->count() }}</div>
                        </div>

                        <div class="row">
                            <div class="col-4 col-sm-6">{{ __('validation.attributes.mal_id') }}:</div>
                            <div class="col-8 col-sm-6">{{ formatEmpty($manga->mal_id) }}</div>
                        </div>

                        <div class="row">
                            <div class="col-4 col-sm-6">{{ __('validation.attributes.is_completed') }}:</div>
                            <div class="col-8 col-sm-6">{{ formatBool($manga->is_completed) }}</div>
                        </div>
                    </div>

                    <div class="card-footer">
                        {!! Html::decode(Html::linkRoute('mangas.edit', '<i class="fas fa-pencil"></i> ' . __('common.edit'), [$manga->id], ['class' => 'mr-2'])) !!}

                        @include('shared._delete_link', ['route' => ['mangas.destroy', $manga]])
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-none d-md-block">
            <table class="table table-bordered table-striped table-sm">
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
                        <td>
                            {!! Html::decode(Html::linkRoute('mangas.edit', '<i class="fas fa-pencil"></i> ' . __('common.edit'), [$manga->id])) !!}
                        </td>
                        <td>
                            @include('shared._delete_link', ['route' => ['mangas.destroy', $manga]])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h2>{{ __('manga.manage.recommendations') }}</h2>

    @if ($recommendations->count() == 0)
        <p class="lead"><i>{{ __('manga.no_recommendations') }}</i></p>
    @else
        <div class="card-columns d-block d-md-none">
            @foreach ($recommendations as $recommendation)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recommendation->manga }}</h5>

                        <p class="card-text">
                            {{ $recommendation->created_at->format(__('date.datetime')) }}
                        </p>
                    </div>

                    <div class="card-footer">
                        @include('shared._delete_link', ['route' => ['recommendations.destroy', $recommendation]])
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-none d-md-block">
            <table class="table table-bordered table-striped table-sm">
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
                        <td>
                            @include('shared._delete_link', ['route' => ['recommendations.destroy', $recommendation]])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection