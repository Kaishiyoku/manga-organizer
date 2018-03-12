@extends('app')

@section('title', 'Manga list')

@section('content')
    <h1>Manga list</h1>

    <table border="1">
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
@endsection