@extends('app')

@section('title', 'Manga list')

@section('content')
    <h1>Manga list</h1>

    @auth
        {{ Html::linkRoute('mangas.create', 'New manga', [], ['class' => 'btn btn-secondary btn-sm']) }}
    @endauth

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Volume</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($mangas as $manga)
                    @foreach ($manga->volumes as $volume)
                        <tr>
                            <td>
                                {{ $manga->name }}

                                {{ Html::linkRoute('mangas.edit', 'Edit', [$manga->id]) }}
                            </td>
                            <td>{{ $volume->number }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>

            @auth
                <p class="lead">
                    Mangas without volumes
                </p>

                <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($mangasWithoutVolumes as $manga)
                        <tr>
                            <td>
                                {{ $manga->name }}

                                {{ Html::linkRoute('mangas.edit', 'Edit', [$manga->id]) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endauth
        </div>
    </div>
@endsection