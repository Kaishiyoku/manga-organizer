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
                    <tr>
                        <td>{{ $manga->name }}</td>
                        <td>{{ $manga->number }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection