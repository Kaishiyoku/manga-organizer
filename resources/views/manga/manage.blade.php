@extends('app')

@section('title', 'Manage manga list')

@section('content')
    <h1>Manage manga list</h1>

    @auth
        {{ Html::linkRoute('mangas.create', 'New manga', [], ['class' => 'btn btn-secondary btn-sm']) }}
    @endauth

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Name</th>
                    <th># Volumes</th>
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
                            {{ Html::linkRoute('mangas.edit', 'Edit', [$manga->id]) }}
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