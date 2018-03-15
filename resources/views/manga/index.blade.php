@extends('app')

@section('title', 'Manga list')

@section('content')
    <h1>Manga list</h1>

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
                            <td>{{ $manga->name }}</td>
                            <td>{{ $volume->number }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection