@extends('app')

@section('title', __('manga.manage.title'))

@section('content')
    <h1>{{ __('manga.manage.title') }}</h1>

    @auth
        {{ Html::linkRoute('mangas.create', __('manga.manage.new'), [], ['class' => 'btn btn-secondary btn-sm']) }}
    @endauth

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>{{ __('validation.attributes.name') }}</th>
                    <th>{{ __('manga.manage.number_of_volumes') }}</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($mangas as $manga)
                    <tr>
                        <td>{{ $manga->name }}</td>
                        <td>{{ $manga->volumes->count() }}</td>
                        <td>
                            {{ Html::linkRoute('mangas.edit', __('common.edit'), [$manga->id]) }}
                        </td>
                        <td>
                            @include('shared._delete_link', ['route' => ['mangas.destroy', $manga]])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection